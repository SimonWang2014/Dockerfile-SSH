<?php
/**
 * 启用：转存至本地调用 Emoji 表情
 */
//首先补全wp的表情库
function smilies_reset() {
    global $wpsmiliestrans, $wp_smiliessearch;
    // don't bother setting up smilies if they are disabled
    if (!get_option('use_smilies')) {
        return;
    }
    $wpsmiliestrans_fixed = array(
        ':mrgreen:' => "\xf0\x9f\x98\xa2",
        ':smile:' => "\xf0\x9f\x98\xa3",
        ':roll:' => "\xf0\x9f\x98\xa4",
        ':sad:' => "\xf0\x9f\x98\xa6",
        ':arrow:' => "\xf0\x9f\x98\x83",
        ':-(' => "\xf0\x9f\x98\x82",
        ':-)' => "\xf0\x9f\x98\x81",
        ':(' => "\xf0\x9f\x98\xa7",
        ':)' => "\xf0\x9f\x98\xa8",
        ':?:' => "\xf0\x9f\x98\x84",
        ':!:' => "\xf0\x9f\x98\x85",
    );
    $wpsmiliestrans = array_merge($wpsmiliestrans, $wpsmiliestrans_fixed);
}
//替换cdn路径
function static_emoji_url() {
    return get_bloginfo('template_directory') . '/72x72/'; //表情路径
    
}
//让文章内容和评论支持 emoji 并禁用 emoji 加载的乱七八糟的脚本
function reset_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    add_filter('the_content', 'wp_staticize_emoji');
    add_filter('comment_text', 'wp_staticize_emoji', 50); //在转换为表情后再转为静态图片
    smilies_reset();
    add_filter('emoji_url', 'static_emoji_url');
}
add_action('init', 'reset_emojis');
//输出表情
function fa_get_wpsmiliestrans() {
    global $wpsmiliestrans;
    $wpsmilies = array_unique($wpsmiliestrans);
    foreach ($wpsmilies as $alt => $src_path) {
        $emoji = str_replace(array(
            '&#x',
            ';'
        ) , '', wp_encode_emoji($src_path));
        $output.= '<a class="add-smily" data-smilies="' . $alt . '"><img class="wp-smiley" src="' . get_bloginfo('template_directory') . '/72x72/' . $emoji . 'png" /></a>';
    }
    return $output;
}

