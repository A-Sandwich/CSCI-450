<?php
	include 'assets/logout.php';
	include 'assets/db_connect.php';
	require_once 'assets/files/loggedIn.php';
	require_once 'assets/class/class_user.php';
	require_once 'assets/class/class_car.php';
	
	if($loggedIn) { // The user is logged in
		// get some useful information about the user from the session array
		$username = $_SESSION['username'];
	} else { // The user is not logged in 
		header('Location: ./index.php'); // send the user back to the index page-- he/she is not logged in anyway why the hell not
	};
	
		
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
			
			<div id="templateLocation">
		
			</div>
			<div class="jumbotron garage" style="overflow-x:auto;"><!--User's Garage-->
				<?php
					$active = 'car-active';
					foreach ($profileUser->cars as $car) {
						echo '<span name="'.$car[5].'" class="'.$active.' car"><img name="'.$car[5].'" class="'.$active.' car" src="assets/images/glyphicons_free/glyphicons/png/glyphicons_005_car.png" style="margin-left: 120px;"/> ';
						echo $car[0] . ' ' . $car[1].'</span>';
						$active = '';
					}

				?>
			</div>

			<div class="col-lg-4">
				<?php
					$active = '';
					$counter = 0;
					echo'<div id="odometer_headers">';
					foreach ($profileUser->cars as $car) {
						echo'<h3 class="'.$active.' odometer_header">'.$profileUser->cars[$counter][2].' odometer:</h3>';
						$counter ++;
						$active = 'invisible';
					};
					echo'</div>'
				?>
				

				
				<?php
									$counter = 0;
									$visible = 'counter-active';
									foreach ($profileUser->cars as $car) {
										echo'
											<div class="counter'.$counter.'-container odometer '.$visible.'">
												<div class="counter'.$counter.'"></div>
											</div>
										';
										$visible = 'invisible';
										$counter++;
									}
								?>
								<div>
									<form class="form-horizontal" name="got_repair_form" id="got_repair_form" action="assets/files/process_got_repair.php" method="post">
										<h4>Got repair</h4>
										<input id="maintenance_date" type="date" class="form-control" name="got_repair_date" />
										<input id="maintenance_parts" type="text" class="form-control" name="got_repair_part" placeholder="part? or.." />
										<input id="maintenance_service" type="text" class="form-control" name="got_repair_service" placeholder="service?" />
										<input id="maintenance_mileage" type="number" class="form-control" name="got_repair_current_mileage" placeholder="current mileage"/>
										<input type="number" id="repairCarId" class="form-control invisible" value"0" name="got_repair_car_id"/>
										<input type="number" id="updateRepairCarId" class="form-control invisible" value="0" name="update_repair"/>
										<input type="submit" class="form-control btn btn-primary" name="got_repair_submit" />
									</form>
								</div>
							
								<h3>Repairs:</h3>
								<?php
									$newCar = new Car();
									$active = '';
									echo'<div class="repair">';
									foreach ($profileUser->cars as $car) {
										echo'<div class="car_repair '.$active.'">';
										$maintenaces_data = $newCar->getMaintenances($car[5]); // car[5] is the userCarId column from the users_cars table
										foreach($maintenaces_data as $maintenance){
											echo'<div class="individual_maintenance" name="'.$maintenance[6].'">';
											echo'<h4><strong>Date:</strong><div class="maintenance_date" style="display: inline">'.$maintenance[0].'</div></h4>';
											if($maintenance[1] != ''){
												echo'<strong>Part(s) used: </strong><div class="maintenance_parts" style="display: inline">'.$maintenance[1].'</div><br />';
											}
											if($maintenance[2] != ''){
												echo'<strong>Service: </strong><div class="maintenance_service" style="display: inline">'.$maintenance[2].'</div><br />';
											}
											echo'<strong>Mileage: </strong><div class="maintenance_mileage" style="display: inline">'.$maintenance[3].'</div><br />';
											echo'<button class="invisible edit_maintenance form-control btn btn-primary btn-xs" value="edit" name="'.$maintenance[6].'"/>Edit</button>';
											echo'</div>';
										}
										echo'</div>';
										$active = 'invisible';
									}
									echo'</div>'
								?>
							</div>
							<div class="col-lg-offset-2 col-lg-4">
								<h3>Fuel Economy:</h3>
								
								<?php
									$fuel_economy = $newCar->calculateFuelEconomy($_SESSION['user_id']);
									$active = '';
									echo'<div class="mpg">';
									foreach ($fuel_economy as $mpg){
										echo'<h3 class="individual_mpg '.$active.'">'.$mpg.' mpg</h3>';
										$active = 'invisible';
									};
									echo'</div>';
								?>
								
								<span id="show_fuel" style="white-space: nowrap ;display: inline-block;"> <h4 style="white-space: nowrap ;display: inline-block;">Got fuel</h4><span style="white-space: nowrap ;display: inline-block;" class = "glyphicon glyphicon-chevron-down"></span></span>
								
								<div id="fuelForm">
									<form class="form-horizontal" name="got_fuel_form" id="got_fuel_form" action="assets/files/process_got_fuel.php" method="post">
										<input type="date" id="fuel_date" class="form-control" name="got_fuel_date"/>
										<input type="number" id="fuel_mileage" class="form-control" name="got_fuel_curr_mileage" placeholder="current mileage"/>
										<input type="text" id="fuel_ppg" class="form-control" name="got_fuel_ppg" placeholder="price per gallon e.g. 3.189" />
										<input type="text" id="fuel_cost" class="form-control" name="got_fuel_total_cost" placeholder="total cost e.g. 45.27" />
										<input type="number" id="fuelCarId" value="0" class="form-control invisible" name="got_fuel_car_id"/>
										<input type="number" id="updateFuelCarId" value="0" class="form-control invisible" name="update_fuel_up"/>
										<input type="submit" class="form-control btn btn-primary" name="got_fuel_submit"/>
									</form>
								</div>
								<h3>Past Fuel Ups:</h3>
								<?php
									$newCar = new Car();
									$active = '';
									echo'<div class="fuel_ups">';
									foreach ($profileUser->cars as $car) {
										echo'<div class="car_fuel_up '.$active.'">';
										$fuel_up_info = $newCar->getFuelUps($car[5]); // car[5] is the userCarId column from the users_cars table
										foreach($fuel_up_info as $fuel){
											echo'<div class="individual_fuel_up" name="'.$fuel[6].'">';
											echo'<h4><strong>Date:</strong>'.$fuel[0].'</h4>';
											echo'<p>';
											echo'<strong>Mileage: </strong>'.$fuel[1].'<br />';
											echo'<strong>Price Per Gallon: </strong>'.$fuel[2].'<br />';
											echo'<strong>Total Cost: </strong>'.$fuel[3].'<br />';
											echo'</p>';
											echo'<button class="invisible edit_fuel form-control btn btn-primary btn-xs" value="edit" name="'.$fuel[6].'"/>Edit</button>';
											echo'<div class="fuel_data invisible"><p class="date">'.$fuel[0].'</p>';
											echo'<p class="mileage">'.$fuel[1].'</p>';
											echo'<p class="ppg">'.$fuel[2].'</p>';
											echo'<p class="cost">'.$fuel[3].'</p></div>';
											echo'</div>';
										}
										echo'</div>';
										$active = 'invisible';
									}
									echo'</div>'
								?>
				
			</div>
		</div>
	</div>
	
	
	<?php
		$counter = 0;
		foreach ($profileUser->cars as $car) {
			echo"
				<script>
					$(document).ready( function () {
			            $('.counter".$counter."').jOdometer({
			                counterStart:'".$profileUser->cars[$counter][3]."', 
			                counterEnd: '".$profileUser->cars[$counter][3]."',
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
				
				<style>
					.counter".$counter."{
					    width:100%;
					    height:55px;
					    overflow:hidden;
					    position:relative;
					    background-color:transparent;
					}
				
					.counter".$counter."-container{
				            height:55px;
				            overflow:hidden;
				            position:relative;
				            border: 1px solid #ccc;
				            border-radius: 2px;
				            background-image: url('assets/images/jodometer-background.jpg');
				            background-repeat: repeat-x;
				            width: 288px;
			        }
				</style>
			";
			$counter++;
		};
	?>
	<script type="text/javascript">
		function showChangePicForm() {
				$("#profile_pic").html("<form action='assets/upload_profile_pic.php' method='post' enctype='multipart/form-data'> <input type='file' name='ppfile' id='ppfile'> <input type='submit' name='submit' value='Submit'></form>");
		}
		$(document).ready(function(){
			$('.car').click(function(){
				$($('.car_repair')[$('.car-active').index()]).addClass('invisible');
				$($('.individual_mpg')[$('.car-active').index()]).addClass('invisible');
				$($('.odometer')[$('.car-active').index()]).addClass('invisible');
				$($('.odometer_header')[$('.car-active').index()]).addClass('invisible');
				$($('.car_fuel_up')[$('.car-active').index()]).addClass('invisible');
				$('.car-active').removeClass('car-active');
				$(this).addClass('car-active');
				$($('.odometer')[$(this).index()]).removeClass('invisible');
				$($('.odometer_header')[$(this).index()]).removeClass('invisible');
				$($('.car_fuel_up')[$(this).index()]).removeClass('invisible');
				$($('.car_repair')[$(this).index()]).removeClass('invisible');
				$($('.individual_mpg')[$(this).index()]).removeClass('invisible');
				
				//Associates form with selected car
				$('#fuelCarId').val(this.getAttribute('name'));
				$('#repairCarId').val(this.getAttribute('name'));
				
				//Resets edit fuel fields.
				$('#updateRepairCarId').val(0);
				$('#updateFuelCarId').val(0);
			});
			
			
			$('#repairCarId').val($('.car-active')[0].getAttribute('name'));
			$('#fuelCarId').val($('.car-active')[0].getAttribute('name'));
			
			$('.individual_fuel_up').mouseenter(function(){
				$(this).children('button').removeClass('invisible');
			});
			
			$('.individual_fuel_up').mouseleave(function(){
				$(this).children('button').addClass('invisible');
			});
			
			$('.individual_maintenance').mouseenter(function(){
				$(this).children('button').removeClass('invisible');
			});
			
			$('.individual_maintenance').mouseleave(function(){
				$(this).children('button').addClass('invisible');
			});
			
			$('.edit_fuel').click(function(){
				$('#updateFuelCarId').val(this.getAttribute('name'));
				$('#fuel_date').val($(this).siblings('.fuel_data').find('.date').html());
				$('#fuel_mileage').val($(this).siblings('.fuel_data').find('.mileage').html());
				$('#fuel_ppg').val($(this).siblings('.fuel_data').find('.ppg').html());
				$('#fuel_cost').val($(this).siblings('.fuel_data').find('.cost').html());
			});
				
			$('.edit_maintenance').click(function(){
				$('#updateRepairCarId').val(this.getAttribute('name'));
				$('#maintenance_date').val($(this).siblings('.maintenance_date').html());
				$('#maintenance_parts').val($(this).siblings('.maintenance_parts').html());
				$('#maintenance_service').val($(this).siblings('.maintenance_service').html());
				$('#maintenance_mileage').val($(this).siblings('.maintenance_mileage').html());
			});		
		
		
		});
	</script>
	
	<!-- Toggle Fuel Form -->
	<script type="text/javascript">
		$('#show_fuel').click(function(){
			$('#fuelForm').slideToggle("slow");
		});
		
	</script>
	
</body>
</html>