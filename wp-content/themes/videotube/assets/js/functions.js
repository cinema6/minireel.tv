(function($) {
  "use strict";
  jQuery(document).ready(function($){
	// fitvideo.
	try {
		$('.videoWrapper').fitVids();
	} catch(err) {
		
	}	  
	
	$(".dropdown-toggle").dropdown();
	// Stop carousel
	jQuery('.carousel').carousel({
		interval: false
	});
	// Fix placeholder
	jQuery('input, textarea').placeholder();		
  }); 
})(jQuery);
