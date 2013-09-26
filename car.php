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
		<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
			<div class="container">
       			<div class="navbar-header">
  					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            		<span class="icon-bar"></span>
	            		<span class="icon-bar"></span>
	            		<span class="icon-bar"></span>
          			</button>
					<a class="navbar-brand" href="#">Novus Garage</a>
        		</div>
        		<div class="collapse navbar-collapse">
          			<ul class="nav navbar-nav">
	            		<li class="active"><a href="index.php">Home</a></li>
			            <li><a href="signup.php">Register</a></li>
			            <li><a href="login.php">Sign In</a></li>
         	 		</ul>
        		</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
    	</div><!-- /.navbar -->

		<div class="container">

		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-xs-12 col-sm-9">
  				<p class="pull-right visible-xs">
            		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          		</p>
				<div class="jumbotron">
	            	<h1>Novus Garage</h1>
	            	<p>Park your car in Novus Garage!</p>
          		</div>
          		<div class="feed container">
	          		<form >
	          			<div class="row">
		        			<div class=" col-3 col-sm-6 col-lg-6">
			          			<label for="carName">Car Name:</label><input type="text" id="carName" name="carName"><br>
			          			<label for="milage">Milage:</label><input type="number" id="milage" name="milage"><br>
			          			<label for="carMake">Make:</labeL><input type="text" id="carMake" name="carMake"><br>
			          			<label for="carModel">Model:</label><input type="text" id="carModel" name="carModel"><br>
			          			<label for="carYear">Year:</label><input type="number" id="carYear" name="carYear"><br>
			          			<label for="carColor">Color:</label><input type="text" id="carColor" name="carColor"><br>
			          			<label for="vin">VIN:</label><input type="text" id="vin" name="vin"><br><br>
	          				</div><!--/-->
		        			<div class=" col-3 col-sm-6 col-lg-6">
			          			<h4>Would you like to add information about your last oil change?</h4>
			          			<input type="radio" name="oilChange" value="1">Yes
			          			<input type="radio" name="oilChange" value="0">No<br>
			          			<div class="showHide oilChange">
			          				<label for="oilChangeDate">Date of last oil change:</label><input type="date" id="oilChangeDate" name="oilChangeDate"><br>
			          				<label for="oilChangeMilage">Milage during last oil change:</label><input type="number" id="oilChangeMilage" name="oilChangeMilage"><br>
			          				<label for="oilChangeType">Type of oil used:</label><input type="text" id="oilChangeType" name="oilChangeType"><br>
			          				<h4>Did you also change your filter?</h4>
			          				<input type="radio" name="oilFilter" value="1">Yes
			          				<input type="radio" name="oilFilter" value="0">No<br>
			          				<div class="showHide oilFilter">
			          					<label for="oilFilter">Oil filter used:</label><input type="text" id="oilFilter" name="oilFilter"><br>
			          					<!--This drop down could be removed if we can match an oil filter to their car
			          						or we could "suggest" a filter that matches and give the user the option
			          						to change it. -->
			          				</div>
			          			</div>
		          			</div>
		          		</div>
	          		</form>
        		</div><!--/feed-->
        		<br>	
        	</div><!--/span-->

			
			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
							<div class="well sidebar-nav">
								<ul class="nav">
									<li>Profile Information</li>
									<li class="active"><a href="signup.php">Register</a></li>
									<li><a href="login.php">Sign In</a></li>
									<li><a href="car.php">Add a Car</a></li>
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
	    <script src="assets/js/showHide.js"></script>
	</body>
</html>