<?php
include "db_connect.php";
include "functions.php";
sec_session_start(); 
 
if(isset($_POST['carName'], $_POST['mileage'], $_POST['carMake'], $_POST['carModel'], $_POST['carYear'], $_POST['carColor'], $_POST['vin'], $_POST['engineType'])) {
	$carName = $_POST['carName']; $mileage = $_POST['mileage']; $carMake = $_POST['carMake'];
	$carModel = $_POST['carModel']; $carYear = $_POST['carYear']; $carColor = $_POST['carColor'];
	$vin = $_POST['vin']; $engineType = $_POST['engineType'];
		
	// Check if the car entered by the user is in the extensive car table
	$check_if_car_exists_query = $mysqli->prepare('SELECT ID FROM cars
												   WHERE Make = ?
												   AND Model = ?
												   AND Year = ? 
												   LIMIT 1');
	$check_if_car_exists_query->bind_param('sss', $carMake, $carModel, $carYear);
	$check_if_car_exists_query->execute();
	$check_if_car_exists_query->bind_result($car_id);
	$check_if_car_exists_query->store_result();
	if($check_if_car_exists_query->num_rows > 0) {
		echo 'I made it through that if bro.';
		$insert_user_car_query = $mysqli->prepare('INSERT INTO users_cars (car_nickname, mileage, vin, car_id, color, user_id) VALUES (?,?,?,?,?,?)');
		$insert_user_car_query->bind_param('sisisi', $carName, $mileage, $vin, $car_id, $carColor, $_SESSION['user_id']);
		$insert_user_car_query->execute();
	}   // Enter users car information into users_cars table if it exists in the extensive car table already
	else {
		$insert_user_car_query = $mysqli->prepare('INSERT INTO users_cars (car_nickname, mileage, make, model, year, vin, car_id, engine_type, color, user_id) 
												   VALUES (?,?,?,?,?,?,?,?,?,?)');
		$insert_user_car_query->bind_param('sissisidsi', $carName, $mileage, $carMake, $carModel, $carYear, $vin, $car_id, $engineType, $carColor, $_SESSION['user_id']);
		$insert_user_car_query->execute();
	}   // Enter users car information into users_cars tables if it doesn't exist yet in the extensive car table
	
	// Redirect users to the index page
	header('Location: ../index.php');
}       
