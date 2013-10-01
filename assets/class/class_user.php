<?php
# User class for Novus Garage

# constructor runs when a new User is created, destructor runs on unset(<User instance name>);
include '../db_connect.php';
include '../functions.php';
sec_session_start();


class User {
	private function __construct() {
		// What happens when a new User is created?
		$this->user_id = $_SESSION['user_id'];
		$this->username = $_SESSION['username'];
		$this->email_address = $_SESSION['email'];
		// get dob
		$get_user_dob_query = $mysqli->prepare('SELECT dob FROM users
												WHERE id = ?
												LIMIT 1');
		$get_user_dob_query->bind_param($this->user_id);
		$get_user_dob_query->execute();
		$get_user_dob_query->bind_result($thedob);
		$get_user_dob_query->fetch();
		$this->dob = $thedob; // end get dob
	}
	private function __destruct() {
		// What happens when the object is destroyed?
	}
	
	private $user_id;
	private $username;
	private $email_address;
	private $dob;
}

?>