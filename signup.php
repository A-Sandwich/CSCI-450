<!DOCTYPE html>

<?php

?>


<html>
	<head>
		<title>Sign Up</title>
		
		<script src="assets/js/sha512.js"></script>
		<script src="assets/js/forms.js"></script>
		
	</head>
	
	<body>
		<h1>Sign Up</h1>
		<form name="signupform" action="assets/registration.php" method="post">
			E-Mail <input type="text" name="email" class="login" id="email" placeholder="email address"> <br>
			username <input type="text" name="name" class="login" id="name" placeholder="username"> <br>
			Birthday <input type="date" name="bday" class="login" id="bday"><br>
			Password <input type="password" name="password" class="login" id="password" placeholder="password"><br>
			Re-type Password <input type="password" name="login" class="login" id="retypepassword" placeholder="retype password">
			Submit <button type="submit" name="submit" class="submit" id="submit" onclick="formhash(this.form, this.form.password)">I am a genius</button>
		</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
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