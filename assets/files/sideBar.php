<?php
	require_once "common.php";
	
	echo'
		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
				<div class="well sidebar-nav">
					<ul class="nav">';
					if(!$loggedIn){
						echo'
							<li class="active"><a href="signup.php">Register</a></li>
							<li><a href="login.php">Sign In</a></li>
						';
					}else{
						echo'<li><a href="addCar.php">Add a Car</a></li><!--Should only show up if logged in-->';
					};
						echo'
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
	';
?>