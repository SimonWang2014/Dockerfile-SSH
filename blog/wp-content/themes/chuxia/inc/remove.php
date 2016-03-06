<?php
/* -------------------------------------------------- *
 * WordPress 后台禁用Google Open Sans字体，加速网站
/* ------------------------------------------------- */
if (!function_exists('remove_wp_open_sans')):
    function remove_wp_open_sans() {
        wp_deregister_style('open-sans');
        wp_register_style('open-sans', false);
    }
    // 前台删除Google字体CSS
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
    // 后台删除Google字体CSS
    add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;
//Gravatar头像缓存
function mytheme_get_avatar($avatar) {
    $avatar = preg_replace("/http:\/\/(www|\d).gravatar.com/", "http://0.bsdev.cn/", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'mytheme_get_avatar');

/** 
 * 移除版本号
 */
function themepark_remove_cssjs_ver($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version'))) $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'themepark_remove_cssjs_ver', 999);
add_filter('script_loader_src', 'themepark_remove_cssjs_ver', 999);

/** 
 * 去除头部冗余代码
 */
function remove_open_sans() {
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'remove_open_sans');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'rel_canonical');
remove_action('pre_post_update', 'wp_save_post_revision');

/** 
 * 首页排除某些分类文章显视
 */
function exclude_category_home($query) {
    if ($query->is_home) {
        $query->set('cat', 'ID'); // 注意根据自己的需要，修改分类ID，比如你想排除分类-4 和 -23，
        $query->set('ignore_sticky_posts', '1'); // 如果你不希望在顶部显示置顶文章
        $query->set('orderby', 'date'); // 老文章在上面
        $query->set('order', 'DESC'); // 新文章跑到最下面
    }
    return $query;
} // 最简单的方法就是通过 pre_get_posts  钩子来改变主查询
add_filter('pre_get_posts', 'exclude_category_home');

/** 
 * 过滤掉菜单样式
 */
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
    // 保留选择器
    return is_array($var) ? array_intersect($var, array(
        'current-menu-item',
        'current-post-ancestor',
        'current-menu-ancestor',
        'current-menu-parent'
    )) : '';
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array(
            'wpemoji'
        ));
    } else {
        return array();
    }
}
// 移除WordPress头部最新评论的内联样式
function twentyten_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
add_action('widgets_init', 'twentyten_remove_recent_comments_style');

