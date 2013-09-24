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
	
	$insert_new_user_query = $mysqli->prepare("INSERT INTO users (username, email, password, salt, dob) VALUES ('$username','$email','$password','$random_salt','$dob')");
	$insert_new_user_query->execute();
	
	
	// Email the new user their registration details
	$to = $email;
	$subject = "Welcome to Novus Garage";
	$message = "
	<html>
		<body style='background-color:#666666; color: #FFFFFF; font-family: sans-serif;'>
			<div><span style='font-size: 2em;'>Novus Garage</span><br>
			<span style='font-size:1.3em;'>Welcome to true responsible car ownership</span></div>
			<p> Hey, <strong><em>".$username."</em></strong>, we just wanted to let you know we appreciate you <br>registering with us and remind you your account details (as if you would forget!)...</p>
			<div style='background-color: #FFFFFF; color:#333333; width:50%'>
				<p><strong>Username: </strong>".$username."<br>
				<strong>email: </strong>".$email."<br>
				<strong>date of birth: </strong>".$dob." <br>
				</p>
			</div>
			<p>Thanks for letting us help you be the most responsible car owner you can be! <br><a style='color:#FFFFFF; font-weight:bold;' href='http://www.novus.site90.com/login.php'>Log into my Novus Garage account</a></p>
			
			<br><br><p>Sincerely, <br><br>
			Us Novus Geeks</p>
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
}
else
{ 
	header('Location: ../login.php');
}