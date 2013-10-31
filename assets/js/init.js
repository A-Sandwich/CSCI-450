$(document).ready( function() {
	url = document.location.pathname.substr(1,(document.location.pathname.length));//-5 gets rid of .php
	$(".nav").children().children("a").each(function(){
		if(this.href.indexOf(url) != -1){
			$(this).parent().addClass("active");
		}//end if
	});
});
				
