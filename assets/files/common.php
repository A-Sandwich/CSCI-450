<?php
	include_once __DIR__.'/../functions.php';
	sec_session_start();
	include 'logout.php';
	
	# User class related
	require_once __DIR__.'/../class/class_user.php';
	$user_general = new User();
	$loggedIn = $user_general->isLoggedIn();
	$userid = $_SESSION['user_id'];
	$username = $_SESSION['username'];
?>