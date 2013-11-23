<?php
	include 'common.php';

	$fuelUser = new User();
	
	if(isset($_POST['update_fuel_up']) && $_POST['update_fuel_up'] != 0) {
		$fuelUser->edit_fuelup($_POST['got_fuel_date'], $_POST['got_fuel_curr_mileage'], $_POST['got_fuel_ppg'], $_POST['got_fuel_total_cost'], $_SESSION['user_id'], 
		$_POST['got_fuel_car_id'], $_POST['update_fuel_up']);
		header('Location: ../../user_profile.php');
	} else {
		if(isset($_POST['missed_fuel_up'])){
			$temp_user_id = $_SESSION["user_id"];
			$temp_user_car_id = $_POST["got_fuel_car_id"];
			$delete_fuel_purchase_query = $mysqli->prepare("DELETE FROM fuel_purchases WHERE user_id = '$temp_user_id' and userCarId = '$temp_user_car_id'");
			$delete_fuel_purchase_query->execute();
		}
		$fuelUser->add_got_fuel($_POST['got_fuel_date'], $_POST['got_fuel_curr_mileage'], $_POST['got_fuel_ppg'], $_POST['got_fuel_total_cost'], $_SESSION['user_id'], $_POST['got_fuel_car_id']);
		header('Location: ../../user_profile.php');
	}
?>