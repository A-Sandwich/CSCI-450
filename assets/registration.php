<?php
include "db_connect.php";
include "functions.php";
sec_session_start(); 
 
if(isset($_POST['email'], $_POST['p']))
{ 
   	$email = $_POST['email'];
	$username = $_POST['name'];
	$dob = $_POST['bday'];	
   	$password = $_POST['p']; // The hashed password in its totally secret field

	$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
	$password = hash('sha512', $password.$random_salt);
	
	// Check if this is a new user or they already have an account
	$new_user_check_query = $mysqli->prepare("SELECT email FROM users
											  WHERE email = '$email'
											  LIMIT 1");
    $new_user_check_query->execute();
	$new_user_check_query->bind_result($ifemail);
	$new_user_check_query->store_result();
	if($new_user_check_query->num_rows < 1) {
		// This IS a new user, no email address from the database matches the one they entered
		
		$insert_new_user_query = $mysqli->prepare("INSERT INTO users (username, email, password, salt, dob) VALUES ('$username','$email','$password','$random_salt','$dob')");
		$insert_new_user_query->execute();
		
		
		// Email the new user their registration details
		$to = $email;
		$subject = "Welcome to Novus Garage";
		$message = "
		<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="Novus" content="">
			
			<!-- Bootstrap core CSS -->
			<link href="bootstrap-3/assets/css/bootstrap.min.css" rel="stylesheet">
	
			<!-- Custom styles for this template -->
			<link href="bootstrap-3/assets/css/offcanvas.css" rel="stylesheet">
	
			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			
			<![endif]-->
			
			<link href="css/master.css" rel="stylesheet">
		</head>
			<body>
				<div class='feed col-xs-12 col-sm-offset-3 col-sm-6'>
					<div class="text">
						<span style='font-size: 2em;'>Novus Garage</span><br>
						<span style='font-size:1.3em;'>Welcome to true responsible car ownership</span>
					</div><br>
					<p> Hey, <strong><em>".$username."</em></strong>, we just wanted to let you know we appreciate you <br>registering with us and remind you your account details (as if you would forget!)...</p>
					<div>
						<p><strong>Username: </strong>".$username."<br>
						<strong>email: </strong>".$email."<br>
						<strong>date of birth: </strong>".$dob." <br>
						</p>
					</div>
					<p>Thanks for letting us help you be the most responsible car owner you can be! <br>Now that you Novus, <a href='http://www.novus.site90.com/login.php'>Log into your Novus Garage account!</a></p>
					
					<br><br><p>Sincerely, <br><br>
					Us Novus Geeks</p>
				</div>
			</body>
		</html>
		";
		$from = "noreply@novus.site90.com";
		$headers  = "MIME-Version: 1.0\r\n";
	 	$headers .= "Content-type: text/html; charset: utf8\r\n";
	 	$headers .= "From: ". $from . "\r\n";
		mail($to,$subject,$message,$headers);
		
		// Send the user to the login page
		header('Location: ../login.php');
	} else {
		// this is NOT a new user, an email address already exists in the users table of the database matching theirs 
		header('Location: ../login.php?fail=1');
	}	
} else { 
	header('Location: ../login.php');
}