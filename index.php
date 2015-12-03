<!DOCTYPE HTML>

<!-- This is the homepage of the website. The control will go to controllers/request.php from here -->

<?php
	session_start();
	require_once __DIR__ . '/variables/twitter.php';
	require_once __DIR__ . '/variables/email.php';
	require_once __DIR__ . '/controllers/session_handler.php';
	require_once __DIR__ . '/variables/server.php';
	
	// Clear all the previous sessions if any
	
	Session::unsetGeneralSession();
?>

<html>
	
	<!-- Head -->
	
	<head>
		<title> Stelin - Shorten URLs quickly! </title>
		<meta charset = "utf-8">
		<link type="text/css" rel="stylesheet" href="css/stylesheet.css">
		<script type="text/javascript">
		
		// Javascript function to show or hide the target div based on the checkbox response
		
			function showHide(check)
			{
				var targetdiv = document.getElementById("email");
				targetdiv.style.display = check.checked ? "block" : "none";
			}
		</script>
	</head>
	
	<!-- Body -->
	
	<body>
	
		<div class = "container">
			<a href = "<?php echo Server::$root; ?>" title = "Shorten URLs quickly!"> <h1 class = "title"> stelin </h1> </a>
			
			<!-- Say Hi to the user! Twitter connect/disconnect button -->
			
			<?php
				if(Twitter::$enabled)
				{
					if(isset($_SESSION['twitter_name']))
						echo "<p class = 'greetings'> Hi " . $_SESSION['twitter_name'] . "! <a id = 'twitter_button' href = 'controllers/twitter_disconnect.php'> Disconnect </a> </p>";
					else
						echo "<p class = 'greetings'> Hi there! <a id = 'twitter_button' href = 'controllers/twitter_form.php'> Connect with Twitter </a> </p>";
				}
				else
				{
					echo "<p class = 'greetings'> Hi there! </p>";
				}
			?>
			
			<!-- Main form to get the URL -->
			
			<form action = "controllers/request.php" method = "post">
				<input type = "url" id = "url" name = "url" placeholder = "Enter a URL to shorten it. For example, https://www.wikipedia.org/" autocomplete = "off">
				
				<!-- Email checkbox and input area -->
				
				<?php
				
				// This part will be displayed only if the email feature is enabled
				
					if(Email::$enabled)
					{
						echo "<input type = 'checkbox' name = 'check' id = 'check' onclick = 'showHide(this)'>
							  <label for='check'> <em>(optional)</em> email me the generated link </label>";
						echo "<div id = 'email' style = 'display: none'>
								 <input type = 'email' name = 'email' id = 'email' placeholder = 'someone@example.com'>
							  </div>";
					}
				?>
				
				<input type = "submit" value = "Shorten">
			</form>
		</div>
	</body>
	
</html>