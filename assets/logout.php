<?php
require_once 'files/loggedIn.php';

if(isset($_GET['logout'])) {
	$_SESSION = array();
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	session_destroy();
	echo $_SESSION['username'];
	header('Location: ../index.php');
}
