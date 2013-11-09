<?php
/*
	$con = mysql_connect("localhost", "novusgar_us", "wedontsuck", "novusgar_database");
	if (! $con){
    echo'connection failed'; 
} 
	$query = sprintf('SELECT * FROM carousel');
	$rows = mysql_query($sql);
	
	if (! $rows){ 
    // probably a syntax error in your SQL, 
    // but could be some other error
    //throw new Db_Query_Exception("DB Error: " . mysql_error());
    echo'failed'; 
}
	mysql_close($con);
	//echo''.mysql_num_rows($rows).'';*/

	
	echo'..';
		echo '
			<!-- Carousel
			================================================== -->
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <div class="carousel-inner">
		  ';
		$counter = 1;
		$active = 'active';
		echo'<ol class="carousel-indicators">';
		if ($handle = opendir(__DIR__.'/../images/background_large')) {
			echo'tiffany was right again...';
			 while (false !== ($entry = readdir($handle))) {
				 if (strpos($entry,'png') !== false) {
					 echo'<li data-target="#myCarousel" data-slide-to="'.$counter.'" class="'.$active.'"></li>';
					$active = '';
					$counter = $counter+1;
				};
			 };
			
		};
		echo'</ol>';
		$active = 'active';
		closedir($handle);
		if ($handle = opendir(__DIR__.'/../images/background_large')) {
			$counter = 1;
			echo'<style>';
			while (false !== ($entry = readdir($handle))) {
				if (strpos($entry,'png') !== false && $entry != '') {
					echo'
						.horse'.$counter.'{
							background-image: url("assets/images/background_large/'.$entry.'");	  
							background-size: cover;        
					   }';
					
					$counter = $counter + 1;
				};
			};
			echo'</style>';
			closedir($handle);
			for($i=1;$i<$counter;$i++){
				echo'
				<div class="item '.$active.' horse'.$i.'">
				  <div id="horse'.$i.'" class="container">
					<div class="carousel-caption">
					  <h1>Novus</h1>
					  <p>Novus Garage is not a one stop shop, in fact it is not evena shop.</p>
					</div>
				  </div>
				</div>'	;
				$active = '';
			};
													  echo'</div><a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			  <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div><!-- /.carousel -->';
		};
	
?>