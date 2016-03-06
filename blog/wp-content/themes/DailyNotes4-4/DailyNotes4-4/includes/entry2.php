<?php include(TEMPLATEPATH.'/includes/custom_settings.php'); ?>

<?php 
$arr[$i]['title'] = truncate_title(250,false);
$arr[$i]['posttype'] = $postType;
$arr[$i]['excerpt'] = truncate_post(90,false);
if ($postType == 'quote') $arr[$i]['quote'] = isset($custom["quote"][0]) ? $custom["quote"][0] : '';
$arr[$i]['link'] = $link;
$arr[$i]["thumbnail"] = get_thumbnail(149,149,'',$arr[$i]["title"],$arr[$i]["title"],true,'thumb');	
$arr[$i]["thumb"] = $arr[$i]["thumbnail"]["thumb"];
$arr[$i]["use_timthumb"] = $arr[$i]["thumbnail"]["use_timthumb"];
$arr[$i]["post"] = $post; ?>

<div class="big_post" id="post_<?php echo $i; ?>">
	
	<img class="next" src="<?php bloginfo('template_directory'); ?>/images/<?php echo esc_attr($colorSchemePath); ?>arrow.gif" alt="next page" />
	<img class="previous" src="<?php bloginfo('template_directory'); ?>/images/<?php echo esc_attr($colorSchemePath); ?>previous.gif" alt="next page" />
	<span class="post_top"></span>
	<div class="post_info">
		<div class="inner-div">
			<span class="author"><?php the_author_posts_link(); ?></span>
			<span class="date"><?php the_time('F j, Y'); ?></span>
			
			<span class="categories">
				<?php echo get_the_term_list( $post->ID, $taxonomyName, '', ', ', ''); ?>
				<?php if (get_the_term_list( $post->ID, $taxonomyName, '', ', ', '')) echo(', '); the_category(', ') ?>
			</span>
			
			<span class="comments"><?php comments_popup_link(esc_html__('0 comments','DailyNotes'), esc_html__('1 comment','DailyNotes'), '% '.esc_html__('comments','DailyNotes')); ?></span>
			<span class="readmore">
				<?php if ($postType == 'link') { ?>
					<span><a href="<?php echo $link ?>"><?php esc_html_e('visit url ','DailyNotes'); ?>&raquo;</a></span>
				<?php } else { ?>
					<span><a href="<?php the_permalink(); ?>"><?php esc_html_e('full post ','DailyNotes'); ?>&raquo;</a></span>
				<?php }; ?>
			</span>
		</div>
	</div>
	<img class="close" src="<?php bloginfo('template_directory'); ?>/images/close.png" alt="close" />
	
	<?php if ($postType == 'text') { ?>
		<?php $thumb = '';
		$width = 200; $height = 200;
		$classtext = 'small-thumb';
		$titletext = get_the_title();
		$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,true,'thumb');
		$thumb = $thumbnail["thumb"]; ?>
		
		<h1><?php the_title(); ?></h1>
		<?php if (get_option('dailynotes_thumbnails') == 'on' && $thumb <> '') { ?>
		<a href="<?php echo $thumbnail["fullpath"]; ?>" class="lightbox fancybox" rel="gallery" title="<?php echo $titletext; ?>"><?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?></a>
		<?php }; ?>	
		<?php the_content(); ?>
		<br class="clear" />
		<span class="post_bottom"></span>
	<?php }; ?>
			
	<?php if ($postType == 'quote') { ?>
		<span class="big_quote"><?php $quote = isset($custom["quote"][0]) ? $custom["quote"][0] : ''; echo $quote; ?>"</span>
		<span class="post_bottom"></span>
	<?php }; ?>
			
	<?php if ($postType == 'video') { ?>
		<div class="video-wrap">
			<?php $video = isset($custom["video"][0]) ? $custom["video"][0] : '';
			$video_width = isset($custom["video_width"][0]) ? $custom["video_width"][0] : '526';
			$video_height = isset($custom["video_height"][0]) ? $custom["video_height"][0] : '351'; ?>
			
			<?php $video = preg_replace("/height=\"[0-9]*\"/", "height=$video_height", $video);
			$video = preg_replace("/width=\"[0-9]*\"/", "width=$video_width", $video);
			echo $video; ?>
		</div>
		<span class="post_bottom"></span>
	<?php }; ?>
			
	<?php if ($postType == 'audio') { ?>    
		<?php $audio = isset($custom["audio"][0]) ? $custom["audio"][0] : ''; ?>         

		<h1><?php the_title(); ?></h1>
		<div class="audio-block"> 
			<?php $postID = $post->ID; ?>				
			<p id="audioplayer_<?php echo($postID); ?>">Mp3 file</p>  
			<script type="text/javascript">  
				AudioPlayer.embed("audioplayer_<?php echo $postID; ?>", {soundFile: "<?php echo esc_js($audio); ?>"});
			</script> 
		</div>
		<br class="clear" />
		<?php the_content(); ?>
		<span class="post_bottom"></span>
	<?php }; ?>
			
	<?php if ($postType == 'photo') { ?>   
		<?php $thumb = '';
		$width = 526; $height = 351;
		$classtext = 'thumb';
		$titletext = get_the_title();
		$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,true,'thumb');
		$thumb = $thumbnail["thumb"]; ?>
	
		<div class="black">
			<a class="lightbox fancybox" href="<?php echo $thumbnail["fullpath"];?>" rel="gallery" title="<?php echo $titletext; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/shadow-overlay.png" alt="thumbnail" style="position: absolute; top: 0; left: 0; border: none;" /></a>
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
			<img src="<?php bloginfo('template_directory'); ?>/images/zoom.png" alt="zoom" class="zoom" />
		</div> <!-- end .black -->
		<span class="post_bottom"></span>
	<?php }; ?>

	<?php if ($postType == 'link') { ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<span class="post_bottom"></span>
	<?php }; ?>

</div> <!-- end .big_post -->