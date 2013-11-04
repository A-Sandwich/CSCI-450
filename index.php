<?php
	include_once "assets/files/common.php";
	include __DIR__.'/assets/files/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
	<?php include 'assets/files/header.php';?>
	
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
								Changed oil. Cost $20. Miles driven since last oil change: 80,000
							</p>
			              	<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
		            	</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
							<h3>Refuel 08/27/13</h3>
							<p>Refuel: Current Miles: 98,000, current mpg 31</p>
							<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
	            		</div><!--/span-->
	        			<div class=" col-6 col-sm-6 col-lg-4">
			              	<h3>Engine Replacement 08/15/13</h3>
			              	<p>
								Major repair: Total Cost $5,000. Complete overhall of the engine ...
							</p>
			              	<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
		            	</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
							<h3>Fuel Efficiency - Refuel 08/01/13</h3>
							<p>Current miles: 97,944, current mpg 27</p>
							<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
	            		</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
			              	<h3>Refuel 06/13/13</h3>
			              	<p>
								Current miles: 97,900, current mpg 25
							</p>
			              	<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
		            	</div><!--/span-->
	            		<div class=" col-6 col-sm-6 col-lg-4">
							<h3>Welcome to Novus!</h3>
							<p>Welcome!</p>
							<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
	            		</div><!--/span-->
	        		</div><!--/row-->
        		</div>
        	</div><!--/span-->
			<?php
				require 'assets/files/sideBar.php';
			?>
		</div><!--/row-->

	
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    
	    
	</body>
</html>