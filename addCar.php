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
	            	<p>Park your car in Novus Garage!</p>
          		</div>
          		<div class="feed container">
	          		<form name="addCarForm" id="addCarForm" action="assets/process_car.php" method="post">
	          			<div class="row">
		        			<div class=" col-3 col-sm-6 col-lg-6">
			          			<label for="carName">Give your car a nickname:</label><input type="text" id="carName" name="carName"><br>
			          			<label for="mileage">Mileage:</label><input type="number" id="mileage" name="mileage"><br>
			          			<label for="carMake">Make:</labeL><select name="carMake" id="carMake">
			          				<option val="other">other</option>
			          			</select><br><!--dropdown-->
			          			<label for="carModel">Model:</labeL><select name="carModel" id="carModel">
			          				<option val="other">other</option>
			          			</select><br><!--dropDown-->
			          			<label for="carYear">Year:</label><input type="number" id="carYear" name="carYear"><br>
			          			<label for="carColor">Color:</label><input type="text" id="carColor" name="carColor"><br>
			          			<label for="vin">VIN:</label><input type="text" id="vin" name="vin"><br><br>
			          			<label for="engineType">Engine Type:</label><input type="text" id="engineType" name="engineType"> Liter Engine<br><br>
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
		          		<button type="submit" name="submit" id="savecar">Save Car</button>
		          		<button type="cancel" name="cancel" id="cancel"><a href="./index.php?addlater=1">Add a car later</a></button>
	          		</form>
        		</div><!--/feed-->
        		<br>	
        	</div><!--/span-->

			<?php
				require 'assets/files/sideBar.php';
			?>
		</div><!--/row-->

	
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	    <script src="assets/bootstrap-3/assets/js/bootstrap.min.js"></script>
	    <script src="assets/bootstrap-3/assets/js/offcanvas.js"></script>
	    <script src="assets/js/showHide.js"></script>
	    
	    
	     <script>
	    	$(document).ready( function() {
	    		// Fill make and model dropdown menus
	    		function fillMakeDropdown()
	    		{
	    			$.ajax(
    				{
    					url: "assets/car_makes.php",
    					cache: false,
    					success: function(html)
    					{
    						console.log(html);
    						$("#carMake").html(html);
    					},
    				});
	    		} 
	    		fillMakeDropdown();
	    		function fillModelDropdown()
	    		{
	    			$.ajax(
    				{
    					url: "assets/car_models.php",
    					data: { make: $("#carMake").val() },
    					cache: false,
    					success: function(html)
    					{
    						$("#carModel").html(html);
    					},
    				});
	    		}
	    		
	    		$("#carMake").change( function() {
	    			fillModelDropdown();	
	    		});  // When user changes the carMake dropdown selection fill the models dropdown
	    		
	    	});
	    	
	    </script>
	</body>
</html>