<?php
/**
 * @package WordPress
 * @subpackage chuxia
 * @since chuxia 1.0
 */
//include_once('optionclass.php');
//include_once('option.php');

/* remove */
include 'inc/remove.php';

/** 
 * 注册侧栏
 */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '全站侧栏',
        'id' => 'widget_sitesidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="title"><h2>',
        'after_title' => '</h2></div>'
    ));
}

/** 
 * 注册菜单
 */
if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
        'nav' => __('主要导航', 'chuxia') ,
        'topnav' => __('顶部导航 ', 'chuxia')
    ));
};

/** 
 * 缩略图
 */
function thumbnail_img() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
    if (empty($first_img)) { /* 无就调用其图库图片 */
        $first_img = get_stylesheet_directory_uri() . '/images/thumb.png';
        echo $first_img;
    }
    return $first_img;
}

/**
 * 获取WordPress所有分类名字和ID
 */
function show_category(){
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    foreach ($categorys as $category) { //调用菜单
        $output = '<a href="'.get_category_link($category->term_id).'" target="_blank">'.$category->name."[<em>".$category->term_id.'</em>]</a>';
        echo $output;
    }
}

/**
 * 当前分类下的子分类
 */
function get_cat_root_id($cat) {
    $categories = get_categories("child_of=$cat");
    foreach ($categories as $category) {
        $a = array_merge(array(
            $category->term_id
        ));
        //var_dump($a);
    }
}
function get_category_root_name($cat) {
    $this_category = get_category($cat); // 取得当前分类
    while ($this_category->category_parent) { // 若当前分类有上级分类时，循环
        $this_category = get_category($this_category->category_parent); //将当前分类设为上级分类（往上爬）
    }
    return $this_category->cat_name; // 返回根分类的id号
}
function get_category_root_id($cat) {
    $this_category = get_category($cat); // 取得当前分类
    while ($this_category->category_parent) { // 若当前分类有上级分类时，循环
        $this_category = get_category($this_category->category_parent); //将当前分类设为上级分类（往上爬）
    }
    return $this_category->term_id; // 返回根分类的id号
}
//article_category
function get_article_category_ID() {
    $category = get_the_category();
    return $category[0]->cat_ID;
}

/** 
 * 文章浏览次数
 */
function record_visitors() {
    if (is_singular()) {
        global $post;
        $post_ID = $post->ID;
        if ($post_ID) {
            $post_views = (int)get_post_meta($post_ID, 'views', true);
            if (!update_post_meta($post_ID, 'views', ($post_views + 1))) {
                add_post_meta($post_ID, 'views', 1, true);
            }
        }
    }
}
add_action('wp_head', 'record_visitors');
function post_views($before = '(点击', $after = '次) ', $echo = 1) {
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views) , $after;
    else return $views;
};
// 输出 if (function_exists('post_views')) post_views();

/**
 * 点击排行和评论排行
 */
//文章排行
function most_viewed($time, $limit) {
    global $wpdb, $post;
    $output = '<ul class="hot-in">';
    $most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date > '" . date('Y-m-d', strtotime("-$time days")) . "' AND post_type ='post' AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $limit");
    if ($most_viewed) {
	    $num = 1;
        foreach ($most_viewed as $post) {
	        $img = '<img src="'. get_bloginfo("template_url") .'/timthumb.php?src='. thumbnail_img().'&h=80&w=96&q=100&zc=1&ct=1&a=t"/>';
            $view = "<span>views:&nbsp;" . $post->views . "+</sapn>";
            $output.= '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark" title="' . $post->post_title . '" target="_blank">';
            $output.= '<div class="in-img">'. $img .'<span>'. $num ."</span></div>";
            $output.= '<div class="in-cont"><h2>'. $post->post_title .'</h2>'. $view ."</div>";
            $output.= '</a></li>';
            $num++;;
        }
        echo $output;
    }
}
//评论排行
function most_commmented($time, $limit) {
    global $wpdb, $post;
    $output = '<ul class="hot-in">';
    $most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.* FROM $wpdb->posts  WHERE post_date > date_sub( now(), interval $time day ) AND post_type ='post' AND post_status = 'publish'  AND post_password = '' ORDER BY comment_count DESC LIMIT $limit");
    if ($most_viewed) {
        $num = 1;
        foreach ($most_viewed as $post) {
	        $img = '<img src="'. get_bloginfo("template_url") .'/timthumb.php?src='. thumbnail_img().'&h=80&w=96&q=100&zc=1&ct=1&a=t"/>';
            $output.= '<li><a href="' . get_permalink($post->ID) . '" rel="bookmark" title="' . $post->post_title . '" target="_blank">';
            $output.= '<div class="in-img">'. $img .'<span>'. $num ."</span></div>";
            $output.= '<div class="in-cont"><h2>'. $post->post_title .'</h2><span>replies:&nbsp;'. $post->comment_count ."+</sapn></div>";
            $output.= '</a></li>';
            $num++;
        }
        $output.= "</ul>";
        echo $output;
    }
}

