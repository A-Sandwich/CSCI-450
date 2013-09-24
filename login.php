<?php
include "assets/db_connect.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="assets/bootstrap-3/assets/ico/favicon.png">
		
		<title>Novus Garage - Sign In</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="assets/bootstrap-3/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="assets/bootstrap-3/assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/bootstrap-3/assets/css/signIn.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="assets/bootstrap-3/assets/css/master.css" rel="stylesheet">
		
		
		<script src="assets/js/sha512.js"></script>
		<script src="assets/js/forms.js"></script>
			
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../../assets/js/html5shiv.js"></script>
			<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<body>
	<h1 class="signIn">Novus Garage</h1>
		<div class="container">
			<form class="form-signin" action="assets/process_login.php" method="post">
				<input type="text" class="form-control" name="email" id="email" Placeholder="Email Address" autofocus>
				<input type="password" class="form-control" name="password" Placeholder="Password">
				<label class="checkbox">
					<input type="checkbox" value="remember-me"> Remember Me
				</label>
				<button class="btn btn-lg btn-block btn-primary signIn" type="submit" onclick="formhash(this.form, this.form.password)">Sign In</button>
			</form>
		</div>
  
  
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script>
			// Functions
			function emailIsValid(email) {
				var rex = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
				return rex.test(email);
			}	// checks the pattern of the email address that was entered and returns bool emailIsValid
		</script>
	   
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="assets/bootstrap-3/assets/js/bootstrap.min.js"></script>

	</body>
</html>	