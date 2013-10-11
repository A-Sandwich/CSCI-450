<?php
	include 'assets/logout.php';
	include 'assets/db_connect.php';
	require_once 'assets/files/loggedIn.php';
	
	if($loggedIn) { // The user is logged in
		// get some useful information about the user from the session array
		$username = $_SESSION['username'];
	} else { // The user is not logged in 
		header('Location: ./index.php'); // send the user back to the index page-- he/she is not logged in anyway why the hell not
	}	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Novus" content="">
		<link rel="shortcut icon" href="assets/bootstrap-3/assets/ico/favicon.png">

		<title>Profile Page</title>

		<!-- Bootstrap core CSS -->
		<link href="assets/bootstrap-3/assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="assets/bootstrap-3/assets/css/offcanvas.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="bootstrap-3/assets/js/html5shiv.js"></script>
			<script src="bootstrap-3/assets/js/respond.min.js"></script>
		<![endif]-->
		
		<link href="assets/css/master.css" rel="stylesheet">
		
	</head>

<body>
	<?php
		require 'assets/files/navigation.php';
	?>
	<div class="col-lg-offset-1 col-lg-2" id="picture_wrapper">
		<div class="change_pic" style="position:absolute; top:50px; padding:15px; z-index:0; opacity:0;">Click here to change your profile picture!<h1>+</h1></div>
		<img style="z-index:1;" src="/assets/images/profile_pic.jpg" alt="Smiley face" class="profile_pic">
	</div>
	
	<div class="profile col-lg-offset-2 col-lg-8">
		<div class="profile_feed col-lg-offset-1 col-lg-11">
			<h2><?PHP echo''.$username.''?></h2>
			<!-- Kyle, work your magic here --> 
				<p> I'm a lonely blank page with no contents to call my own </p> 
			<!-- /Kyle, work your magic here -->
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script>
		$(document).ready( function () {
			$("#picture_wrapper").mouseenter(function () {
				$(".profile_pic").fadeTo(400, .1);
				$(".change_pic").fadeTo(400, 1);
			});
			$("#picture_wrapper").mouseleave(function () {
				$(".profile_pic").fadeTo(400, 1);
				$(".change_pic").fadeTo(400, 0);
			});
		});
	</script>
</body>
<footer>
	
</footer>