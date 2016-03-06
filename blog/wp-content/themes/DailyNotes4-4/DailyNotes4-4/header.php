<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE 7]>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie7style.css" />
	<![endif]-->	
	<!--[if IE 8]>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie8style.css" />
	<![endif]-->	
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie6style.css" />
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script type="text/javascript">DD_belatedPNG.fix('.image img, img.overlay, div#wrapper1, div#wrapper2, img.thumb_overlay, a.lightbox img, span.avatar-overlay');</script>
	<![endif]-->

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/audio-player.js"></script>  
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js"></script>  
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/raleway_thin.js"></script>  
<script type="text/javascript"> 
	Cufon.replace('h1')('h2')('h3')('h4')('h5')('.fn');
	AudioPlayer.setup("<?php bloginfo('template_directory'); ?>/js/player.swf", { width: 380 });  
</script> 

</head>
<body <?php body_class(); ?>>
<div id="wrapper1">
    <div id="wrapper2">
        <div id="content">
			<?php global $default_colorscheme,$shortname, $colorSchemePath;
            $colorSchemePath = '';
            $colorScheme = get_option($shortname . '_color_scheme');
            if ($colorScheme <> $default_colorscheme) $colorSchemePath = strtolower($colorScheme) . '/'; ?>
			
        	<a href="<?php bloginfo('url'); ?>"><?php $logo = (get_option('dailynotes_logo') <> '') ? get_option('dailynotes_logo') : get_bloginfo('template_directory').'/images/'.$colorSchemePath.'logo.png'; ?>
				<img src="<?php echo esc_url($logo); ?>" alt="Logo" id="logo"/></a>
            <br class="clear" />
            <?php $menuClass = 'nav superfish';
			$primaryNav = '';
			
			if (function_exists('wp_nav_menu')) {
				$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false ) );
			};
			if ($primaryNav == '') { ?>
				<ul class="<?php echo $menuClass; ?>">
					<?php if (get_option('dailynotes_home_link') == 'on') { ?>
						<li class="page_item<?php if(is_home()) echo(' current_page_item'); ?>"><a href="<?php bloginfo('url'); ?>"><?php esc_html_e('Home','DailyNotes') ?></a></li>
					<?php }; ?>
					
					<?php show_page_menu($menuClass,false,false);
					  	  show_categories_menu($menuClass,false); ?>
				</ul> <!-- end ul.nav -->
			<?php }
			else echo($primaryNav); ?>
            <div id="search-wrap">
                 <a href="<?php bloginfo('rss_url'); ?>"><img id="rss" src="<?php bloginfo('template_directory'); ?>/images/<?php if ( $colorScheme <> $default_colorscheme) echo($colorSchemePath.'/'); ?>rss.gif" alt="rss" /></a>
                <img id="search" src="<?php bloginfo('template_directory'); ?>/images/<?php echo esc_attr($colorSchemePath); ?>search.gif" alt="search" />
                <div id="search-form">
                    <form method="get" id="searchform" action="<?php echo home_url(); ?>">
                        <input type="text" value="<?php esc_attr_e('search this site...','DailyNotes'); ?>" name="s" id="searchinput" />
                    </form>
                </div>
            </div>
            <br class="clear" />