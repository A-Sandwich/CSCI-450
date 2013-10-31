<!DOCTYPE html>
<html>
	<head>
		<?php
			require 'assets/files/header.php';
		?>		
		<title>Sign Up</title>
	</head>
	
	<body>
		<?php
			require 'assets/files/navigation.php';
		?>		
		
		<div class="login col-lg-offset-4 col-lg-4">
			<h1 class="signUp">Sign Up</h1>
			<form name="signupform" action="assets/registration.php" method="post">
				<!--<label for="email" clas="25">E-Mail:</label>--><input type="text" name="email" class="login form-control signup" id="email" placeholder="email address"><br>
				<!--<label for="name" class="25">Username:</label>--><input type="text" name="name" class="login form-control signup" id="name" placeholder="username"> <br>
				<!--<label for="bday" class="25">Birthday:</label>--><input type="date" name="bday" class="login form-control signup" id="bday"><br>
				<!--<label for="password" class="25">Password:</label>--><input type="password" name="password form-control" class="login signup" id="password" placeholder="password"><br>
				<!--<label for="retypepassword" class="25">Re-type Password:</label>--><input type="password"  name="login" class="login signup" id="retypepassword" placeholder="retype password"> <br>
				<!--<label for="submit" class="25">Submit:</label>--><button type="submit" name="submit form-control" class="submit signup" id="submit" onclick="formhash(this.form, this.form.password)">I am a genius</button>
			</form>
		</div>

	<script>
		$(document).ready(function() {
			// This section handles form validation
			$("#submit").prop("disabled",true); // initialize the submit button to disabled
			
			$("input").change(function() {
				// verify whether the password and retype passwords are the same
				pass = $("#password").val();
				pass2 = $("#retypepassword").val();
				if(pass != "" && pass == pass2 && $("#email").val() != "" && $("#name").val() != "" && $("#bday").val() != "") {
					$("#submit").prop("disabled", false);
				}
			});
		});
	</script>
	</body>
</html>
<!-- Hosting24 Analytics Code -->
<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script>
<!-- End Of Analytics Code -->
