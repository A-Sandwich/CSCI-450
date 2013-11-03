<?php
	# Car class for Novus Garage
	
class Car extends Entity {
	// Gets db and data from Entity
	
	public $cars;
	
	function __construct($carId=NULL) {
		$this->db = new mysqli(HOST, USER, PASSWORD, DATABASE);
		
		if($carID == NULL) {
			// General user	
		}
		else {
			// Actual user
		}	
	}
	
	function getUserCars($uId) {
		// Take user id and query database for their cars, return an array in data
		$get_user_cars_query = $this->db->prepare("SELECT car_id, make, model FROM users_cars
												   WHERE user_id = '$uID'");
		$result = $get_user_cars_query->execute();
		while($row = $result->fetch_assoc()){
			$cars[] = $row;
		}
	}
}
	
?>