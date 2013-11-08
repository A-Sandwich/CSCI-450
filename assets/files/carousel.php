<?php
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
		 while (false !== ($entry = readdir($handle))) {
		 	if (strpos($entry,'jpg') !== false) {
			 	echo'<li data-target="#myCarousel" data-slide-to="'.$counter.'" class="'.$active.'"></li>';
				$active = '';
				$counter = $counter+1;
			};
		 };
		closedir($handle);
	};
	echo'</ol>';
	$active = 'active';
	if ($handle = opendir(__DIR__.'/../images/background_large')) {
	
	$counter = 1;
	echo'<style>';
    while (false !== ($entry = readdir($handle))) {
    	if (strpos($entry,'png') !== false) {
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
	
	
		for($i=0;$i<$counter;$i++){
			echo'
			<div class="item '.$active.' horse'.$i.'">
	          <div id="horse'.$i.'" class="container">
	            <div class="carousel-caption">
	              <h1>Novus</h1>
	            </div>
	          </div>
	        </div>'	;
			$active = '';
		};
		
	
    
	echo'</div><a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->';
}
?>