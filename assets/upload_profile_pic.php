<?php
	include "files/db_connect.php";
	include "functions.php";
	sec_session_start(); 

	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["ppfile"]["error"] . "<br>";
	}
	else {
		if (file_exists("upload/" . $_FILES["ppfile"]["name"])) {
			echo $_FILES["ppfile"]["name"] . " already exists. ";
		}
		else {
			move_uploaded_file($_FILES["ppfile"]["tmp_name"],
			"store/profile_images/" . $_FILES["ppfile"]["name"]);
			
			// insert filepath to user pic query
			$pic_filepath = ("store/profile_images/" . $_FILES["ppfile"]["name"]);
			$insert_filepath_to_user_pic_query = $mysqli->prepare("UPDATE users SET prof_pic_path= ? WHERE id = ?");
			$insert_filepath_to_user_pic_query->bind_param('si', $pic_filepath , $_SESSION['user_id']);
			$insert_filepath_to_user_pic_query->execute();
			header('Location: ../user_profile.php');
		}
	}
?>
