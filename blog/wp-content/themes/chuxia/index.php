<?php get_header(); ?>

<div id="content">
	<div class="wrapper">
		<div class="main fl">
			<?php 
				//	Start the loop slide list
				if (get_op('slide')=='show'){
				include 'inc/slide.php'; };
				// Start the loop sticky list
				if (get_op('sticky')=='show'){
				include 'inc/sticky.php';}; 
				?>
			<div class="list w750 mt35">
				<h3 class="h3">最新文章</h3>
				<div class="post-list fl mt15">
				<?php 
					// Start the loop post list
					get_template_part( 'content', get_post_format() ); 
					?>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
