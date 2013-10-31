<?php
include "assets/db_connect.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			require 'assets/files/header.php';
		?>	
		<title>Novus Garage - Sign In</title>
	</head>
	
	<body>
		
	<?php
		require 'assets/files/navigation.php';
	?>	
	<div class="login col-lg-offset-4 col-lg-4">
		<h1 class="signIn">Novus Garage</h1>
			
		<form class="form-signin" action="assets/process_login.php" method="post">
			<input type="text" class="form-control" name="email" id="email" Placeholder="Email Address" autofocus>
			<input type="password" class="form-control" name="password" Placeholder="Password">
			<label class="checkbox">
				<input type="checkbox" value="remember-me" id="chkRememberMe"> Remember Me
			</label>
			<button class="btn btn-lg btn-block btn-primary signIn" type="submit" 
			onclick="formhash(this.form, this.form.password); 
			if(document.getElementById('chkRememberMe').checked) {
				setCookie('remember',document.getElementById('email').value,10); 
			}">
			Sign In</button>
			<?php  if(isset($_GET['fail']) && $_GET['fail'] == 1) { echo '<span style="color:red;"> You already have an account! </span>'; } ?>
		</form>
  </div>
  
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script>
			// --------------FUNCTIONS--------------
			function emailIsValid(email) {
				var rex = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
				return rex.test(email);
			}	// checks the pattern of the email address that was entered and returns bool emailIsValid
			
			function setCookie(cookie_name,value,exdays) {
				var exdate=new Date();
				exdate.setDate(exdate.getDate() + exdays);
				var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
				document.cookie=cookie_name + "=" + c_value;
			}  // Function to set a cookie by cookie name and days until it expires
			
			function getCookie(c_name) {
				var c_value = document.cookie;
				var c_start = c_value.indexOf(" " + c_name + "=");
				if (c_start == -1) {
				  	c_start = c_value.indexOf(c_name + "=");
				}
				if (c_start == -1) {
				  	c_value = null;
				}
				else {
				  	c_start = c_value.indexOf("=", c_start) + 1;
				  	var c_end = c_value.indexOf(";", c_start);
				  	if (c_end == -1) {
						c_end = c_value.length;
					}
					c_value = unescape(c_value.substring(c_start,c_end));
				}
				return c_value;
			}  // Function to get cookie based on name and returns the value of the cookie
			
			// ------------START JQUERY--------------
			$(document).ready( function() {
				if(getCookie("remember") != null) {
					var email = getCookie("remember");
					$("#email").val(email);
				}	// if there was a remember cookie, fill in the email field with the remembered email		
			});
		</script>
	   
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="assets/bootstrap-3/assets/js/bootstrap.min.js"></script>

	</body>
</html>	