<?php
	include 'assets/functions.php';

	sec_session_start();

	
	$loggedIn = false;
	if(isset($_SESSION['user_id'])){
		$userid = $_SESSION['user_id'];
		$username = $_SESSION['username'];
		$loggedIn = true;
	};//end if
?>