/* 面包屑导航 */
include 'inc/breadcrumbs.php';

/**
 * 获取链接
 */
function curPageURL() {
	$pageURL = 'http://';
	$this_page = $_SERVER["REQUEST_URI"]; 
	if (strpos($this_page , "?") !== false) 
		$this_page = reset(explode("?", $this_page));
	$pageURL .= $_SERVER["SERVER_NAME"]  . $this_page;
	return $pageURL;
}

/**
 * 添加AJAX文章喜欢点赞功能
 */
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like() {
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $bigfa_raters = get_post_meta($id, 'bigfa_ding', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; /* make cookies work with localhost */
        setcookie('bigfa_ding_' . $id, $id, $expire, '/', $domain, false);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        } else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }
        echo get_post_meta($id, 'bigfa_ding', true);
    }
    die;
}

/**
 * 评论样式
 */
// comments list
function chuxia_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    echo '<li ';
    comment_class();
    echo ' id="comment-' . get_comment_ID() . '">';
    echo '<div class="comment-body">';
    echo '<div class="comment-avatar">';
    if (function_exists('get_avatar') && get_option('show_avatars')) {
        echo get_avatar($comment, 50); /* 头像大小 */
    }
    echo '</div>';
    echo '<span class="comment-floor">';
    edit_comment_link('修改');
    echo '</span>';
    echo '<div class="comment-data">';
    echo '<span class="comment-span">';
    printf(__('<cite class="author-name">%s</cite>') , get_comment_author_link());
    echo '</span>';
    echo '<span class="comment-span comment-date">';
    echo '发表于：' . get_comment_time('Y-m-d H:i');
    echo '</span>';
    echo '</div>';
    echo '<div class="comment-text">';
    if ($comment->comment_approved == '0'):
        echo '<em>你的评论正在审核，稍后会显示出来！</em><br/>';
    endif;
    comment_text();
    echo '</div>';
    echo '<div class="comment-reply">';
    comment_reply_link(array_merge($args, array(
        'add_below' => $add_below,
        'depth' => $depth,
        'max_depth' => $args['max_depth']
    )));
    echo '</div>';
    echo '</div>';
}

/** 
 * 手动翻页码
 */
function chuxia_pagenavi() {
    global $wp_query, $wp_rewrite;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $args['total'] = $max;
    $args['current'] = $current;
    $total = 1;
    $args['mid_size'] = 3;
    $args['end_size'] = 1;
    $args['prev_text'] = '&laquo;Prev';
    $args['next_text'] = 'Next&raquo;';
    if ($max > 1) echo '<div class="navigation pagination">';
    echo $pages . paginate_links($args);
    if ($max > 1) echo '</div>';
}

/** 
 *  后台定制
 */
// 开启后台自定义背景
add_theme_support('bg');
//缩略图设置
add_theme_support('post-thumbnails');
set_post_thumbnail_size(320, 480, true);
//自动更改上传图片文件名称 
function huilang_wp_handle_upload_prefilter($file){ 
   $time=date("Y-m-d");  //改名称为年月日+随机数字
    $file['name'] = $time."".mt_rand(1,100).".".pathinfo($file['name'] , PATHINFO_EXTENSION); 
   return $file; 
} 
add_filter('wp_handle_upload_prefilter', 'huilang_wp_handle_upload_prefilter'); 
// 阻止站内文章Pingback
function tin_noself_ping(&$links) {
    $home = get_option('home');
    foreach ($links as $l => $link) if (0 === strpos($link, $home)) unset($links[$l]);
}
add_action('pre_ping', 'tin_noself_ping');
// 后台主题设置
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once dirname(__FILE__) . '/inc/options-framework.php';
// Loads options.php from child or parent theme
$optionsfile = locate_template('options.php');
load_template($optionsfile);
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
});
</script>
<?php
}

