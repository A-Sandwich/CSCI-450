<?php
	include 'common.php';	
	$repairUser = new User();
	
	if(isset($_POST['update_repair']) && $_POST['update_repair'] != 0) {
		$repairUser->edit_repair($_POST['got_repair_date'], $_POST['got_repair_part'], $_POST['got_repair_service'], $_POST['got_repair_current_mileage'], $_POST['got_repair_car_id'], $_POST['update_repair']);
	} else {
		$repairUser->add_got_repair($_POST['got_repair_date'], $_POST['got_repair_part'], $_POST['got_repair_service'], $_POST['got_repair_current_mileage'], $_POST['got_repair_car_id']);
		header('Location: ../../user_profile.php');
	}
?>
