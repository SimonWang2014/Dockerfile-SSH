<?php 
/*
Template Name: Search Page
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
		
		<div id="et-search">
			<div id="et-search-inner" class="clearfix">
				<p id="et-search-title"><span><?php esc_html_e('search this website','DailyNotes'); ?></span></p>
				<form action="<?php echo home_url(); ?>" method="get" id="et_search_form">
					<div id="et-search-left">
						<p id="et-search-word"><input type="text" id="et-searchinput" name="s" value="<?php esc_attr_e('search this site...','DailyNotes'); ?>" /></p>
														
						<p id="et_choose_posts"><label><input type="checkbox" id="et-inc-posts" name="et-inc-posts" /> <?php esc_html_e('Posts','DailyNotes'); ?></label></p>
						<p id="et_choose_pages"><label><input type="checkbox" id="et-inc-pages" name="et-inc-pages" /> <?php esc_html_e('Pages','DailyNotes'); ?></label></p>
						<p id="et_choose_date">
							<select id="et-month-choice" name="et-month-choice">
								<option value="no-choice"><?php esc_html_e('Select a month','DailyNotes'); ?></option>
								<?php 
									global $wpdb, $wp_locale;
									
									$selected = '';
									$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
									
									$arcresults = $wpdb->get_results($query);
																										
									foreach ( (array) $arcresults as $arcresult ) {
										if ( isset($_POST['et-month-choice']) && ( $_POST['et-month-choice'] == ($arcresult->year . $arcresult->month) ) ) {
											$selected = ' selected="selected"';
										}
										echo "<option value='{$arcresult->year}{$arcresult->month}'{$selected}>{$wp_locale->get_month($arcresult->month)}" . ", {$arcresult->year}</option>";
										if ( $selected <> '' ) $selected = '';
									}
								?>
							</select>
						</p>
					
						<p id="et_choose_cat"><?php wp_dropdown_categories('show_option_all=Choose a Category&show_count=1&hierarchical=1&id=et-cat&name=et-cat'); ?></p>
					</div> <!-- #et-search-left -->
					
					<div id="et-search-right">
						<input type="hidden" name="et_searchform_submit" value="et_search_proccess" />
						<input class="et_search_submit" type="submit" value="<?php esc_attr_e('Submit','DailyNotes'); ?>" id="et_search_submit" />
					</div> <!-- #et-search-right -->
				</form>
			</div> <!-- end #et-search-inner -->
		</div> <!-- end #et-search -->
		
		<div class="clear"></div>
		
		<span class="main_post_bottom"></span>
	</div> <!-- .main_post -->
<?php endwhile; endif; ?>
	
<div id="footer"><?php esc_html_e('designed by ','DailyNotes'); ?> <a href="http://www.elegantthemes.com">elegant themes</a></div>
	
<?php get_footer(); ?>