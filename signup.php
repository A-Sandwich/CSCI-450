
<!DOCTYPE html>



<html>
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Novus" content="">
		<link rel="shortcut icon" href="assets/bootstrap-3/assets/ico/favicon.png">


		<!-- Bootstrap core CSS -->
		<link href="assets/bootstrap-3/assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="assets/bootstrap-3/assets/css/offcanvas.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="bootstrap-3/assets/js/html5shiv.js"></script>
			<script src="bootstrap-3/assets/js/respond.min.js"></script>
		<![endif]-->
		
		
		<title>Sign Up</title>
		
		<script src="assets/js/sha512.js"></script>
		<script src="assets/js/forms.js"></script>
		<link href="assets/bootstrap-3/assets/css/signIn.css" rel="stylesheet">
		<link href="assets/css/master.css" rel="stylesheet">
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
				<!--<label for="retypepassword" class="25">Re-type Password:</label>--><input type="password form-control" name="login" class="login signup" id="retypepassword" placeholder="retype password"> <br>
				<!--<label for="submit" class="25">Submit:</label>--><button type="submit" name="submit form-control" class="submit signup" id="submit" onclick="formhash(this.form, this.form.password)">I am a genius</button>
			</form>
		</div>

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
<!-- Hosting24 Analytics Code -->
<script type="text/javascript" src="http://stats.hosting24.com/count.php"></script>
<!-- End Of Analytics Code -->
