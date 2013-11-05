<?php
# User class for Novus Garage
include_once 'class_entity.php';
include_once 'class_car.php';
include_once __DIR__.'/../db_connect.php';

class User extends Entity {
	
	// Gets db and data from Entity
	public $cars;
	public $pic_path;
	
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
		
		/*show users cars*/
		$general_car = new Car();
		$this->cars = $general_car->getUserCars($_SESSION['user_id']);
	}
}

?>