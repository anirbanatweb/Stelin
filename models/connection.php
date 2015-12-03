<?php
	
	/* This class is used to connect to the database. Only the methods defined in this class can be used to modify the database.
	   So for any database related error check this class and the $root/variables/database.php configuration file */
	
	require_once dirname(__DIR__) . '/variables/database.php';
	
	
	class Connection
	{
		protected $conn;
		protected $tablename;
		
		// Constructor
		
		public function __construct()
		{
			
			// Uses the values defined in the database.php file to connect to the database
			
			$this->conn = new mysqli(Database::$host, Database::$username, Database::$password, Database::$database);
			$this->tablename = Database::$tablename;
		}
		
		
		// Get the token for a particular URL
		
		function getToken($url)
		{
			
			// Check if the URL already exists or not
			
			$result = $this->checkIfExists($url);
			
			// If the URL doesn't exist create a new token and store it in the $result variable
			
			if(strlen($result)==0)
			{
				$query = "INSERT INTO $this->tablename (url) VALUES('$url')";
				$this->conn->query($query);
				$query = "SELECT id FROM $this->tablename WHERE url = '$url'";
				$temp = $this->conn->query($query);
				$id = $temp->fetch_assoc()['id'];
				
				// The below line is the token generator.
				
				$result = base_convert($id, 10, 30);
				
				$query = "UPDATE $this->tablename SET token = '$result' WHERE url = '$url'";
				$this->conn->query($query);
			}
			return $result;
		}
		
		
		// Get the URL for a particular token
		
		function getURL($token)
		{
			$query = "SELECT url FROM $this->tablename WHERE token = '$token'";
			$result = $this->conn->query($query);
			
			// If the token doesn't exist return a null string else the fetched URL
			
			if(!$result)
				return "";
			else
				return $result->fetch_assoc()['url'];
		}
		
		
		// Check if the URL already exists
		
		function checkIfExists($url)
		{
			$query = "SELECT token FROM $this->tablename WHERE url = '$url'";
			$result = $this->conn->query($query);
			
			// If the URL doesn't exist return a null string else the fetched token
			
			if(!$result)
				return "";
			else
				return $result->fetch_assoc()['token'];
		}
		
		
		// Check if the mentioned table exists or not
		
		function tableExists() 
		{
			$result = $this->conn->query("SHOW TABLES LIKE '$this->tablename'");
			
			// Check how many tables are there in the database with the mentioned name. If the number is greater than 0 then it exists
			
			if(isset($result->num_rows) && $result->num_rows > 0) 
				return true;
			else
				return false;
		}
		
		
		// Check for any database connection error
		
		function checkConnection()
		{
			
			// Can not connect to the database, return false
			
			if(mysqli_connect_errno())
				return false;
			else
			{
				
				// If the connection is okay and the table also exists then return true otherwise return false
				
				if($this->tableExists())
					return true;
				else
					return false;
			}
		}
	}
?>