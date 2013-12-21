/** this file is auto loaded because it has the same name as its parent directory **/
jQuery(function(){
      jQuery('div.sliderWraper > div.postgroup-first').cycle({ 
            fx:'fade',
            pager : '#navSlide' 
      });   


  });

jQuery(function(){

	jQuery(window).resize(function(){
		if (jQuery(window).width() <= 980){	
			var width = jQuery(window).width();
			jQuery('.size-full').css('width', width+'px');
			jQuery('.static-35').css('font-size', '1em !important');
		}else{
			jQuery('.size-full').css('width', '980px');
		}	
	});

});