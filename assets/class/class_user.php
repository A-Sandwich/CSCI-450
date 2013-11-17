<?php
# User class for Novus Garage
include_once 'class_entity.php';
include_once 'class_car.php';
include_once __DIR__.'/../db_connect.php';

class User extends Entity {
	
	// Gets db and data from Entity
	public $cars;
	public $pic_path;
	public $fuelups;
	
	function __construct($uId=NULL) {
		$this->db = new mysqli(HOST, USER, PASSWORD, DATABASE);
		
		if($uID == NULL) {
			// General user	
		}
		else {
			// Actual user
		}
	}	
		
	function isLoggedIn() {
		$loggedIn = false;
		if(isset($_SESSION['user_id'])){
			$loggedIn = true;
		};
		return $loggedIn;
	}
	
	function fillOutProfile() {
		// set the different things that should show up on the profile page
		/*Get profile pic*/
		$user_id = $_SESSION['user_id'];
		$get_profile_pic_path_query = $this->db->prepare("SELECT prof_pic_path FROM users WHERE id = '$user_id'");
		$get_profile_pic_path_query->execute();
		$get_profile_pic_path_query->bind_result($this->pic_path);
		$get_profile_pic_path_query->store_result();
		$get_profile_pic_path_query->fetch();
		$get_profile_pic_path_query->close();
		
		/* show users cars */
		$general_car = new Car();
		$this->cars = $general_car->getUserCars($_SESSION['user_id']);
		
		/* Get users fuel history 
		foreach ($this->cars as $car) {
			$get_fuel_purchases_query = $this->db->prepare("SELECT date, current_mileage, ppg, cost FROM fuel_purchases WHERE ");
		} */
		
		/* Get users fuel history */
		$get_fuel_purchases_query = $this->db->prepare("SELECT date, current_mileage, ppg, cost, userCarId FROM fuel_purchases WHERE user_id = ? LIMIT 5");
		$get_fuel_purchases_query->bind_param('i', $_SESSION['user_id']);
		$get_fuel_purchases_query->execute();
		$get_fuel_purchases_query->bind_result($n[0], $n[1], $n[2], $n[3], $n[4]);
		while($get_fuel_purchases_query->fetch()) {
			$this->fuelups[] = $n;
		}
	}
	
	function add_got_fuel($got_fuel_date, $got_fuel_mileage, $got_fuel_ppg, $got_fuel_total_cost, $uid, $userCarId) {
		$add_fuel_purchase_query = $this->db->prepare('INSERT INTO fuel_purchases (date, current_mileage, ppg, cost, user_id, userCarId) VALUES (?,?,?,?,?,?)');
		$add_fuel_purchase_query->bind_param('siddii',$got_fuel_date, $got_fuel_mileage, $got_fuel_ppg, $got_fuel_total_cost, $uid, $userCarId);
		$add_fuel_purchase_query->execute();
		$add_fuel_purchase_query->close();
	}
	
	function add_got_repair($got_repair_date, $got_repair_part, $got_repair_service, $got_repair_mileage, $got_repair_car_id)  {
		$add_repair_query = $this->db->prepare('INSERT INTO repair_temp (date, part, service, mileage, user_id, car_id)
												VALUES (?,?,?,?,?,?)');
		$add_repair_query->bind_param('sssiii', $got_repair_date, $got_repair_part, $got_repair_service, $got_repair_mileage, $_SESSION['user_id'], $got_repair_car_id);
		$add_repair_query->execute();
		$add_repair_query->close();
	}
	
}

?>