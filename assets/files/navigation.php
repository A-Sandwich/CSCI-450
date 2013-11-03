<?php 
	include 'assets/logout.php';
	__DIR__.'/../class/class_user.php';
	
	echo'<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
		<div class="nav container">
   			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
      			</button>
				<a class="navbar-brand" href="./">Novus Garage</a>
    		</div>
    		<div class="collapse navbar-collapse">
      			<ul class="nav navbar-nav">
            		<li><a href="index.php">Home</a></li>
	';
	if($loggedIn == true){
		echo'
			<li><a href="addCar.php">Add Car</a></li>
			<li><a href="user_profile.php">'.$username.'</a></li>
			<li><a href="../../?logout=1">Logout</a></li>
		';

	} else {
		echo'
            <li><a href="signup.php">Register</a></li>
            <li><a href="login.php">Sign In</a></li>
        ';	
	};
	echo'	            	      
     	 		</ul>
    		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->';
?>