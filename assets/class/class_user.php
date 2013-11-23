<?php
# User class for Novus Garage
include_once 'class_entity.php';
include_once 'class_car.php';
include_once __DIR__.'/../db_connect.php';

class User extends Entity {
	
	// Gets db and data from Entity
	public $cars; // Stores all users car information from users_cars in a multidimensional array
	public $pic_path; // Stores a users profile picture path to location of the file on server
	public $fuelups; // Stores all a users fuel purchases in multidimensional array
	public $myspecs; // Stores all a users cars + specs in multidimensional array
	
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
		$this->fuelups = array();
		while($get_fuel_purchases_query->fetch()) {
			$this->fuelups[] = $n;
		}
		
		/* Get users car specs 
		$this->myspecs = $general_car->getAllSpecs($_SESSION['user_id']);*/
	}
	
	function add_got_fuel($got_fuel_date, $got_fuel_mileage, $got_fuel_ppg, $got_fuel_total_cost, $uid, $userCarId) {
		$add_fuel_purchase_query = $this->db->prepare('INSERT INTO fuel_purchases (date, current_mileage, ppg, cost, user_id, userCarId) VALUES (?,?,?,?,?,?)');
		$add_fuel_purchase_query->bind_param('siddii',$got_fuel_date, $got_fuel_mileage, $got_fuel_ppg, $got_fuel_total_cost, $uid, $userCarId);
		$add_fuel_purchase_query->execute();
		$add_fuel_purchase_query->close();
		
		// update the new mileage
		$update_mileage_query = $this->db->prepare("UPDATE users_cars SET mileage = '$got_fuel_mileage' WHERE user_id = '$uid' AND id = '$userCarId'");
		$update_mileage_query->execute();
		$update_mileage_query->close();
	}
	
	function edit_fuelup($new_date, $new_mileage, $new_ppg, $new_total_cost, $uid, $userCarId, $fuel_up_unique_row_id) {
		
		$figure_out_current_mileage_query = $this->db->prepare("SELECT mileage FROM users_cars WHERE user_id = '$uid' AND id='$userCarId'");
		$figure_out_current_mileage_query->execute();
		$figure_out_current_mileage_query->bind_result($old_miles);
		$figure_out_current_mileage_query->store_result();
		$figure_out_current_mileage_query->fetch();
		$figure_out_current_mileage_query->close();
		
		$edit_fuelup_query = $this->db->prepare("UPDATE fuel_purchases SET date = '$new_date' , current_mileage = '$new_mileage', ppg = '$new_ppg', cost = '$new_total_cost'
							 WHERE ID = '$fuel_up_unique_row_id' ");
		$edit_fuelup_query->execute();
		$edit_fuelup_query->close();
		
		if($old_miles < $new_mileage) {
			$update_mileage_query = $this->db->prepare("UPDATE users_cars SET mileage = '$new_mileage' WHERE user_id = '$uid' AND id = '$userCarId'");
			$update_mileage_query->execute();
			$update_mileage_query->close();
		}
	}
	
	function add_got_repair($got_repair_date, $got_repair_part, $got_repair_service, $got_repair_mileage, $got_repair_car_id)  {
		$add_repair_query = $this->db->prepare('INSERT INTO repair_temp (date, part, service, mileage, user_id, car_id)
												VALUES (?,?,?,?,?,?)');
		$add_repair_query->bind_param('sssiii', $got_repair_date, $got_repair_part, $got_repair_service, $got_repair_mileage, $_SESSION['user_id'], $got_repair_car_id);
		$add_repair_query->execute();
		$add_repair_query->close();
	}
	
	function edit_repair ($new_date, $new_part, $new_service, $new_mileage, $got_repair_car_id, $repair_unique_row_id) {
		$userid=$_SESSION['user_id'];
		$figure_out_current_mileage_query = $this->db->prepare("SELECT mileage FROM users_cars WHERE user_id = '$userid' AND id='$got_repair_car_id'");
		$figure_out_current_mileage_query->execute();
		$figure_out_current_mileage_query->bind_result($old_miles);
		$figure_out_current_mileage_query->store_result();
		$figure_out_current_mileage_query->fetch();
		$figure_out_current_mileage_query->close();
		
		$edit_repair_query = $this->db->prepare("UPDATE repair_temp SET date='$new_date', part='$new_part', service='$new_service', mileage='$new_mileage'");
		$edit_repair_query->execute();
		$edit_repair_query->close();
		
		if($old_miles < $new_mileage) {
			$update_mileage_query = $this->db->prepare("UPDATE users_cars SET mileage = '$new_mileage' WHERE user_id = '$uid' AND id = '$userCarId'");
			$update_mileage_query->execute();
			$update_mileage_query->close();
		}
	}
	
	function update_most_recent_mileage($uId) {
		
		$get_users_car_ids_query = $this->db->prepare("SELECT id FROM users_cars WHERE user_id = '$uId' ");
		$get_users_car_ids_query->execute();
		$get_users_car_ids_query->bind_result($cId);
		$users_cars = array();
		while($get_users_car_ids_query->fetch()){
			$users_cars[] = $cId;
		}
		$mileages = array();
		foreach($users_cars as $i) {
			$highest_mileage_from_repairs_query = $this->db->prepare("SELECT mileage FROM repair_temp WHERE user_id = '$uId' AND car_id='$i' ORDER BY mileage DESC LIMIT 1");
			$highest_mileage_from_repairs_query->execute();
			$highest_mileage_from_repairs_query->bind_result($r_highest);
			$highest_mileage_from_repairs_query->store_result();
			$highest_mileage_from_repairs_query->fetch();
			$highest_mileage_from_repairs_query->close();
			if($r_highest != NULL) {
				 $mileages[$i] = $r_highest; 
			}
			
			$highest_mileage_from_fuelups_query = $this->db->prepare("SELECT current_mileage FROM fuel_purchases WHERE user_id = '$uId' AND userCarId='$i' ORDER BY current_mileage DESC LIMIT 1");
			$highest_mileage_from_fuelups_query->execute();
			$highest_mileage_from_fuelups_query->bind_result($f_highest);
			$highest_mileage_from_fuelups_query->store_result();
			$highest_mileage_from_fuelups_query->fetch();
			$highest_mileage_from_fuelups_query->close();
			if($f_highest != NULL && $f_highest > $mileages[$i]) {
				 $mileages[$i] = $f_highest; 
			}
			$update_users_cars_mileage_query = $this->db->prepare("UPDATE users_cars SET mileage = '$mileages[$i]' WHERE user_id='$uID' AND id='$i'");
			$update_users_cars_mileage_query->execute();
			$update_users_cars_mileage_query->close();
		}
	}
}

?>