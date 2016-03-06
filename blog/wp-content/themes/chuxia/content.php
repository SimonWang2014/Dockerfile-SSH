
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<div class="post-info">
	<div class="pic fl">
		<a href="<?php the_permalink(); ?>" target="_blank">
			<img src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo thumbnail_img(); ?>&h=240&w=345&q=100&zc=1&ct=1&a=t" alt="<?php the_title(); ?>"/>
			<strong><?php the_title(); ?></strong>
		</a>
	</div>
	<div class="post-content w490 fr">
		<div class="post-tit">
			<h2>
				<?php 
					$category = get_the_category(); 
					if( $category[0] ){
						echo '<em><i>[</i><a href="'.get_category_link($category[0]->term_id ).'" title="'.$category[0]->cat_name.'">'.$category[0]->cat_name.'</a><i>]&nbsp;-&nbsp;</i></em>';
					};
					?>
				<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
		</div>
		<div class="post-artice">
		<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 168,"..."); ?>				</div>
		<div class="post-in">
			<span><?php the_time('Y-n-j'); ?>&nbsp;</span>
			<span>·&nbsp;<?php post_views(' ',' views '); ?>&nbsp;</span>
			<span>·&nbsp;<?php comments_popup_link ('0 replies','1 replies','% replies'); ?></span>
			<span class="t">·&nbsp;<?php the_tags(('标签: '), ' '); ?></span>
			<a class="fr" href="<?php the_permalink(); ?>" target="_blank">more+</a>
		</div>
	</div>
</div>
<?php 
	endwhile; endif; 
	chuxia_pagenavi();
	/* // wordpress 4.1新函数
	the_posts_pagination( array(
		'screen_reader_text' => __(' ', 'chuxia' ),
		'prev_text'          => __( 'Prev', 'chuxia' ),
		'next_text'          => __( 'Next', 'chuxia' ),
		'before_page_number' => __( '', 'chuxia' ),
	) ); */	
	?>
