<?php
# User class for Novus Garage

include_once '../db_connect.php';
include_once '../functions.php';
sec_session_start();


class User {
	
	private $db; 
	public $user_data;
	
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
			$userid = $_SESSION['user_id'];
			$username = $_SESSION['username'];
			$loggedIn = true;
		};
		return $loggedIn;
	}
	
	function fillOutProfile() {
		// set the different things that should show up on the profile page
		
	}
}

?>