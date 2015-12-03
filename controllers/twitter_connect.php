<?php

	/* This is used to connect to Twitter. It uses the credentials defined in $root/variables/twitter.php
	   After the connection the page will be redirected to the homepage
	   Check the credentials defined in $root/variables/twitter.php if you encounter any problem */

	session_start();
	require_once dirname(__DIR__) . '/lib/twitter/TwitterAPIExchange.php';
	require_once dirname(__DIR__) . '/variables/twitter.php';
	require_once dirname(__DIR__) . '/variables/server.php';
	
	// If the Twitter module is enabled and the user has submitted a Twitter handle
	
	if(Twitter::$enabled && isset($_POST['twitter_handle']))
	{
		
		// Initializes the variables based on the credentials defined in the twitter.php
		
		$settings = array (
			'oauth_access_token' => Twitter::$oauth_access_token,
			'oauth_access_token_secret' => Twitter::$oauth_access_token_secret,
			'consumer_key' => Twitter::$consumer_key,
			'consumer_secret' => Twitter::$consumer_secret
		);
		
		// Prepare the URL to get response
		
		$url = "https://api.twitter.com/1.1/users/lookup.json";
		$requestMethod = "GET";
		$getfield = '?screen_name='.$_POST['twitter_handle'];
		$twitter = new TwitterAPIExchange($settings);
		
		// Get the response from the Twitter API
		
		$response = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
		
		// Decode the JSON
		
		$name = (json_decode($response, true)[0]['name']);
		
		// Break the name and take the first word as the first name and store it in the current session
		
		$firstname = explode(" ", $name);
		$_SESSION['twitter_name'] = $firstname[0];
	}
	
	// Redirect back to the homepage
	
	header('Location: ' . Server::$root);
	die();
	
?>