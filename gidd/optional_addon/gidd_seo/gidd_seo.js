jQuery(document).ready(function($){

	/*** ADMIN: Character counters ***/
	$("#g952d9bb5 #g55f8ebc8").keyup(function(){
		var box = $(this).val();
		$('#g952d9bb5 .count').html(box.length);
	});
	
	$("#g952d9bb5 #g43209ebd").keyup(function(){
		var box = $(this).val();
		$('#g952d9bb5 .count-title').html(box.length);
	});

});