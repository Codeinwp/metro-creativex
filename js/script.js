jQuery( document ).ready(function() {
	/* Limit menu nr of elements */
	var full_width = 0;
 
	jQuery("ul.menu:first > li").each(function( index ) {    
		if((jQuery(this).width() + full_width) > 650) {
			jQuery(this).remove();
		}
		full_width = full_width + jQuery(this).width(); 
	});
	
	/* Masonry */
	var $container = jQuery('#content');

	$container.masonry({
		itemSelector: 'article'
	});
			
	/* Using custom configuration */
	jQuery(".img_gallery").carouFredSel({
		direction: 'up',
		scroll: {
			fx: 'fade',
			duration: 700
		},
		items: {
			visible: 1
		},
		auto: true,	
	});	
});

/* Get window sizes */
var wheight = jQuery(window).height(),
wwidth = jQuery(window).width();
						
				jQuery(".header").css({
					"min-height":wheight+"px",
				});
						
				jQuery("#content").css({
					"min-height":wheight+"px",
				});

		/* Responsive menu */
		jQuery(".openmenuresp").click(function() {
				jQuery("nav").toggleClass("mobilenavopen");
			    var text = $(this).text() == 'Close Menu' ? 'Open Menu' : 'Close Menu';
			    jQuery(this).text(text);
		});