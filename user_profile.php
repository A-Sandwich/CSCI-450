<?php
	include 'assets/logout.php';
	include 'assets/db_connect.php';
	require_once 'assets/files/loggedIn.php';
	require_once 'assets/class/class_user.php';
	
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
		<?php
			require 'assets/files/header.php';
		?>	

		<title>Profile Page</title>	
	</head>

<body>
	<?php
		require 'assets/files/navigation.php';
	?>
	<?php 
		$profileUser = new User();
		$profileUser->fillOutProfile();
	?>
	<div class="col-lg-offset-1 col-lg-2" id="picture_wrapper">
		<img src="/assets/images/profile_pic.jpg" alt="Smiley face" class="profile_pic">
	</div>
	
	<div class="profile col-lg-offset-2 col-lg-8">
		<div class="profile_feed col-lg-offset-1 col-lg-11">
			<h2><?PHP echo''.$username.''?></h2>
			<!-- Kyle, work your magic here --> 
			<div class="jumbotron garage">
				<span class="glyphicon glyphicon-car"></span>
				<?php
					foreach ($profileUser->cars as $car) {
						echo '<img src="assets/images/glyphicons_free/glyphicons/png/glyphicons_005_car.png" style="margin-left: 120px;"/> ';
						foreach($car as $spec) {
							echo ' ' . $spec.' ';
						} 
					}
				?>
			</div> 
			<!-- /Kyle, work your magic here -->
		</div>
	</div>
	<script>
		$(document).ready( function () {
			
			// more jquery stuff
		});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
		
			
		})		
	</script>
</body>
<footer>
	
</footer>