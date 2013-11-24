<?php 

require_once 'assets/class/class_user.php';

?>
<!DOCTYPE html>

<head>
	<?php
		require 'assets/files/header.php';
	?>	

	<title>Profile Page</title>
</head>
<html lang="en">

<body>
	<h1> Novus Garage Users </h1>
	
	<div class="col-xs-12 col-md-8" >
		<h3>Search by Email:</h3><input type="text" class="form-control" id="email_user_search" />
		<div class="well" id="users_list">
		<?php	
			$usersUser = new User();
			$users = $usersUser->get_all_users();
			
			foreach($users as $u) {
				echo '<a href="#" style="text-decoration:none;">';
				foreach($u as $i) {
					echo $i . ' ';
				}
				echo '</a><br>';
			}
			
		?>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$("#email_user_search").keyup(function() {
				$.ajax(
				{
					url: "assets/files/handle_user_search.php",
					data: { search: $("#email_user_search").val()},
					cache: false,
					success: function(html)
					{
						$("#users_list").html(html);
					},
				});
			});
		});
	</script>
</body>

</html>