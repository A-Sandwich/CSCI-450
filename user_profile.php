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
					$active = 'car-active';
					foreach ($profileUser->cars as $car) {
						echo '<span class="'.$active.' car"><img class="'.$active.' car" src="assets/images/glyphicons_free/glyphicons/png/glyphicons_005_car.png" style="margin-left: 120px;"/> ';
						echo $car[0] . ' ' . $car[1].'</span>';
						$active = '';
					}
				?>
			</div> 
			<div class="col-lg-4">
				<h3><?php echo''.$profileUser->cars[0][2].' odometer:'?></h3>
				<div class="counter7-container">
			        <div class="counter7"></div>
			    </div>
			    <div>
			    	<form class="form-horizontal" name="got_repair_form" id="got_repair_form" action="assets/files/process_got_repair.php">
			    		<h4>Got repair</h4>
			    		<input type="date" class="form-control" name="got_repair_date" />
			    		<input type="text" class="form-control" name="got repair_details" placeholder="details.. details.. details.." />
			    		<input type="number" class="form-control" name="got_repair_current_mileage" placeholder="current mileage"/>
			    		<input type="submit" class="form-control btn btn-primary" name="got_repair_submit" />
			    	</form>
			    </div>
		    </div>
		    <div class="col-lg-offset-2 col-lg-4">
		    	<h3>Fuel Economy:</h3>
		    	<div>
		    		<form class="form-horizontal" name="got_fuel_form" id="got_fuel_form" action="assets/files/process_got_fuel.php">
		    			<h4>Got fuel</h4>
		    			<input type="date" class="form-control" name="got_fuel_date"/>
		    			<input type="number" class="form-control" name="got_fuel_curr_mileage" placeholder="current mileage"/>
		    			<input type="text" class="form-control" name="got_fuel_ppg" placeholder="price per gallon e.g. 3.189" />
		    			<input type="text" class="form-control" name="got_fuel_total_cost" placeholder="total cost e.g. 45.27" />
		    			<input type="submit" class="form-control btn btn-primary" name="got_fuel_submit"/>
		    		</form>
		    	</div>
		    </div>
		</div>
	</div>
	<?php
		echo"
			<script>
				$(document).ready( function () {
		            $('.counter7').jOdometer({
		                counterStart:'".$profileUser->cars[0][3]."', 
		                counterEnd: '".$profileUser->cars[0][3]."',
		                numbersImage: 'assets/images/jodometer-numbers-24pt.png', 
		                widthNumber: 32,
		                heightNumber: 54,
		                spaceNumbers: 0, 
		                offsetRight:-10,
		                maxDigits: 10,
		                speed: 0
		            });
		
				});
			</script>
		"
	?>
	<script type="text/javascript">
		function showChangePicForm() {
				$("#profile_pic").html("<form action='assets/upload_profile_pic.php' method='post' enctype='multipart/form-data'> <input type='file' name='ppfile' id='ppfile'> <input type='submit' name='submit' value='Submit'></form>");
		}
		$(document).ready(function(){
			$('.car').click(function(){
				$('.car-active').removeClass('car-active');
				$(this).addClass('car-active');
			});
		})		
	</script>
</body>
<footer>
	
</footer>