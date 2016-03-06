<?php
define('THEMEVER', '2.0'); # Define the Theme's Version

//theme setup
if (!function_exists( 'simplehome_setup' )) :
function simplehome_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => 'Primary Menu',
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link' ) );
	
}
endif; // simplehome_setup
add_action( 'after_setup_theme', 'simplehome_setup' );

/* Load Scripts and Styles */
function simplehome_scripts_styles() {
	
	//Enqueue Styles
	wp_enqueue_style( 'style', get_stylesheet_uri() , array(), THEMEVER, false);
	
	//Enqueue Custom skin color Styles
	$skinName = 'skin-red'; //default
	if (get_option('mytheme_skincolor')!='')
		$skinName = get_option('mytheme_skincolor');
	wp_enqueue_style('skincolor', get_template_directory_uri() . '/css/skin/'.$skinName.'.css', array(), THEMEVER, false);
	
	//Enqueue Wp-MediaElement Scripts
    wp_enqueue_script('jQuery');
	
	//Enqueue Wp-MediaElement Styles
    wp_enqueue_style('wp-mediaelement');
	
	//Enqueue Wp-MediaElement Scripts
    wp_enqueue_script('wp-mediaelement');
	
	//comments JS
	wp_enqueue_script( 'comments-js', get_template_directory_uri() . '/comments-ajax.js', false, false , true );
	
}
add_action( 'wp_enqueue_scripts', 'simplehome_scripts_styles' );

//Custom smilies src
function custom_smilies_src ($img_src, $img, $siteurl){
	return get_bloginfo('template_directory').'/smilies/'.$img;
}
add_filter('smilies_src','custom_smilies_src',1,10);

/* Comments Time Since by mufeng.me */
function time_since($older_date,$comment_date = false) {
	$chunks = array(
		array(86400 , '天前'),
		array(3600 , '小时前'),
		array(60 , '分钟前'),
		array(1 , '秒前'),
	);
	$newer_date = time();
	$since = abs($newer_date - $older_date);
	if($since < 2592000){
		for ($i = 0, $j = count($chunks); $i < $j; $i++){
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			if (($count = floor($since / $seconds)) != 0) break;
		}
		$output = $count.$name;
	}else{
		$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
	}
	return $output;
}
/* Custom Comment Output by zhw-island.com */
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author"><?php echo get_avatar( $comment, $size = '32'); ?></div>
			<div class="comment-head">
				<span class="name"><?php printf(__('%s'), get_comment_author_link()) ?></span>
				<span class="num"> <?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?></span>
				<p> <?php comment_text() ?> </p>
				<div class="post-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></div>
				<div class="date"><?php echo time_since(abs(strtotime($comment->comment_date_gmt . "GMT")), true);?></div>
			</div>

    </div>
<?php
}

/* Page Navigation */
function pagenavi() {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'show_all' => false,
		'end_size'=>'1',   
        'mid_size'=>'5',
        'type' => 'plain',
        'prev_next' => false
    );
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
	previous_posts_link('&laquo;','');
    echo paginate_links($pagination);
	next_posts_link('&raquo;','');
	if( $pagination['total']>1 ){
	}
}

