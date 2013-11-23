<?php
	include 'common.php';

	$fuelUser = new User();
	
	if(isset($_POST['update_fuel_up']) && $_POST['update_fuel_up'] != 0) {
		$fuelUser->edit_fuelup($_POST['got_fuel_date'], $_POST['got_fuel_curr_mileage'], $_POST['got_fuel_ppg'], $_POST['got_fuel_total_cost'], $_SESSION['user_id'], 
		$_POST['got_fuel_car_id'], $_POST['update_fuel_up']);
		header('Location: ../../user_profile.php');
	} else {
		$fuelUser->add_got_fuel($_POST['got_fuel_date'], $_POST['got_fuel_curr_mileage'], $_POST['got_fuel_ppg'], $_POST['got_fuel_total_cost'], $_SESSION['user_id'], $_POST['got_fuel_car_id']);
		header('Location: ../../user_profile.php');
	}
?>