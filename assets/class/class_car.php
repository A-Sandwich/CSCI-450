<?php
	# Car class for Novus Garage
	
	class Car {
		private $nickname;
		private $make;
		private $model;
		private $year;
		private $vin;
		private $engine;
		private $mileage;
		
		public function getNickname() {
			return $this->nickname;
		}
		public function setNickname($value) {
			$this->nickname = $value;
		}
		public function getMake() {
			return $this->make;
		}
		public function setMake($value) {
			$this->make = $value;
		}
		public function getModel() {
			return $this->model;
		}
		public function setModel($value) {
			$this->model = $value;
		}
		public function getYear() {
			return $this->year;
		}
		public function setYear($value) {
			$this->year = $value;
		}
		public function getVin() {
			return $this->vin;
		}
		public function setVin($value) {
			$this->vin = $value;
		}
		public function getEngine() {
			return $this->engine;
		}
		public function setEngine($value) {
			$this->engine = $value;
		}
		public function getMileage() {
			return $this->mileage;
		}
		public function setMileage($value) {
			$this->mileage = $value;
		}
	}
	
?>