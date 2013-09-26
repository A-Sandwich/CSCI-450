$(document).ready(function(){
	//Hides fields upon load.
	$('.showHide').slideUp(0);
	
	$("input:radio").change(function(){
		console.log('change');
		response=parseInt(this.value);
		if(response>0){
			$('.'+this.name).slideDown();
		}else{
			$('.'+this.name).slideUp();
		}//end if else
	});//end input:radio.change
});//end $(document).ready
