<?php
	
	/* This API is used to get the URL for a particular token.
	   GET method should be used to call this API. Example, http://www.anirbanatweb.pe.hu/rest/get/index.php?token=1234
	   The response will be in the JSON format */
	
	require_once dirname(dirname(__DIR__)) . '/models/connection.php';
	header("content-type: application/json");
	
	// Turn the error reporting on while debugging
	
	error_reporting(0);
	
	// Instance of the Connection class is used to perform the database related operations. For any database related error check the $root/models/connection.php
	
	$db = new Connection();
	if(!$db || !$db->checkConnection())
	{
		// Database connection error
		deliver_response(500, "Internal Server Error", null);
	}
	else
	{
		
		// Get the URL for the particular token and call deliver_response() with the status code, the status message and the data accordingly
		
		$result = $db->getURL($_GET['token']);
		if(!$result)
		{
			deliver_response(404, "Not Found", null);
		}
		else
		{
			deliver_response(200, "OK", $result);
		}
	}
	
	// This function is used to prepare the response and deliver it in the JSON format
	
	function deliver_response($status, $status_message, $data)
	{
		header("HTTP/1.1 $status $status_message");
		$response['status'] = $status;
		$response['status_message'] = $status_message;
		$response['url'] = $data;
		$json_response = json_encode($response);
		echo $json_response;
	}
?>