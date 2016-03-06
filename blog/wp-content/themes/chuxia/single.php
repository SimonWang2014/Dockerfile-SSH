<?php get_header(); ?>

<div id="content">
	<div class="wrapper">
		<div class="site">
			<?php chuxia_breadcrumbs(); ?>
		</div>
		<div class="main fl">
			<div class="list w750">
			<?php 
				// Post title.
				the_title( '<h1 class="title">', '</h1>' );
				// Start the loop.
				while ( have_posts() ) : the_post();
				get_template_part( 'content', 'single' );
				// End the loop.
				endwhile;
				// Related post list
				include 'inc/related.php';
				// Comments
				if ( comments_open() || get_comments_number() ) :
				comments_template(); 
				endif;
				?>	
			</div>			
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>