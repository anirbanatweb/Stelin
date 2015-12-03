<?php

	/* This API used to get a new token for a URL.
	   GET method should be used to call this API. Example, http://www.anirbanatweb.pe.hu/rest/post/index.php?url=http://www.google.com
	   Encode the URL (according to RFC 3986) before passing it to this API to get the correct result. The response will be in the JSON format */
	
	require_once dirname(dirname(__DIR__)) . '/models/connection.php';
	header("content-type: application/json");
	
	// Turn the error reporting on while debugging
	
	error_reporting(0);
	
	// Instance of the Connection class is used to perform the database related operations. For any database related error check $root/models/connection.php
	
	$db = new Connection();
	if(!$db || !$db->checkConnection())
	{
		// Database connection error
		
		deliver_response(500, "Internal Server Error", null);
	}
	else
	{
		// Validate the URL before passing it to the database
		
		if(filter_var($_GET['url'], FILTER_VALIDATE_URL))
		{
			
			// Get the token for the particular URL and call deliver_response() with the status code, the status message and the data accordingly
			
			$result = $db->getToken($_GET['url']);
			if(!$result)
			{
				deliver_response(404, "Not Found", null);
			}
			else
			{
				deliver_response(201, "Created", $result);
			}
		}
		
		// In case validation fails, deliver a error response
		
		else
		{
			deliver_response(400, "Bad Request", null);
		}
	}
	
	// This function is used to prepare the response and deliver it in the JSON format
	
	function deliver_response($status, $status_message, $data)
	{
		header("HTTP/1.1 $status $status_message");
		$response['status'] = $status;
		$response['status_message'] = $status_message;
		$response['token'] = $data;
		$json_response = json_encode($response);
		echo $json_response;
	}

?>