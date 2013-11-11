<?php
	$con = mysqli_connect("localhost", "novusgar_us", "wedontsuck", "novusgar_database");
	if (! $con){
	    echo'connection failed'; 
	}else{
		//echo''.$con.'';
	};
	$query = sprintf('SELECT * FROM carousel WHERE spreadNum = (SELECT MAX(spreadNum) FROM carousel)');
	$qryResult = mysqli_query($con, $query);
	
	if (! $qryResult){ 
	    echo'failed'; 
	}
	mysqli_close($con);	
		
	echo '
		<!-- Carousel
		================================================== -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">';
	
	$counter = 0;
	$active = 'active';
	echo'	<!-- Indicators --><ol class="carousel-indicators">';
	while($row = mysqli_fetch_assoc($qryResult)){
		echo'<li data-target="#myCarousel" data-slide-to="'.$counter.'" class="'.$active.'"></li>';
		$counter++;
		$active='';
	}//end while
	echo'</ol>';
	mysqli_data_seek($qryResult, 0);
	echo'
		
			<div class="carousel-inner">
	';
	//<!-- Create indicatiors/dots for carousel -->
	
	
	//Create styles + carousel items.
	$counter = 0;
	$active = 'active';
	while($row = mysqli_fetch_assoc($qryResult)){   
	   echo'
		<div class="item '.$active.' horse'.$counter.'">
		  <div id="horse'.$counter.'" class="container">
			<div class="carousel-caption">
			  <h1>Novus</h1>
			  <p>'.$row['Content'].'</p>
			</div>
		  </div>
		</div>'	;
		$counter++;
		$active = '';
	}
	
	echo'
		</div><a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div><!-- /.carousel -->
	';
	mysqli_data_seek($qryResult, 0);
	$counter = 0;
	  while($row = mysqli_fetch_assoc($qryResult)){
			echo'
			<style>
			.horse'.$counter.'{
				background-image: url("assets/images/background_large/'.$row['Img'].'");	  
				background-size: cover;        
		   }
		   </style>';
		   $counter++;
	  };	
?>