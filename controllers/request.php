<?php

	/* This controller handles all the incoming requests and sets the particular session values.
	   Then it transfers the control to redirect.php */
	
	session_start();
	require_once dirname(__DIR__) . '/variables/server.php';
	require_once dirname(__DIR__) . '/variables/email.php';
	require_once __DIR__ . '/session_handler.php';
	
	 // If the incoming request is for viewing a token
	 
	if(isset($_GET['token']))				
	{
		$url = Server::$root . '/rest/get/index.php?token=' . $_GET['token'];
		$_SESSION['type'] = 'GET';
	}
	
	// If the incoming request is for creating a new token
	
	else if(isset($_POST['url']))
	{
		
		// Encode the user given URL using rawurlencode()
		
		$encodedurl = rawurlencode($_POST['url']);
		$url = Server::$root.'/rest/post/index.php?url=' . $encodedurl;
		$_SESSION['type'] = 'POST';
		
		// Check if the email feature is enabled or not and also if the user has entered any email address
		
		if(Email::$enabled && isset($_POST['check']) && $_POST['check']==='on' && isset($_POST['email']))
		{
			
			// Validate the entered email and store it in the session
			
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$_SESSION['email'] = $_POST['email'];
			}
		}
	}
	
	// Invalid request. Redirect the user to the homepage
	
	else									
	{
		Session::unsetGeneralSession();
		header("Location: Server::$root");
		die();
	}
	
	// Execute the current request and get the JSON data back using cURL
	
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	
	// Decode the JSON response and fill the session variables
	
	$response = json_decode($response, true);
	$_SESSION['status'] = $response['status'];
	$_SESSION['status_message'] = $response['status_message'];
	
	// If the incoming request is for viewing a token
	
	if(isset($_GET['token']))
		$_SESSION['data'] = $response['url'];
	
	// If the incoming request is for creating a token then also generate a viewer link to the newly created token and store it
	
	else
	{
		$_SESSION['data'] = $response['token'];
		$_SESSION['link'] = Server::$root . '/controllers/request.php?token=' . $response['token'];
	}
	
	// Redirect the page to redirect.php
	
	header('Location: redirect.php');
	die();
	
?>