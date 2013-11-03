<?php
	define("BASE_URL","http://novusgarage.x10.mx/");
	# User class related
	require_once __DIR__.'/../class/class_user.php';
	$user_general = new User();
	$loggedIn = $user_general->isLoggedIn();
?>