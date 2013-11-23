<?php
	# Car class for Novus Garage
	include_once 'class_entity.php';
	include_once __DIR__.'/../db_connect.php';
	
class Car extends Entity {
	// Gets db and data from Entity
	
	public $cars;
	
	function __construct($carId=NULL) {
		$this->db = new mysqli(HOST, USER, PASSWORD, DATABASE);
		
		if($carID == NULL) {
			// General car	
		}
		else {
			// Actual car
		}	
	}
	
	function getUserCars($uId) {
		// Take user id and query database for their cars, return an array in data
		$get_user_cars_query = $this->db->prepare("SELECT car_nickname, car_id, make, model, mileage, Id FROM users_cars
												   WHERE user_id = '$uId'");
		$get_user_cars_query->execute();
		$get_user_cars_query->bind_result($nickname, $cid, $make, $model, $milage, $id);
		$spec = array();
		$cars = array();
		while($get_user_cars_query->fetch()){
			$spec[0] = $make;
			$spec[1] = $model;
			$spec[2] = $nickname;
			$spec[3] = $milage;
			$spec[4] = $cid;
			$spec[5] = $id;
			$cars[] = $spec;
		}
		return $cars;
	}
	
	function getFuelUps($car_id){
		$get_user_car_fuel_up = $this->db->prepare("SELECT date, current_mileage, ppg, cost, user_id, userCarId, ID FROM fuel_purchases
												   WHERE userCarId = '$car_id'");
		$get_user_car_fuel_up->execute();
		$get_user_car_fuel_up->bind_result($date, $current_milage, $ppg, $cost, $user_id, $userCarId, $fuel_up_unique_ID);
		$all_refuels = array();
		$fuel_up = array();
		while($get_user_car_fuel_up->fetch()){
			$fuel_up[0] = $date;
			$fuel_up[1] = $current_milage;
			$fuel_up[2] = $ppg;
			$fuel_up[3] = $cost;
			$fuel_up[4] = $user_id;
			$fuel_up[5] = $userCarId;
			$fuel_up[6] = $fuel_up_unique_ID;
			$all_refuels[] = $fuel_up;
		}
		return $all_refuels;
	}
	
	function getMaintenances($car_id) {
		$get_user_car_maintenances= $this->db->prepare("SELECT date, part, service, mileage, user_id, car_id, ID FROM repair_temp 
														WHERE car_id = '$car_id'");
		$get_user_car_maintenances->execute();
		$get_user_car_maintenances->bind_result($date, $part, $service, $mileage, $user_id, $cid, $maintenances_unique_ID);
		$all_repairs = array();
		$repair = array();
		while($get_user_car_maintenances->fetch()) {
			$repair[0] = $date;
			$repair[1] = $part;
			$repair[2] = $service;
			$repair[3] = $mileage;
			$repair[4] = $user_id;
			$repair[5] = $cid;
			$repair[6] = $maintenances_unique_ID;
		}
	}
	
	/*
	function getAllSpecs($uId) {
		// using joins users_cars.car_id to cars.ID
		
		$get_all_my_specs_query = $this->db->prepare('SELECT Year, Make, Model, Engine, Fuel, Injection, Gallons, Power FROM cars JOIN users_cars ON cars.ID = users_cars.car_id');
		$get_all_my_specs_query->execute();
		$get_all_my_specs_query->bind_result($Year, $Make, $Model, $Engine, $Fuel, $Injection, $Gallons, $Power);
		$spec = array();
		$cars_with_specs = array();
		while($get_all_my_specs_query->fetch())
		{
			$spec[0]= $Year;
			$spec[1]= $Make;
			$spec[2]= $Model;
			$spec[3]= $Engine;
			$spec[4]= $Fuel;
			$spec[5]= $Injection;
			$spec[6]= $Gallons;
			$spec[7]= $Power;
			$cars_with_specs[] = $spec;
		}
		return $cars_with_specs;
	}*/
}
	
?>