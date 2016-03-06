<div class="post-related w780">
	<h3 class="h3">相关文章</h3>
	<?php
		//分类相关
		$exclude_id = $post->ID;
		$posttags = get_the_tags();
		$i = 0;
		$limit = 6;
		if ($posttags) {
		    $tags = '';
		    foreach ($posttags as $tag) $tags.= $tag->name . ',';
		    $args = array(
		        'post_status' => 'publish',
		        'tag_slug__in' => explode(',', $tags) ,
		        'post__not_in' => explode(',', $exclude_id) ,
		        'caller_get_posts' => 1,
		        'orderby' => 'comment_date',
		        'posts_per_page' => $limit
		    );
		    query_posts($args);
		    while (have_posts()) {
		        the_post(); ?>
		       <div class="post-r w360">
			    	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				    	<span><img src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo thumbnail_img(); ?>&h=80&w=100&q=100&zc=1&ct=1&a=t"/></span>
				    	<h3><?php the_title(); ?></h3>
				    	<p class="tip"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 58,"..."); ?></p>
				    </a>
			    </div>
			<?php
		        $exclude_id.= ',' . $post->ID;
		        $i++;
		    };
		    wp_reset_query();
		}
		if ($i < $limit) {
		    $cats = '';
		    foreach (get_the_category() as $cat) $cats.= $cat->cat_ID . ',';
		    $args = array(
		        'category__in' => explode(',', $cats) ,
		        'post__not_in' => explode(',', $exclude_id) ,
		        'caller_get_posts' => 1,
		        'orderby' => 'comment_date',
		        'posts_per_page' => $limit - $i
		    );
		    query_posts($args);
		    while (have_posts()) {
		        the_post(); ?>
		       <div class="post-r w360">
			    	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				    	<span><img src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo thumbnail_img(); ?>&h=80&w=100&q=100&zc=1&ct=1&a=t"/></span>
				    	<h3><?php the_title(); ?></h3>
				    	<p class="tip"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 58,"..."); ?></p>
				    </a>
			    </div>
			<?php
		        $i++;
		    };
		    wp_reset_query();
		}
		if ($i == 0) {
		    echo '<li>暂无相关文章！</li>';
		} ?>   

</div>
