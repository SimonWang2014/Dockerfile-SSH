<div class="sidebar w320 fr">
	<div id="localtime"></div>
	<div class="window mt25">
		<img src="<?php echo bloginfo('template_url'); ?>/img/img1.png"/>
	</div>
	<?php if(is_single()){
		// echo '暂时想不出什么模块！';
		} elseif (get_op('cat')=='show'){ 
			include 'inc/catalog.php'; 
		};?>
	<div class="news w350 mt25">
		<h3 class="h3">热门推荐</h3>
		<ul>
		<?php
			$rand_posts = get_posts('numberposts=4&orderby=rand&post_status=publish');
			foreach( $rand_posts as $post ) : ?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank">
					<div class="news-img">
						<img src="<?php echo get_bloginfo("template_url") ?>/timthumb.php?src=<?php echo thumbnail_img(); ?>&h=95&w=143&q=100&zc=1&ct=1&a=t"/>
					</div>
					<p><?php the_title(); ?></p>
				</a>
			</li>
			<?php endforeach; wp_reset_query(); ?>
		</ul>
	</div>
	<div class="window mt15">
		<img src="<?php echo bloginfo('template_url'); ?>/img/img3.png"/>
	</div>
	<div class="hot mt25">
		<?php
		if(is_single()){
			echo '<h3 class="h3">热评文章</h3>';
			most_commmented(15,5); // 评论热文
		}else{
			echo '<h3 class="h3">热点文章</h3>';
			most_viewed(365,5); // 点击热文
		}
		?>
	</div>
	<div class="tags fd w320 mt25">
		<h3 class="h3">标签集合</h3>
	    <?php 
			$tags_list = get_tags('orderby=count&order=DESC&number=50');
			if ($tags_list) { 
				foreach($tags_list as $tag) {
					echo '<a href="'.get_tag_link($tag).'" target="_blank">'. $tag->name .' ('. $tag->count .')</a>';					} 
			}else{
				echo '暂无标签！';
			}; ?>
	</div>
</div>
