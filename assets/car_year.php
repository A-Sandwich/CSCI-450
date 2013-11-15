<?php
include "db_connect.php";


$selected_make = $_GET['make'];
$selected_model = $_GET['model'];

echo '<option value="other">Choose year</option>';

$get_all_car_years_query = $mysqli->prepare('SELECT DISTINCT Year FROM cars WHERE Make = ? AND Model = ?');
$get_all_car_years_query->bind_param('ss', $selected_make, $selected_model);
$get_all_car_years_query->execute();
$get_all_car_years_query->bind_result($year);
while($get_all_car_years_query->fetch()) {
	echo '<option value="' . $year . '">' . $year . '</option>';
}
?>