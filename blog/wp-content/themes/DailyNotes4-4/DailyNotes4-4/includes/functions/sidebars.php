<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .widget-content --> </div> <!-- end .widget -->',
		'before_title' => '<h3 class="title">',
        'after_title' => '</h3><div class="widget-content">',
    ));
?>