/* Custom the Excerpt's length */
function custom_excerpt_length( $length ) {
    return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/* Custom Sidebar */
function wp_sidebar(){
	register_sidebar(array(
		'id'=>'mytheme_sidebar',
		'name'=>'全局侧栏',
		'class'=>'box-content',
		'before_widget' => '<div id="%1$s" class="widget sidebox %2$s">',
		//html after widget
		'after_widget'  => '</div>',
		//html before widget
		'before_title'  => '<i class="fa fa-caret-down"></i><h2>',
		//html after widget
		'after_title'   => '</h2>'
	));
}
add_action('widgets_init','wp_sidebar');

/* Print Tags */
function tagtext() {
	global $post;
	$gettags = get_the_tags($post->ID);
	if($gettags) {
	foreach ($gettags as $tag) {
		$posttag[] = $tag->name;
		}
		$tags = implode( ',', $posttag );
		return $tags;
	}
}

/* Get Article Category ID*/
function get_article_category_ID(){
    $category=get_the_category();
    return $category[0]->cat_ID;
}

/* Get Category Root ID */
function get_category_root_id($cat)
{
	$this_category = get_category($cat);   // get current category
	while($this_category->category_parent) // if has parent, continue
	{
		$this_category = get_category($this_category->category_parent); // change the parent as current
	}
	return $this_category->term_id; // return root id
}
remove_action('wp_head', 'wp_generator');

/* Remove wordpress version meta
**
** If you don't wannt to do, you can delete it.
**
 */
function remove_wordpress_version() { return ''; } add_filter('the_generator', 'remove_wordpress_version');

/* Remove Wordpress Admin bar */
if (!function_exists('df_disable_admin_bar')) {
    function df_disable_admin_bar() {
        // for the admin page
        remove_action('admin_footer', 'wp_admin_bar_render', 1000);
        // for the front-end
        remove_action('wp_footer', 'wp_admin_bar_render', 1000);
        // css override for the admin page
        function remove_admin_bar_style_backend() {
            echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
        }
        add_filter('admin_head','remove_admin_bar_style_backend');
        // css override for the frontend
        function remove_admin_bar_style_frontend() {
            echo '<style type="text/css" media="screen">
            html { margin-top: 0px !important; }
            * html body { margin-top: 0px !important; }
            </style>';
        }
        add_filter('wp_head','remove_admin_bar_style_frontend', 99);
      }
}
show_admin_bar(false);
add_action('init','df_disable_admin_bar');

//Enable link manager
//add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/* Weather for Aside */
function get_weather() {
	return array(
		'sunny'=>'晴',
		'night'=>'夜',
		'partly-cloudy'=>'少云',
		'cloudy'=>'多云',
		'night-cloudy'=>'夜间多云',
		'cloudy-day'=>'阴天',
		'shower'=>'阵雨',
		'rain'=>'雨',
		'heavy-rain'=>'暴雨',
		'thunder-shower'=>'雷阵雨',
		'snow'=>'雪',
		'sleet'=>'雨夹雪',
		'ice-rain'=>'雨夹雪',
		'heavy-snow'=>'大雪',
		'haze'=>'阴霾',
		'fog'=>'多雾'
	);
}

/* Custom Post Meta*/
$new_meta_boxes =      
	array(      
		"music_url" => array(      
			"name" => "music_url",      
			"std" => "音乐",      
			"title" => "音乐地址："),
		"weather" => array(      
			"name" => "weather",      
			"std" => "天气",      
			"title" => "选择天气：")
	);
function new_meta_boxes() {      
	global $post, $new_meta_boxes;      
	foreach($new_meta_boxes as $meta_box) {      
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);          
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';      
		echo'<h4>'.$meta_box['std'].'</h4>';      
		if ($meta_box['name']=='weather') {
		?>
                    <select name="<?=($meta_box['name'].'_value')?>">
                    <?php
					$weather = get_weather();
					foreach($weather as $key=>$val) {
					?>
                    	<option <?php if ($key==$meta_box_value) echo "selected"; ?> value="<?=($key)?>"><?=($val)?></option>
                    <?php
					}
					?>
                    </select>
                    <?php
		} else {
			echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
		}
	}      
}
//create meta box
function create_meta_box() {      
	global $theme_name;      
	if ( function_exists('add_meta_box') ) {      
		add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );      
	}      
}
//save post meta data
function save_postdata( $post_id ) {      
	global $post, $new_meta_boxes;      
	foreach($new_meta_boxes as $meta_box) {      
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {      
			return $post_id;      
		}      
		if ( 'page' == $_POST['post_type'] ) {      
			if ( !current_user_can( 'edit_page', $post_id ))      
				return $post_id;      
		}       
		else
		{      
			if ( !current_user_can( 'edit_post', $post_id ))      
				return $post_id;      
		}      
		$data = $_POST[$meta_box['name'].'_value'];      
         
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")      
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);      
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))      
			update_post_meta($post_id, $meta_box['name'].'_value', $data);      
		elseif($data == "")      
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));      
	}      
}
add_action('admin_menu', 'create_meta_box');      
add_action('save_post', 'save_postdata');

/* Register Shortcode */
function shortcode_button($atts, $content = null) {
extract(shortcode_atts(array(
"href" => 'http://',
"color"=> 'red',
"target"=>'_blank'
), $atts));
return '<span class="button btn-'.$color.'"><a href="'.$href.'" target="'.$target.'">'.$content.'</a></span>';
}
add_shortcode('button','shortcode_button');

/* Theme option */
include('includes/admin/init.php');

/* Register Sidebar Widgets */
include(TEMPLATEPATH.'/includes/widgets/hotTag.class.php');
include(TEMPLATEPATH.'/includes/widgets/latestComment.class.php');

/* Taxonomy fields */
include(TEMPLATEPATH.'/includes/taxonomy-fields.php');
?>