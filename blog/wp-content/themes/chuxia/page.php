<?php get_header(); ?>

<div id="content">
	<div class="wrapper">
		<div class="site"><?php chuxia_breadcrumbs(); ?></div>
		<?php
			// Post title.
			the_title( '<h1 class="title">', '</h1>' );
			while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
			// End the loop.
			endwhile;
		?>
	</div>
</div>

<?php get_footer(); ?>