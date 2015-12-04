<?php

	/* These credentials are used to connect to your Twitter app.
	   You can find these credentials in the "Keys and Access Tokens" section of your Twitter app. Visit: https://apps.twitter.com/
	   This is a modular component i.e. you can enable or disable this feature just setting the $enabled variable true or false
	   NOTE: As this is one optional feature it might not generate any error message. Any error has to be fixed by manual debugging
	   If you are hosting it on a live server then go to $root/lib/TwitterAPIExchange.php and remove the line "CURLOPT_SSL_VERIFYPEER => false" (line number: 283) */

	class Twitter
	{
		static $enabled                   = true;									// Enable or disable toggle. Here, true = enabled and false = disabled
		static $oauth_access_token        = "enter_something_here";					// Access Token
		static $oauth_access_token_secret = "enter_something_here";					// Access Token Secret
		static $consumer_key              = "enter_something_here";					// Consumer Key (API Key)
		static $consumer_secret           = "enter_something_here";					// Consumer Secret (API Secret)
	}
	
?>
