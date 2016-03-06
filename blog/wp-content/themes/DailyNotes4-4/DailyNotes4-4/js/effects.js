jQuery(function(){	
		
	var $next = jQuery("#content img.next");
	var $previous = jQuery("#content img.previous");
	var $posts = jQuery("#posts");
	
	jQuery("#posts div.post div.inside").click(function() {
		var thisClass = jQuery(this).parent("div").attr("title");
		$posts.animate({marginLeft: "-200px", opacity: "hide"}, 400);
		jQuery("#"+thisClass).animate({top: "0px", opacity: "show"}, 600);
		jQuery("#"+thisClass).children("div.post_info").animate({top: "50px", opacity: "show"}, 800);
		jQuery("img.icon").stop(true, true).animate({top: "50px", opacity: "hide"}, 250);
	});
	$next.click(function() {
		var $parent = jQuery(this).parent("div.big_post"); 
		var $firstpost = jQuery("div.big_post:first");
		var $parentnext = $parent.next("div.big_post");
		$parentnext.css({"top" : "0px", "left" : "200px"});
		$parentnext.children("div.post_info").css({"top" : "50px", "display" : "block"});
		$parent.animate({left: "-200px", opacity: "hide"}, 600);
		if ( $parentnext.length == 0 ) {
		$firstpost.css({"top" : "0px", "left" : "200px"});
		$firstpost.children("div.post_info").css({"top" : "50px", "display" : "block"});
		$firstpost.animate({left: "0px", opacity: "show"}, 600);
		} else { 
		$parentnext.animate({left: "0px", opacity: "show"}, 600);
		}
	});
	$previous.click(function() {
		var $parent = jQuery(this).parent("div.big_post");
		var $parentprev = $parent.prev("div.big_post");
		var $lastpost = jQuery("div.big_post:last");
		$parentprev.css({"top" : "0px", "left" : "-200px"});
		$parentprev.children("div.post_info").css({"top" : "50px", "display" : "block"});
		$parent = jQuery(this).parent("div.big_post");
		$parent.animate({left: "200px", opacity: "hide"}, 600);
		if ( $parentprev.length == 0 ) {
		$lastpost.css({"top" : "0px", "left" : "-200px"});
		$lastpost.children("div.post_info").css({"top" : "50px", "display" : "block"});
		$lastpost.animate({left: "0px", opacity: "show"}, 600);
		} else { 
		$parent.prev("div.big_post").animate({left: "0px", opacity: "show"}, 600);
		}
	});
	jQuery("img.icon").css("top", "50px");
	jQuery("#posts div.post div.inside").hover(function() {
		jQuery(this).animate({marginTop: "13px"}, 250);
		jQuery(this).children("img.icon").animate({top: "32px", opacity: "show"}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({marginTop: "0px"}, 250);
		jQuery(this).children("img.icon").stop(true, true).animate({top: "50px", opacity: "hide"}, 250);
	});
	$next.hover(function() {
		jQuery(this).animate({left: "760px", opacity: .5}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({left: "755px",  opacity: 1}, 250);
	});
	jQuery("#next2").hover(function() {
		jQuery(this).animate({left: "760px", opacity: .5}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({left: "755px",  opacity: 1}, 250);
	});
	$previous.hover(function() {
		jQuery(this).animate({left: "-55px", opacity: .5}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({left: "-50px",  opacity: 1}, 250);
	});
	jQuery("#previous2").hover(function() {
		jQuery(this).animate({left: "-55px", opacity: .5}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({left: "-50px",  opacity: 1}, 250);
	});
	jQuery("#search-wrap img").hover(function() {
		jQuery(this).animate({opacity: .5}, 250);
		}, function(){
		jQuery(this).animate({opacity: 1}, 250);
	});
	jQuery("#posts_big div.black").hover(function() {
		jQuery(this).animate({opacity: .8}, 250);
		jQuery(this).children("img.zoom").animate({opacity: "show"}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({opacity: 1}, 250);
		jQuery(this).children("img.zoom").animate({opacity: "hide"}, 250);
	});
	jQuery("#logo").hover(function() {
		jQuery(this).animate({opacity: .5}, 250);
		}, function(){
		jQuery(this).stop(true, true).animate({opacity: 1}, 250);
	});
	jQuery("#posts_big img.close").click(function() {
		var $bigpost = jQuery("#posts_big div.big_post");	
		var $postinfo = jQuery("#posts_big div.post_info");
		$posts.animate({marginLeft: "0px", opacity: "show"}, 400);
		$bigpost.animate({top: "-100px", opacity: "hide"}, 600);
		$postinfo.animate({top: "-50px", opacity: "hide"}, 800);
		$bigpost.css({"top" : "-100px", "left" : "0px"});
		$postinfo.css({"top" : "-50px", "display" : "none"});
	});
	jQuery("#search-form").css({"left" : "-170px", "display" : "none"});
	jQuery("#posts_big div.big_post").css({"top" : "-100px", "display" : "none"});
	jQuery("#search").click(function(){						 
			if (jQuery("#search-form").filter(':hidden').length == 1)	
				jQuery(this).next("#search-form").animate({left: "-150px", opacity: "toggle"}, "slow")
			else
				jQuery(this).next("#search-form").animate({left: "-170px", opacity: "toggle"}, "slow")
			return false;
	});
	
	jQuery('div.big_post embed') /* 3 */
        .attr('wmode','transparent')
        .eq(0).after('<div></div>');
	
	jQuery('img.zoom').click(function(){
		jQuery(this).siblings('a.lightbox').click();
	});
	
});