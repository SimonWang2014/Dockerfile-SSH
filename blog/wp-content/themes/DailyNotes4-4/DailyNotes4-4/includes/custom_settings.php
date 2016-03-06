<?php $postType = 'text';
if('note' == $post->post_type) $postType = 'text';
if('video' == $post->post_type) $postType = 'video';
if('quote' == $post->post_type) $postType = 'quote';
if('photo' == $post->post_type) $postType = 'photo';
if('customlink' == $post->post_type) $postType = 'link';
if('audio' == $post->post_type) $postType = 'audio'; ?>

<?php $taxonomyName = 'custom-tax';
if ($postType == 'video') $taxonomyName = 'custom-tax2';
if ($postType == 'quote') $taxonomyName = 'custom-tax3';
if ($postType == 'photo') $taxonomyName = 'custom-tax4';
if ($postType == 'customlink') $taxonomyName = 'custom-tax5';
if ($postType == 'audio') $taxonomyName = 'custom-tax6'; ?>
            
<?php $custom = get_post_custom($post->ID);
$link = ''; ?>
<?php if ($postType == 'link') $link = isset($custom["customlink"][0]) ? $custom["customlink"][0] : '';
if ($link == '') $link = get_permalink(); ?>