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
	<div class="col-lg-offset-1 col-lg-2 col-xs-2 col-md-2" id="picture_wrapper">
		<div id="profile_pic" class="thumbnail">
			<!--<img src="/assets/images/profile_pic.jpg" alt="Smiley face" class="profile_pic">-->
			<img data-src="holder.js/200x261" src="<?php echo 'assets/' . $profileUser->pic_path; ?>" alt="Smiley face" class="profile_pic">
		</div>
	</div>
	
	<div class="profile col-lg-offset-2 col-lg-8">
		<div class="profile_feed col-lg-offset-1 col-lg-11">
			<h2><?PHP echo''.$username.''?>
				<div class="dropdown" style="display: inline; font-size:0.8em;">
				  <a data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-cog"></i></a>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				    <li class="dropdown"><a href="#" onclick="javascript:showChangePicForm()">Change profile picture..</a></li>
				  </ul>
				</div>
			</h2> 
			
			<div class="jumbotron garage" style="overflow-x:auto;"><!--User's Garage-->
				<?php
					foreach ($profileUser->cars as $car) {
						echo '<img src="assets/images/glyphicons_free/glyphicons/png/glyphicons_005_car.png" style="margin-left: 120px;"/> ';
						foreach($car as $spec) {
							echo ' ' . $spec.' ';
						} 
					}
				?>
			</div> 
			<div class="col-lg-4">
				<h3><?php echo''.$profileUser->cars[0][2].''?></h3>
				<div class="counter7-container">
			        <div class="counter7"></div>
			    </div>
		    </div>
		    <div class="col-lg-offset-2 col-lg-4">
		    	<h3>Fuel Economy:</h3>
		    </div>
		</div>
	</div>
	<script>
		$(document).ready( function () {
            $('.counter7').jOdometer({
                counterStart:'8901', 
                numbersImage: 'assets/images/jodometer-numbers-24pt.png', 
                widthNumber: 32,
                heightNumber: 54,
                spaceNumbers: 0, 
                offsetRight:-10,
                maxDigits: 10,
            });

		});
	</script>
	
	<script type="text/javascript">
		function showChangePicForm() {
				$("#profile_pic").html("<form action='assets/upload_profile_pic.php' method='post' enctype='multipart/form-data'> <input type='file' name='ppfile' id='ppfile'> <input type='submit' name='submit' value='Submit'></form>");
		}
		$(document).ready(function(){
			
		})		
	</script>
</body>
<footer>
	
</footer>