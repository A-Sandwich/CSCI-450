<?php
include "db_connect.php";
include "functions.php";
sec_session_start(); 
 
if(isset($_POST['email'], $_POST['p']))
{ 
   	$email = $_POST['email'];
   	$password = $_POST['p']; // The hashed password in its totally secret field
   	if(login($email, $password, $mysqli) == true)
	{
      	// Login success
      	header('Location: ./index.php');
   	}
	else
	{
      	// Login failed
      	header('Location: ./index.php');
   	}
}
else
{ 
	header('Location: ./login.php');
}