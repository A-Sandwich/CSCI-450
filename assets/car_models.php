<?php
include "db_connect.php";


$selected_make = $_GET['make'];

echo '<option value="other">Choose Model</option>';

$get_all_car_models_query = $mysqli->prepare('SELECT DISTINCT Model FROM cars WHERE Make = ?');
$get_all_car_models_query->bind_param('s', $selected_make);
$get_all_car_models_query->execute();
$get_all_car_models_query->bind_result($model);
while($get_all_car_models_query->fetch()) {
	echo '<option value="' . $model . '">' . $model . '</option>';
}
?>
