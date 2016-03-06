<?php 
/*
Template Name: Sitemap Page
*/
?>
<?php 
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta($post->ID,'et_ptemplate_settings',true) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="main_post">
		<span class="main_post_top"></span>
		<?php if (get_option('dailynotes_integration_single_top') <> '' && get_option('dailynotes_integrate_singletop_enable') == 'on') echo(get_option('dailynotes_integration_single_top')); ?>
		
		<h1><?php the_title(); ?></h1>
		<img src="<?php bloginfo('template_directory'); ?>/images/line.gif" alt="line" class="line" />
		<?php the_content(); ?>
		
		<div id="sitemap">
			<div class="sitemap-col">
				<h2><?php esc_html_e('Pages','DailyNotes'); ?></h2>
				<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
			</div> <!-- end .sitemap-col -->
			
			<div class="sitemap-col">
				<h2><?php esc_html_e('Categories','DailyNotes'); ?></h2>
				<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
			</div> <!-- end .sitemap-col -->
			
			<div class="sitemap-col">
				<h2><?php esc_html_e('Tags','DailyNotes'); ?></h2>
				<ul id="sitemap-tags">
					<?php $tags = get_tags();
					if ($tags) {
						foreach ($tags as $tag) {
							echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li> ';
						}
					} ?>
				</ul>
			</div> <!-- end .sitemap-col -->
					
			<div class="sitemap-col<?php echo ' last'; ?>">
				<h2><?php esc_html_e('Authors','DailyNotes'); ?></h2>
				<ul id="sitemap-authors" ><?php wp_list_authors('show_fullname=1&optioncount=1&exclude_admin=0'); ?></ul>
			</div> <!-- end .sitemap-col -->
		</div> <!-- end #sitemap -->
		
		<div class="clear"></div>
		
		<span class="main_post_bottom"></span>
	</div> <!-- .main_post -->
<?php endwhile; endif; ?>

<div id="footer"><?php esc_html_e('designed by ','DailyNotes'); ?> <a href="http://www.elegantthemes.com">elegant themes</a></div>
	
<?php get_footer(); ?>