<?php
include "db_connect.php";


$selected_make = $_GET['make'];
$selected_model = $_GET['model'];
$selected_year = $_GET['year'];

echo '<option value="other">Choose engine</option>';

$get_all_car_engines_query = $mysqli->prepare('SELECT DISTINCT Engine FROM cars WHERE Make = ? AND Model = ? AND Year = ?');
$get_all_car_engines_query->bind_param('ssi', $selected_make, $selected_model, $selected_year);
$get_all_car_engines_query->execute();
$get_all_car_engines_query->bind_result($engine);
while($get_all_car_engines_query->fetch()) {
	echo '<option value="' . $engine . '">' . $engine . '</option>';
}
?>