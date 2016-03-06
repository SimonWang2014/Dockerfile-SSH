<?php global $shortname; ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/easing.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/effects.js"></script>
	<script type="text/javascript"> 
	//<![CDATA[
		jQuery.noConflict();
		jQuery('ul.superfish').superfish({ 
			delay:       300,                            // one second delay on mouseout 
			animation:   {'marginLeft':'0px',opacity:'show'},  // fade-in and slide-down animation 
			speed:       'normal',                          // faster animation speed
			onBeforeShow: function(){ this.css('marginLeft','20px'); }, 			
			autoArrows:  true,                           // disable generation of arrow mark-up 
			dropShadows: false                            // disable drop shadows 
		}).find('> li > ul').prepend('<span class="top-arrow"></span>');
		jQuery('ul.superfish').find('li ul li ul').append('<span class="dropdown-bottom"></span>');
		
		
		jQuery('ul.superfish ul a').hover(function(){
			jQuery(this).stop().animate({paddingLeft:'38px'},300);
		},function(){
			jQuery(this).stop().animate({paddingLeft:'30px'},300);
		});
		
		var $searchform = jQuery('div#search-form'),
			$searchinput = $searchform.find("input#searchinput"),
			searchvalue = $searchinput.val();

		$searchinput.focus(function(){
			if (jQuery(this).val() === searchvalue) jQuery(this).val("");
		}).blur(function(){
			if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
		});
		
		Cufon.now();
	//]]>	
	</script> 