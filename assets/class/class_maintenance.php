<?php
# Maintenance class for Novus Garage
include_once 'class_entity.php';
include_once __DIR__.'/../db_connect.php';


class Maintenance {
	
	private $record_row; 
	/*
	 * record_row will be an array. List what will be stored under what index here.
	 * 
	 */
	
	function __construct() {
		$this->db = new mysqli(HOST, USER, PASSWORD, DATABASE);
	}
	
	function compile_new() {
		/*
		 * accept an array of record data and set record_row to equal it
		 */
	}
	
	function store() {
		/*
		 * send the compiled data to the database with this->db 
		 */
	}
}

?>