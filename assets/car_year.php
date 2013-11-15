<?php
include "db_connect.php";
include "functions.php";
sec_session_start();

$selected_make = $_GET['make'];
$selected_model = $_GET['model'];
$get_all_car_models_query = $mysqli->prepare('SELECT DISTINCT Year FROM cars WHERE Make = ? AND Model = ?');
$get_all_car_models_query->bind_param('ss', $selected_make, $selected_model);
$get_all_car_models_query->execute();
$get_all_car_models_query->bind_result($year);
while($get_all_car_models_query->fetch()) {
	echo '<option value="' . $year . '">' . $year . '</option>';
}
?>