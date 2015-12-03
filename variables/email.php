<?php

	/* These credentials are used to send email to the user.
	   This is a modular component i.e. you can enable or disable this feature just setting the $enabled variable true or false
	   NOTE: As this is one optional feature it might not generate any error message. Any error has to be fixed by manual debugging */

	class Email
	{
		static $enabled        = true;							// Enable or disable toggle. Here, true = enabled and false = disabled
		static $smtpDebug      = false;							// SMTP debug
		static $smtpAuth       = true;							// SMTP authentication
		static $host           = 'enter_something_here';		// SMTP host
		static $port           =  enter_something_here;			// SMTP open port
		static $username       = 'enter_something_here';		// SMTP username
		static $password       = 'enter_something_here';		// SMTP password
		static $setFrom        = 'enter_something_here';		// Sender email
		static $setFromName    = 'enter_something_here';		// Sender name
		static $addReplyTo     = 'enter_something_here';		// Reply to email
		static $addReplyToName = 'enter_something_here';		// Reply to name
	}

?>