<?php add_action('init', 'et_note_register');
add_action('init', 'et_photo_register');
add_action('init', 'et_quote_register');
add_action('init', 'et_video_register');
add_action('init', 'et_customlink_register');
add_action('init', 'et_audio_register');

add_action( 'init', 'et_create_taxonomies', 0 );

add_action("admin_init", "et_add_custom_post_metaboxes");

 
function et_create_taxonomies() {
	register_taxonomy("custom-tax", array("note"), array("hierarchical" => true, "label" => "Taxonomies", "singular_label" => "Taxonomy", "rewrite" => true));
	register_taxonomy("custom-tax2", array("video"), array("hierarchical" => true, "label" => "Taxonomies", "singular_label" => "Taxonomy", "rewrite" => true));
	register_taxonomy("custom-tax3", array("quote"), array("hierarchical" => true, "label" => "Taxonomies", "singular_label" => "Taxonomy", "rewrite" => true));
	register_taxonomy("custom-tax4", array("photo"), array("hierarchical" => true, "label" => "Taxonomies", "singular_label" => "Taxonomy", "rewrite" => true));
	register_taxonomy("custom-tax5", array("customlink"), array("hierarchical" => true, "label" => "Taxonomies", "singular_label" => "Taxonomy", "rewrite" => true));
	register_taxonomy("custom-tax6", array("audio"), array("hierarchical" => true, "label" => "Taxonomies", "singular_label" => "Taxonomy", "rewrite" => true));
} 
 
