<!DOCTYPE HTML>

<!-- This is used to display the result back to the user -->

<?php

	// Turn the error reporting on while debugging 
	
	error_reporting(0);
	
	session_start();
	require_once dirname(__DIR__) . '/variables/server.php';
	require_once dirname(__DIR__) . '/variables/email.php';
	require_once dirname(__DIR__) . '/controllers/mailer.php';
	require_once dirname(__DIR__) . '/controllers/session_handler.php';

?>

<html>

	<!-- Head -->

	<head>
		<title>Stelin - Result</title>
		<meta charset = "utf-8">
		<link type="text/css" rel="stylesheet" href="../css/stylesheet.css">
	</head>
	
	<!-- Body -->
	
	<body>
		<div class = "container">
			<a href = "<?php echo Server::$root; ?>" title = "Shorten URLs quickly!"> <h1 class = "title"> stelin </h1> </a>
			<?php
			
				// If the request is a valid one
			
				if(isset($_SESSION['status']))
				{
					
					// If something is wrong display the error message
					
					if($_SESSION['status']<200 || $_SESSION['status']>299)
					{
						$status = $_SESSION['status'];
						$status_message = $_SESSION['status_message'];
						echo "<h3 class='error'> Errrr.. Something is not right! </h3>";
						echo "<textarea class = 'textarea' rows='2' cols='60' readonly> $status - $status_message. Try again! </textarea>";
					}
					
					// If the things went right (which is possible over here in case of POST requests only) print the link
					
					else
					{
						$link = $_SESSION['link'];
						
						// If the user has entered an email address and also the email feature is enabled, send an email
						
						if(Email::$enabled && isset($_SESSION['email']))
							Mailer::sendMail();
						
						echo "<h1 class='success'>That was smooth! Here is you link:</h1>";
						echo "<textarea class = 'textarea' rows='2' cols='60' readonly> $link </textarea>";
					}
					
					// Clear the session (except twitter_name)
					
					Session::unsetGeneralSession();
				}
				
				// Invalid request. Redirect to the homepage
				
				else
				{
					Session::unsetGeneralSession();
					header('Location: ' . Server::$root);
					die();
				}
			?>
		</div>
	</body>
	
</html>