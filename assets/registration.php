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
		<body style='background-color:#CCE0FF; color: #001F4C;'>
			<h2>Novus Garage</h2>
			<h3>Welcome to true responsible car ownership</h3>
			<p> Hey,".$username.", we just wanted to let you know we appreciate you registering with us and remind you your account details (as if you would forget!)...</p>
			<h4>Account details</h4>
			<p>username: ".$username."<br>
			email: ".$email."<br>
			date of birth: ".$dob." <br>
			</p>
			<p>Thanks for letting us help you be the most responsible car owner you can be!</p>
			<p>Novus</p>
		</body>
	</html>
	";
	$from = "noreply@novus.site90.com";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
	   	
}
else
{ 
	header('Location: ../login.php');
}