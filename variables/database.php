<?php
	
	/* These values are used to connect to the database. Set the values carefully otherwise things will not work.
	   This is the table structure. Do not alter the structure or the field names. You may change the name of the table though.
	   
		   CREATE TABLE IF NOT EXISTS `urls` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `url` text NOT NULL,
		  `token` varchar(128) NOT NULL,
		  PRIMARY KEY (`id`)
		  ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100000;
	   
	  Set the values below accordingly */
	
	class Database
	{
		static $host      = "enter_something_here";		// Host
		static $username  = "enter_something_here";		// User name
		static $password  = "enter_something_here";		// Password
		static $database  = "enter_something_here";		// Database name
		static $tablename = "enter_something_here";		// Table name
	}

?>