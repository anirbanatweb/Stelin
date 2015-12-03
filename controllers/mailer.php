<?php

	/* This Mailer class is used to send email to the user. It uses the credentials defined in $root/variables/email.php
	   Use any SMTP mail server. Check the credentials defined in $root/variables/email.php if you encounter any problem */

	// Turn the error reporting on while debugging
	
	error_reporting(0);
	session_start();
	require_once dirname(__DIR__) . '/lib/phpmailer/PHPMailerAutoload.php';
	require_once dirname(__DIR__) . '/variables/email.php';
	require_once dirname(__DIR__) . '/variables/server.php';
	
	class Mailer
	{
		static function sendMail()
		{
			
			// Initializes the variables based on the credentials defined in email.php
			
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug  = Email::$smtpDebug;
			$mail->SMTPAuth   = Email::$smtpAuth;
			$mail->Host       = Email::$host;
			$mail->Port       = Email::$port;
			$mail->Username   = Email::$username;
			$mail->Password   = Email::$password;
			$mail->SetFrom(Email::$setFrom, Email::$setFromName); 
			$mail->AddReplyTo(Email::$addReplyTo, Email::$addReplyToName);
			$email = $_SESSION['email'];
			$mail->AddAddress($email);
			$mail->Subject = 'Thank you for using Stelin!';
			$mail->AltBody    = 'To view the message, please use an HTML compatible email viewer!'; 
			$mail->IsHTML(false);
			$mail->Body = 'That was smooth! Here is your link: ' . $_SESSION['link'];

			// For debugging purposes. Track these session variables in case of any error
			
			if(!$mail->Send()) 
			{
				$_SESSION['email_status'] = false;
			}
			else 
			{
				$_SESSION['email_status'] = true;
			}
		}
	}
?>