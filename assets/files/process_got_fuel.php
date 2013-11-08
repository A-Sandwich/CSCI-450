<?php
	include 'common.php';

	$fuelUser = new User();
	$fuelUser->add_got_fuel($_POST['got_fuel_date'], $_POST['got_fuel_curr_mileage'], $_POST['got_fuel_ppg'], $_POST['got_fuel_total_cost'], $_SESSION['user_id']);
	header('Location: ../../user_profile.php');
?>