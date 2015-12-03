<?php

	/* This is used to disconnect the user from Twitter
	   This basically destroys the session and redirects the user to the homepage */

	session_start();
	require_once dirname(__DIR__) . '/variables/server.php';
	require_once __DIR__ . '/session_handler.php';
	
	Session::destroySession();
	
	// Redirect to the homepage
	
	header('Location: ' . Server::$root);
	die();
	
?>