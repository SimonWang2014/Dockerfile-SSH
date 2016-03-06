<?php
add_action('admin_menu', 'mytheme_page');
function mytheme_page (){
	if ( count($_POST) > 0 && isset($_POST['mytheme_settings']) ){
		//custom options
		$options = array ('keywords','description','skincolor','qq','weichat','weiboshow','owner','analysis');
		//foreach options
		foreach ( $options as $opt ){
			delete_option ( 'mytheme_'.$opt, $_POST[$opt] ); //delete
			add_option ( 'mytheme_'.$opt, $_POST[$opt] );	//add
		}//end foreach
	}
	add_theme_page(__('主题选项'), __('主题选项'), 'edit_themes', basename(__FILE__), 'mytheme_settings');
}
function mytheme_settings(){
	include_once(TEMPLATEPATH.'/includes/admin/panel.php');
}
?>