function et_note_register() {
 
	$labels = array(
		'name' => _x('Notes', 'post type general name'),
		'singular_name' => _x('Notes', 'post type singular name'),
		'add_new' => _x('Add Note', 'note item'),
		'add_new_item' => __('Add Note'),
		'edit_item' => __('Edit Note'),
		'new_item' => __('New Note'),
		'view_item' => __('View Note'),
		'search_items' => __('Search Note'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt','comments','revisions','custom-fields')
	); 
 
	register_post_type( 'note' , $args );
	
	register_taxonomy_for_object_type('category', 'note');
    register_taxonomy_for_object_type('post_tag', 'note');
}

function et_photo_register() {
 
	$labels = array(
		'name' => _x('Photo', 'post type general name'),
		'singular_name' => _x('Photo', 'post type singular name'),
		'add_new' => _x('Add Photo', 'photo item'),
		'add_new_item' => __('Add Photo'),
		'edit_item' => __('Edit Photo'),
		'new_item' => __('New Photo'),
		'view_item' => __('View Photo'),
		'search_items' => __('Search Photo'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt','comments','revisions','custom-fields')
	); 
 
	register_post_type( 'photo' , $args );
	
	register_taxonomy_for_object_type('category', 'photo');
    register_taxonomy_for_object_type('post_tag', 'photo');
}

function et_quote_register() {
 
	$labels = array(
		'name' => _x('Quote', 'post type general name'),
		'singular_name' => _x('Quote', 'post type singular name'),
		'add_new' => _x('Add Quote', 'quote item'),
		'add_new_item' => __('Add Quote'),
		'edit_item' => __('Edit Quote'),
		'new_item' => __('New Quote'),
		'view_item' => __('View Quote'),
		'search_items' => __('Search Quote'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt','comments','revisions','custom-fields')
	); 
 
	register_post_type( 'quote' , $args );
	
	register_taxonomy_for_object_type('category', 'quote');
    register_taxonomy_for_object_type('post_tag', 'quote');
}

function et_video_register() {
 
	$labels = array(
		'name' => _x('Video', 'post type general name'),
		'singular_name' => _x('Video', 'post type singular name'),
		'add_new' => _x('Add Video', 'video item'),
		'add_new_item' => __('Add Video'),
		'edit_item' => __('Edit Video'),
		'new_item' => __('New Video'),
		'view_item' => __('View Video'),
		'search_items' => __('Search Video'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt','comments','revisions','custom-fields')
	); 
 
	register_post_type( 'video' , $args );
	
	register_taxonomy_for_object_type('category', 'video');
    register_taxonomy_for_object_type('post_tag', 'video');
}

function et_customlink_register() {
 
	$labels = array(
		'name' => _x('Link', 'post type general name'),
		'singular_name' => _x('Link', 'post type singular name'),
		'add_new' => _x('Add Link', 'customlink item'),
		'add_new_item' => __('Add Link'),
		'edit_item' => __('Edit Link'),
		'new_item' => __('New Link'),
		'view_item' => __('View Link'),
		'search_items' => __('Search Link'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt','comments','revisions','custom-fields')
	); 
 
	register_post_type( 'customlink' , $args );
	
	register_taxonomy_for_object_type('category', 'customlink');
    register_taxonomy_for_object_type('post_tag', 'customlink');
}

function et_audio_register() {
 
	$labels = array(
		'name' => _x('Audio', 'post type general name'),
		'singular_name' => _x('Audio', 'post type singular name'),
		'add_new' => _x('Add Audio', 'audio item'),
		'add_new_item' => __('Add Audio'),
		'edit_item' => __('Edit Audio'),
		'new_item' => __('New Audio'),
		'view_item' => __('View Audio'),
		'search_items' => __('Search Audio'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt','comments','revisions','custom-fields')
	); 
 
	register_post_type( 'audio' , $args );
	
	register_taxonomy_for_object_type('category', 'audio');
    register_taxonomy_for_object_type('post_tag', 'audio');
}


function et_add_custom_post_metaboxes(){
	add_meta_box("text_meta", "ET Settings", "et_text_meta", "note", "normal", "high");
	add_meta_box("text_meta", "ET Settings", "et_text_meta", "photo", "normal", "high");
	add_meta_box("quote_meta", "ET Settings", "et_quote_meta", "quote", "normal", "high");
	add_meta_box("video_meta", "ET Settings", "et_video_meta", "video", "normal", "high");
	add_meta_box("customlink_meta", "ET Settings", "et_customlink_meta", "customlink", "normal", "high");
	add_meta_box("audio_meta", "ET Settings", "et_audio_meta", "audio", "normal", "high");
}
 
function et_text_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$thumb = isset($custom["thumb"][0]) ? $custom["thumb"][0] : '';	?>
	<p><label for="thumb">Thumbnail:</label><br />
	<textarea rows="2" name="thumb" id="thumb" style="width: 90%;"><?php echo esc_textarea( $thumb ); ?></textarea></p>
	<?php
}

function et_quote_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$quote = isset($custom["quote"][0]) ? $custom["quote"][0] : '';	?>
	<p><label for="quote">Quote Text:</label><br />
	<textarea rows="10" name="quote" id="quote" style="width: 90%;"><?php echo esc_textarea( $quote ); ?></textarea></p>
	<?php
}

function et_video_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$video_code = isset($custom["video"][0]) ? $custom["video"][0] : '';
	$video_width = isset($custom["video_width"][0]) ? $custom["video_width"][0] : '424';
	$video_height = isset($custom["video_height"][0]) ? $custom["video_height"][0] : '264';	?>
	<p><label for="video_code">Video Embed Code:</label><br />
	<textarea rows="10" name="video_code" id="video_code" style="width: 90%;"><?php echo esc_textarea( $video_code ); ?></textarea></p>
	
	<p><label for="video_width">Video Width:</label><br />
	<input name="video_width" id="video_width" type="text" style="width: 90%;" value="<?php echo esc_attr( $video_width ); ?>" /></p>
	
	<p><label for="video_height">Video Height:</label><br />
	<input name="video_height" id="video_height" type="text" style="width: 90%;" value="<?php echo esc_attr( $video_height ); ?>" /></p>
	<?php
}

function et_customlink_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$customlink = isset( $custom["customlink"][0] ) ? $custom["customlink"][0] : ''; ?>
		
	<p><label for="customlink">Site URL:</label><br />
	<input name="customlink" id="customlink" type="text" style="width: 90%;" value="<?php echo esc_url( $customlink ); ?>" /></p>
	<?php
}

function et_audio_meta() {
	global $post;
	$custom = get_post_custom($post->ID);
	$audio = isset( $custom["audio"][0] ) ? $custom["audio"][0] : '';	?>
		
	<p><label for="audio-url">Audio URL:</label><br />
	<input name="audio-url" id="audio-url" type="text" style="width: 90%;" value="<?php echo esc_url( $audio ); ?>" /></p>
	<?php
}

add_action('save_post', 'et_custom_post_save_details');
function et_custom_post_save_details($post_id){
	global $pagenow;
	if ( 'post.php' != $pagenow ) return $post_id;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
	
	/*if ( ( 'note' == $_POST['post_type'] || 'photo' == $_POST['post_type'] || 'quote' == $_POST['post_type'] || 'video' == $_POST['post_type'] || 'customlink' == $_POST['post_type'] || 'audio' == $_POST['post_type'] ) && !wp_verify_nonce( $_POST['et_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}*/	
	
	if ( isset($_POST["thumb"]) ) update_post_meta($post_id, "thumb", $_POST["thumb"]);
	if ( isset($_POST["quote"]) ) update_post_meta($post_id, "quote", $_POST["quote"]);
	if ( isset($_POST["video_code"]) ) update_post_meta($post_id, "video", $_POST["video_code"]);
	if ( isset($_POST["video_width"]) ) update_post_meta($post_id, "video_width", (int) $_POST["video_width"]);
	if ( isset($_POST["video_height"]) ) update_post_meta($post_id, "video_height", (int) $_POST["video_height"]);
	if ( isset($_POST["customlink"]) ) update_post_meta($post_id, "customlink", esc_url( $_POST["customlink"] ));
	if ( isset($_POST["audio-url"]) ) update_post_meta($post_id, "audio", esc_url( $_POST["audio-url"] ));
}

function et_add_custom_posts_to_rss( $qv ) {
	if ( isset($qv['feed']) )
		$qv['post_type'] = array('post','note','photo','quote','video','customlink','audio');
	return $qv;
}
add_filter('request', 'et_add_custom_posts_to_rss');

function et_insert_thumbnail_rss($content) {
	global $post;
	$custom = get_post_custom($post->ID);
	$thumb = ''; $thumb = get_post_meta($post->ID, 'thumb',true);
	$quote = ''; $quote = get_post_meta($post->ID, 'quote',true);
	$link = ''; $link = get_post_meta($post->ID, 'customlink',true);
			
	if ( has_post_thumbnail( $post->ID ) ){
	   $content = '<p>' . get_the_post_thumbnail( $post->ID, 'medium' ) . '</p>' . $content;
	} else if ($thumb <> '') {
		$content = '<p>' . '<img src="'. et_new_thumb_resize( et_multisite_thumbnail($thumb), 300, 200, '', true ) .'"/>' . '</p>' . $content;
	}

	if ( $quote <> '' ) $content = '<p>' . $quote . '</p>' . $content;
	
	if ( $link <> '' ) $content = $content . '<p><a href="' . esc_url($link) . '">Link</a></p>';
	
	return $content;
}
add_filter('the_excerpt_rss', 'et_insert_thumbnail_rss');
add_filter('the_content_feed', 'et_insert_thumbnail_rss'); ?>