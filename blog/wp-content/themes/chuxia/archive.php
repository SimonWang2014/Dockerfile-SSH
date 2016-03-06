<?php get_header(); ?>

<div id="content">
	<div class="wrapper">
		<div class="site">
			<?php chuxia_breadcrumbs(); ?>
		</div>
		<div class="main fl">
			<div class="list w750">
				<h3 class="h3">文章列表</h3>
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