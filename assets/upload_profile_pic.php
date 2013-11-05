<?php
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
			$insert_filepath_to_user_pic_query = $mysqli->prepare("INSERT INTO users (prof_pic_path) VALUES (?) WHERE id = ?");
			$insert_filepath_to_user_pic_query->bind_param('si', "store/profile_images/" . $_FILES["ppfile"]["name"], $userid);
			$insert_filepath_to_user_pic_query->execute();
		}
	}
?>
