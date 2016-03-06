<?php global $arr; ?>

<div class="post" title="post_<?php echo $j; ?>">

	<?php if ($arr[$j]['posttype'] == 'text') { ?>
		<div class="inside">
			<div class="overflow">
				<h2><?php echo($arr[$j]['title']); ?></h2>
				<?php echo($arr[$j]['excerpt']); ?>
			</div>
			<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/icon-post.gif" alt="article post" />
		</div>
	<?php }; ?>	

	<?php if ($arr[$j]['posttype'] == 'quote') { ?>
		<div class="quote inside">
			<div class="overflow">
				<span class="quote">"</span><?php echo($arr[$j]['quote']) ?>"
			</div>
			<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/icon-quote.gif" alt="article post" />
		</div>
	<?php }; ?>

	<?php if ($arr[$j]['posttype'] == 'video') { ?>
		<div class="inside">
			<div class="overflow">
				<h2><?php echo($arr[$j]['title']); ?></h2>
				<?php echo($arr[$j]['excerpt']); ?>
			</div>
			<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/icon-video.gif" alt="article post" />
		</div>
	<?php }; ?>

	<?php if ($arr[$j]['posttype'] == 'audio') { ?>
		<div class="inside">
			<div class="overflow">
				<h2><?php echo($arr[$j]['title']); ?></h2>
				<?php echo($arr[$j]['excerpt']); ?>
			</div>
			<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/icon-audio.gif" alt="article post" />
		</div>
	<?php }; ?>

	<?php if ($arr[$j]['posttype'] == 'photo') { ?>
		<div class="inside">
			<span class="photospan">
				<img src="<?php bloginfo('template_directory'); ?>/images/shadow-overlay.png" alt="thumbnail" class="thumb_overlay" />
				<?php print_thumbnail($arr[$j]["thumb"], $arr[$j]["use_timthumb"], $arr[$j]['title'] , 149, 149, '', $post = $arr[$j]["post"]); ?>
			</span>
			<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/icon-photo.gif" alt="article post" />
		</div>
	<?php }; ?>

	<?php if ($arr[$j]['posttype'] == 'link') { ?>
		<div class="url inside">
			<div class="overflow">
				<?php echo($arr[$j]['link']) ?>
				<br class="clear" />
				<span>
					<?php echo($arr[$j]['excerpt']); ?>
				</span>
			</div>
			<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/icon-link.gif" alt="article post" />
		</div>
	<?php }; ?>

</div> <!-- .post -->