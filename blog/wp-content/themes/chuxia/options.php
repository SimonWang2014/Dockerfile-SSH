<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'theme-textdomain' ),
		'two' => __( 'Two', 'theme-textdomain' ),
		'three' => __( 'Three', 'theme-textdomain' ),
		'four' => __( 'Four', 'theme-textdomain' ),
		'five' => __( 'Five', 'theme-textdomain' )
	);

	// Display
	$display_array = array(
		'hide' => __( 'Hide', 'theme-textdomain' ),
		'show' => __( 'Show', 'theme-textdomain' ),
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'theme-textdomain' ),
		'two' => __( 'Pancake', 'theme-textdomain' ),
		'three' => __( 'Omelette', 'theme-textdomain' ),
		'four' => __( 'Crepe', 'theme-textdomain' ),
		'five' => __( 'Waffle', 'theme-textdomain' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/';

	$options = array();

	$options[] = array(
		'name' => __( '基本设置', 'theme-textdomain' ),
		'type' => 'heading'
	);

	// logo
	$options[] = array(
		'name' => __( 'logo', 'theme-textdomain' ),
		'desc' => __( '上传网站Logo图标', 'theme-textdomain' ),
		'id' => 'logo',
		'type' => 'upload'
	);
	
	// favicon
	$options[] = array(
		'name' => __( 'favicon', 'theme-textdomain' ),
		'desc' => __( '上传网站favicon图标', 'theme-textdomain' ),
		'id' => 'favicon',
		'type' => 'upload'
	);
	// sticky
	$options[] = array(
		'name' => __( '置顶文章', 'theme-textdomain' ),
		'desc' => __( '置顶文章显视隐藏设置.', 'theme-textdomain' ),
		'id' => 'sticky',
		'std' => 'show',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $display_array
	);
	// cat
	$options[] = array(
		'name' => __( '分类目录', 'theme-textdomain' ),
		'desc' => __( '分类目录显视隐藏设置.', 'theme-textdomain' ),
		'id' => 'cat',
		'std' => 'show',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $display_array
	);
	$options[] = array(
		'name' => __( '幻灯设置', 'theme-textdomain' ),
		'type' => 'heading'
	);
	// slider
	$options[] = array(
		'name' => __( '幻灯片', 'theme-textdomain' ),
		'desc' => __( '幻灯片显视隐藏设置.', 'theme-textdomain' ),
		'id' => 'slide',
		'std' => 'show',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $display_array
	);
	//slide1
	$options[] = array(
		'name' => __( '幻灯图片', 'theme-textdomain' ),
		'desc' => __( '幻灯图片1', 'theme-textdomain' ),
		'id' => 'slide_img1',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( '幻灯标题1', 'theme-textdomain' ),
		'desc' => __( '幻灯标题1.', 'theme-textdomain' ),
		'id' => 'slide_tit1',
		'std' => '',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => __( '幻灯链接地址1', 'theme-textdomain' ),
		'desc' => __( '幻灯链接地址1.', 'theme-textdomain' ),
		'id' => 'slide_url1',
		'std' => '',
		'type' => 'text'
	);	
	//slide2
	$options[] = array(
		'name' => __( '幻灯图片', 'theme-textdomain' ),
		'desc' => __( '幻灯图片2', 'theme-textdomain' ),
		'id' => 'slide_img2',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( '幻灯标题2', 'theme-textdomain' ),
		'desc' => __( '幻灯标题2.', 'theme-textdomain' ),
		'id' => 'slide_tit2',
		'std' => '',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => __( '幻灯链接地址2', 'theme-textdomain' ),
		'desc' => __( '幻灯链接地址2.', 'theme-textdomain' ),
		'id' => 'slide_url2',
		'std' => '',
		'type' => 'text'
	);	
	//slide3
	$options[] = array(
		'name' => __( '幻灯图片3', 'theme-textdomain' ),
		'desc' => __( '幻灯图片3', 'theme-textdomain' ),
		'id' => 'slide_img3',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( '幻灯标题3', 'theme-textdomain' ),
		'desc' => __( '幻灯标题3.', 'theme-textdomain' ),
		'id' => 'slide_tit3',
		'std' => '',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => __( '幻灯链接地址l3', 'theme-textdomain' ),
		'desc' => __( '幻灯链接地址3.', 'theme-textdomain' ),
		'id' => 'slide_url3',
		'std' => '',
		'type' => 'text'
	);	
	// slide4
	$options[] = array(
		'name' => __( '幻灯图片4', 'theme-textdomain' ),
		'desc' => __( '幻灯图片4', 'theme-textdomain' ),
		'id' => 'slide_img4',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( '幻灯标题4', 'theme-textdomain' ),
		'desc' => __( '幻灯标题4.', 'theme-textdomain' ),
		'id' => 'slide_tit4',
		'std' => '',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => __( '幻灯链接地址4', 'theme-textdomain' ),
		'desc' => __( '幻灯链接地址4.', 'theme-textdomain' ),
		'id' => 'slide_url4',
		'std' => '',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( 'SEO设置', 'theme-textdomain' ),
		'type' => 'heading'
	);

	// keywords
	$options[] = array(
		'name' => __( 'Keywords', 'theme-textdomain' ),
		'desc' => __( '网站关键字设置.', 'theme-textdomain' ),
		'id' => 'keywords',
		'std' => '',
		'type' => 'textarea'
	);

	// keywords
	$options[] = array(
		'name' => __( 'Description', 'theme-textdomain' ),
		'desc' => __( '网站描述设置.', 'theme-textdomain' ),
		'id' => 'description',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( '其它设置', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	$options[] = array(
		'name' => __( '友情链接设置', 'theme-textdomain' ),
		'desc' => sprintf( __( '友情链接设置篇辑器.', 'theme-textdomain' )),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);
	$options[] = array(
		'name' => __( 'AD设置', 'theme-textdomain' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '边栏广告', 'theme-textdomain' ),
		'desc' => __( '边栏广告1.', 'theme-textdomain' ),
		'id' => 'ad1',
		'std' => '',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '边栏广告', 'theme-textdomain' ),
		'desc' => __( '边栏广告2.', 'theme-textdomain' ),
		'id' => 'ad2',
		'std' => '',
		'type' => 'text'
	);

	return $options;
	
}