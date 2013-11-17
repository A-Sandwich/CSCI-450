<?php
	require_once "assets/files/common.php";
?>

<!DOCTYPE html>
<html lang="en">
	
	<head><?php require_once 'assets/files/header.php'; ?></head>

	<title>Novus Garage - Add Car</title>		

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
	          		<form name="addCarForm" id="addCarForm" class="form-horizontal" action="assets/process_car.php" method="post" style="padding:20px;">
	          			<div class="row">
		        			<div class=" col-3 col-sm-6 col-lg-6">
		        				<div class="input-group input-group-sm">
				          			<label for="carName" class="col-sm-3 control-label">Nickname</label>
				          			<div class="col-sm-9">
				          				<input type="text" id="carName" class="form-control" name="carName" placeholder="Nickname"><br>
				          			</div>
				          			<label for="mileage" class="col-sm-3 control-label">Mileage</label>
				          			<div class="col-sm-9">
				          				<input type="number" id="mileage" class="form-control" name="mileage" placeholder="Mileage"><br>
				          			</div>
				          			<label for="carMake" class="col-sm-3 control-label">Make</label>
				          			<div class="col-sm-9">
				          				<select name="carMake" id="carMake" class="form-control" >
				          					<option val="other">Make</option>
				          				</select><br><!--dropdown-->
				          			</div>
				          			<label for="carModel" class="col-sm-3 control-label">Model</label>
				          			<div class="col-sm-9">
				          				<select name="carModel" id="carModel" class="form-control" >
				          					<option val="other">Model</option>
				          				</select><br><!--dropDown-->
				          			</div>
				          			<label for="carYear" class="col-sm-3 control-label">Year</label> 
				          			<div class="col-sm-9">
				          				<select name="carYear" id="carYear" class="form-control" >
				          					<option val="other">Year</option>
				          				</select><br><!--dropdown-->
				          			</div>				          			
				          			<label for="carColor" class="col-sm-3 control-label">Color</label>
				          			<div class="col-sm-9">
				          				<input type="text" id="carColor" class="form-control"  name="carColor" placeholder="Paint color"><br>
				          			</div>
				          			<label for="vin" class="col-sm-3 control-label">VIN</label>
				          			<div class="col-sm-9">
				          				<input type="text" id="vin"  class="form-control" name="vin" placeholder="VIN Number"><br><br>
				          			</div>
				          			<label for="engineType" class="col-sm-3 control-label">Engine</label>
				          			<div class="col-sm-9">
				          				<select name="engineType" id="engineType" class="form-control" >
				          					<option val="other">Engines</option>
				          				</select><br><!--dropdown-->
				          			</div>
				          			
			          			</div>
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
		          		<br><button class="btn btn-primary"type="submit" name="submit" id="savecar">Save Car</button>
		          		<a class="btn btn-danger" href="./index.php?addlater=1">Add a car later</a>
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
	    		
	    		function fillYearDropdown()
	    		{
	    			$.ajax(
    				{
    					url: "assets/car_year.php",
    					data: { make: $("#carMake").val(), model: $("#carModel").val() },
    					cache: false,
    					success: function(html)
    					{
    						$("#carYear").html(html);
    					},
    				});
	    		}
	    		
	    		function fillEngineDropdown()
	    		{
	    			$.ajax(
    				{
    					url: "assets/car_engines.php",
    					data: { make: $("#carMake").val() , model: $("#carModel").val() , year: $("#carYear").val() },
    					cache: false,
    					success: function(html)
    					{
    						$("#engineType").html(html);
    					},
    				});
	    		}
	    		
	    		$("#carMake").change( function() {
	    			fillModelDropdown();	
	    		});  // When user changes the carMake dropdown selection fill the models dropdown
	    		$("#carModel").change( function(){
	    			fillYearDropdown();
	    		});
	    		$("#carYear").change( function() {
	    			fillEngineDropdown();
	    		});
	    		
	    	});
	    	
	    </script>
	</body>
</html>