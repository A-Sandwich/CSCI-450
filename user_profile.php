<?php
	include 'assets/db_connect.php';
	require_once 'assets/files/loggedIn.php';
	
	if($loggedIn) { // The user is logged in
		// get some useful information about the user from the session array
		$username = $_SESSION['username'];
	} else { // The user is not logged in 
		header('Location: ./index.php'); // send the user back to the index page-- he/she is not logged in anyway why the hell not
	}	
?>

<!-- Kyle, work your magic here --> 
	<p> I'm a lonely blank page with no contents to call my own </p> 
<!-- /Kyle, work your magic here -->