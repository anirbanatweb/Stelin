<?php

	/* This file handles the session unset and destroy operations */
	
	error_reporting(0);
	session_start();
	
	class Session
	{
		
		// Clears all the session fields except twitter_name to keep the user logged in
		
		static function unsetGeneralSession()
		{
			foreach($_SESSION as $key => $value)
			{
				if($key!== 'twitter_name')
					unset($_SESSION[$key]);
			}
		}
		
		// Destroys the session completely (including twitter_name)
		
		static function destroySession()
		{
			session_destroy();
		}
		
	}
	
?>