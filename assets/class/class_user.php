<?php
# User class for Novus Garage

# constructor runs when a new User is created, destructor runs on unset(<User instance name>);
include '../db_connect.php';
include '../functions.php';
sec_session_start();


class User {
	
	private $db; 
	
	function __construct($uId=NULL) {
		$this->db = new mysqli(HOST, USER, PASSWORD, DATABASE);
		
		if($uID == NULL){
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