<?php 
/*
Template Name: Login Page
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
		
		<div id="et-login">
			<div class='et-protected'>
				<div class='et-protected-form'>
					<form action='<?php echo home_url(); ?>/wp-login.php' method='post'>
						<p><label><?php esc_html_e('Username','DailyNotes'); ?>: <input type='text' name='log' id='log' value='<?php echo esc_attr($user_login); ?>' size='20' /></label></p>
						<p><label><?php esc_html_e('Password','DailyNotes'); ?>: <input type='password' name='pwd' id='pwd' size='20' /></label></p>
						<input type='submit' name='submit' value='Login' class='etlogin-button' />
					</form> 
				</div> <!-- .et-protected-form -->
				<p class='et-registration'><?php esc_html_e('Not a member?','DailyNotes'); ?> <a href='<?php echo site_url('wp-login.php?action=register', 'login_post'); ?>'><?php esc_html_e('Register today!','DailyNotes'); ?></a></p>
			</div> <!-- .et-protected -->
		</div> <!-- end #et-login -->
		
		<div class="clear"></div>
		
		<span class="main_post_bottom"></span>
	</div> <!-- .main_post -->
<?php endwhile; endif; ?>
	
<div id="footer"><?php esc_html_e('designed by ','DailyNotes'); ?> <a href="http://www.elegantthemes.com">elegant themes</a></div>
	
<?php get_footer(); ?>