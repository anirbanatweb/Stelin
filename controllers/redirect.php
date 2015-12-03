<?php
	
	/* Redirect the incoming requests from request.php to the proper locations.
	   It will be redirected either to the requested page or to result.php */
	
	session_start();
	require_once dirname(__DIR__) . '/variables/server.php';
	require_once __DIR__ . '/session_handler.php';
	
	// If this is a valid request
	
	if(isset($_SESSION['type']))
	{
		
		// If the request is a view token (GET) request AND if the request is also valid then directly redirect the user to the requested page
		
		if($_SESSION['type']=='GET' && $_SESSION['status']>=200 && $_SESSION['status']<=299)
		{
			header('Location: ' . $_SESSION['data']);
			Session::unsetGeneralSession();
			die();
		}
		
		// For the other cases - create token request or invalid view token request. Redirect the user to the result.php page to show the message
		
		else
		{
			header('Location: ' . Server::$root . '/views/result.php');
			die();
		}
	}
	
	// This request is not from request.php. Redirect the user back to the homepage
	
	else
	{
		Session::unsetGeneralSession();
		header('Location: ' . Server::$root);
		die();
	}

?>