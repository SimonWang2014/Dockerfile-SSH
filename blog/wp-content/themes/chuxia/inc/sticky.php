<div class="row w780 mt25">
	<?php 
	    $sticky = get_option('sticky_posts');
	    rsort( $sticky ); 
	    $sticky = array_slice( $sticky, 0, 3); 
	    query_posts( array( 'post__in' => $sticky, 
		'caller_get_posts' => 1 
		) ); 
	    if (have_posts()) :  while (have_posts()) : the_post(); 
	    ?> 
	<div class="pic fl">
		<a href="<?php the_permalink(); ?>" target="_blank">
			<img src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo thumbnail_img(); ?>&h=240&w=345&q=100&zc=1&ct=1&a=t" alt="<?php the_title(); ?>"/>
			<strong><?php the_title(); ?></strong>
		</a>
		</div>
	<?php endwhile; endif; wp_reset_query(); ?>
</div>