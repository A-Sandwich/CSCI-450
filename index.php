<?php
	if(isset($_SESSION['user_id'])) {
		// See if user has at least one car associated with their account
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Novus" content="">
		<link rel="shortcut icon" href="assets/bootstrap-3/assets/ico/favicon.png">

		<title>Novus Garage</title>

		<!-- Bootstrap core CSS -->
		<link href="assets/bootstrap-3/assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="assets/bootstrap-3/assets/css/offcanvas.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="bootstrap-3/assets/js/html5shiv.js"></script>
			<script src="bootstrap-3/assets/js/respond.min.js"></script>
		<![endif]-->
		
		<link href="assets/css/master.css" rel="stylesheet">
		
	</head>
	
	<body class="main">
		<?php
			require 'assets/files/navigation.php';
		?>		

		<div class="container">

		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-xs-12 col-sm-9">
  				<p class="pull-right visible-xs">
            		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          		</p>
				<div class="jumbotron">
	            	<h1>Novus Garage</h1>
	            	<p>Novus garage is your one stop shop to track repairs, maintenance and mpg!</p>
          		</div>
          		<div class="feed">
	          		<div class="row">
		        		<div class=" col-6 col-sm-6 col-lg-4">
			              	<h3>Oil Change 09/01/13</h3>
			              	<p>
								Marty McFly: Wait a minute, Doc. Ah... Are you telling me that you built a time machine... out of a DeLorean?<br >
								Dr. Emmett Brown: The way I see it, if you're gonna build a time machine into a car, why not do it with some style?
							</p>
			              	<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
		            	</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
							<h3>Refuel 08/27/13</h3>
							<p>You got more talent in one lugnut than a lot of cars has got on their whole body.</p>
							<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
	            		</div><!--/span-->
	        			<div class=" col-6 col-sm-6 col-lg-4">
			              	<h3>Engine Replacement 08/15/13</h3>
			              	<p>
								Marty McFly: Wait a minute, Doc. Ah... Are you telling me that you built a time machine... out of a DeLorean?<br >
								Dr. Emmett Brown: The way I see it, if you're gonna build a time machine into a car, why not do it with some style?
							</p>
			              	<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
		            	</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
							<h3>Fuel Efficiency - Refuel 08/01/13</h3>
							<p>You had a record high mpg for this fill up!</p>
							<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
	            		</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
			              	<h3>Refuel 06/13/13</h3>
			              	<p>
								Marty McFly: Wait a minute, Doc. Ah... Are you telling me that you built a time machine... out of a DeLorean?<br >
								Dr. Emmett Brown: The way I see it, if you're gonna build a time machine into a car, why not do it with some style?
							</p>
			              	<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
		            	</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
							<h3>HERP A DERP</h3>
							<p>You got more talent in one lugnut than a lot of cars has got on their whole body.</p>
							<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
	            		</div><!--/span-->
	        		</div><!--/row-->
        		</div>
        	</div><!--/span-->

			
			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
							<div class="well sidebar-nav">
								<ul class="nav">
									<li>Profile Information</li>
									<li class="active"><a href="signup.php">Register</a></li>
									<li><a href="login.php">Sign In</a></li>
									<li><a href="addCar.php">Add a Car</a></li><!--Should only show up if logged in-->
								</ul>
							</div><!--/.well -->
						</div><!--/span-->
		</div><!--/row-->

	
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	    <script src="assets/bootstrap-3/assets/js/bootstrap.min.js"></script>
	    <script src="assets/bootstrap-3/assets/js/offcanvas.js"></script>
	</body>
</html>