<?php
	include 'common.php';	
	$repairUser = new User();
	
	if(isset($_POST['']) && $_POST[''] != 0) {
		
	} else {
		$repairUser->add_got_repair($_POST['got_repair_date'], $_POST['got_repair_part'], $_POST['got_repair_service'], $_POST['got_repair_current_mileage'], $_POST['got_repair_car_id']);
		header('Location: ../../user_profile.php');
	}
?>
