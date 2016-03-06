<?php get_header(); ?>

<div id="content">
	<div class="wrapper">
		<div class="site">
			<?php chuxia_breadcrumbs(); ?>
		</div>
		<div class="main fl">
			<div class="list w750">
				<h3 class="h3">搜索结果</h3>
				<div class="post-list fl mt15">
				<?php 
				if ( have_posts() ) : 
				   get_template_part( 'content'); 
				   else : _e('<div>对不起，没找到你搜索内容。</div>');
				   endif;
				   ?>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>