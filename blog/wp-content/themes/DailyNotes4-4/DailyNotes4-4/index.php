<?php get_header(); ?>
	
<?php $postTypes = array('note','photo','quote','video','customlink','audio','post');
if (is_home()) $post_number = (int) get_option('dailynotes_homepage_posts'); ?>

<?php global $query_string; 
	$qstring_array = array();
	$et_settings_query = array('paged'=>$paged,'post_type'=>$postTypes);
	if ( is_home() ) $et_settings_query['showposts'] = $post_number;
	parse_str($query_string,  $qstring_array);
	$args = $et_settings_query;
	$args = array_merge($args,$qstring_array);
	query_posts($args);
?>

<?php 
if (isset($_REQUEST["post_type"])) {
	$args=array(
	   'showposts'=> (int) get_option('dailynotes_archive_customposts'),
	   'paged'=>$paged,
	   'post_type' => $_REQUEST["post_type"]
	);
	query_posts($args);
}; ?>

<div id="posts_big">
	<?php $i = 0; if (have_posts()) : while (have_posts()) : the_post(); $i++; ?>
		<?php include(TEMPLATEPATH . '/includes/entry2.php'); ?>		
    <?php endwhile; ?>
	<?php $nextPostsLink = get_next_posts_link('<img id="next2" src="'.get_bloginfo('template_directory').'/images/'.esc_attr( $colorSchemePath ).'arrow.gif" alt="next page" />', 0); ?>
    <?php $previousPostsLink = get_previous_posts_link('<img id="previous2" src="'.get_bloginfo('template_directory').'/images/'.esc_attr( $colorSchemePath ).'previous.gif" alt="next page" />', 0); ?>
<?php else : 
		include(TEMPLATEPATH . '/includes/no-results.php'); 
	endif;
	wp_reset_query(); ?>
</div>	


<?php global $colorSchemePath; ?>
<div id="posts">
	<?php echo $nextPostsLink; echo $previousPostsLink; ?>
    <?php for ($j = 1; $j <= $i; $j++) { ?>
		<?php include(TEMPLATEPATH . '/includes/entry.php'); ?>
	<?php }; ?>
	
	<div id="footer"><?php esc_html_e('designed by ','DailyNotes'); ?> <a href="http://www.elegantthemes.com">elegant themes</a></div>
</div>	<!-- end #posts -->
								
<?php get_footer(); ?>