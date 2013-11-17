<?php
include "files/db_connect.php";
include "functions.php";
sec_session_start(); 
 
if(isset($_POST['carName'], $_POST['mileage'], $_POST['carMake'], $_POST['carModel'], $_POST['carYear'], $_POST['carColor'], $_POST['vin'], $_POST['engineType'])) {
	$carName = $_POST['carName']; $mileage = $_POST['mileage']; $carMake = $_POST['carMake'];
	$carModel = $_POST['carModel']; $carYear = $_POST['carYear']; $carColor = $_POST['carColor'];
	$vin = $_POST['vin']; $engineType = $_POST['engineType'];
		
	//Check if the car entered by the user is in the extensive car table
	$check_car_exists_query = $mysqli->prepare('SELECT ID FROM cars WHERE Make = ? AND Model = ? AND Year = ? AND Engine = ? LIMIT 1');
	$check_car_exists_query->bind_param('ssis', $carMake, $carModel, $carYear, $engineType);
	$check_car_exists_query->execute();
	$check_car_exists_query->bind_result($car_id);
	$check_car_exists_query->store_result();
	$check_car_exists_query->fetch();
	
	$insert_user_car_query = $mysqli->prepare('INSERT INTO users_cars (car_nickname, mileage, make, model, year, vin, car_id, engine_type, color, user_id) 
											   VALUES (?,?,?,?,?,?,?,?,?,?)');
	$insert_user_car_query->bind_param('sissisissi', $carName, $mileage, $carMake, $carModel, $carYear, $vin, $car_id, $engineType, $carColor, $_SESSION['user_id']);
	$insert_user_car_query->execute();
	$insert_user_car_query->close();
	
	// Redirect users to the index page
	header('Location: ../user_profile.php');
}       
