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
   	
}
else
{ 
	header('Location: ../login.php');
}