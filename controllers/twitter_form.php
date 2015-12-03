<!DOCTYPE HTML>

<!-- This is the Connect Twitter form page. On submit the control will be forwarded to the twitter_connect.php page -->

<?php
	session_start();
	require_once dirname(__DIR__) . '/variables/server.php';
	
	// If the user is already connected redirect back to the homepage
	
	if(isset($_SESSION['twitter_name']))
	{
		header('Location: ' . Server::$root);
		die();
	}
?>

<html>

	<!-- Head -->

	<head>
		<title> Stelin - Connect Twitter</title>
		<meta charset = "utf-8">
		<link type="text/css" rel="stylesheet" href="../css/stylesheet.css">
	</head>
	
	<!-- Body -->
	
	<body>
		<div class = "container">
			<a href = "<?php echo Server::$root; ?>" title = "Shorten URLs quickly!"> <h1 class = "title"> stelin </h1> </a>
			
			<!-- Form to get the Twitter handle of the user -->
			
			<form action = 'twitter_connect.php' method = 'post'>
				<input type = 'text' name = 'twitter_handle' placeholder = 'Example, if your Twitter handle is @GoAnbn then enter GoAnbn'>
				<input type = 'submit' name = 'submit' value = 'Submit'>
			</form>
		</div>
	</body>
</html>