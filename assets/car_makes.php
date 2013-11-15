<?php
include "db_connect.php";


$get_all_car_makes_query = $mysqli->prepare('SELECT DISTINCT Make FROM cars');
$get_all_car_makes_query->execute();
$get_all_car_makes_query->bind_result($make);

echo '<option value="other">Choose make</option>';

while($get_all_car_makes_query->fetch()) {
	echo '<option value="' . $make . '">' . $make . '</option>';
}

?>
