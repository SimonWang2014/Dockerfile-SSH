<?php 
add_action( 'admin_enqueue_scripts', 'import_epanel_javascript' );
function import_epanel_javascript( $hook_suffix ) {
	if ( 'admin.php' == $hook_suffix && isset( $_GET['import'] ) && isset( $_GET['step'] ) && 'wordpress' == $_GET['import'] && '1' == $_GET['step'] )
		add_action( 'admin_head', 'admin_headhook' );
}

function admin_headhook(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("p.submit").before("<p><input type='checkbox' id='importepanel' name='importepanel' value='1' style='margin-right: 5px;'><label for='importepanel'>Replace ePanel settings with sample data values</label></p>");
		});
	</script>
<?php }

add_action('import_end','importend');
function importend(){
	global $wpdb, $shortname;
	
	#make custom fields image paths point to sampledata/sample_images folder
	$sample_images_postmeta = $wpdb->get_results("SELECT meta_id, meta_value FROM $wpdb->postmeta WHERE meta_value REGEXP 'http://et_sample_images.com'");
	if ( $sample_images_postmeta ) {
		foreach ( $sample_images_postmeta as $postmeta ){
			$template_dir = get_template_directory_uri();
			if ( is_multisite() ){
				switch_to_blog(1);
				$main_siteurl = site_url();
				restore_current_blog();
				
				$template_dir = $main_siteurl . '/wp-content/themes/' . get_template();
			}
			preg_match( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $postmeta->meta_value, $matches );
			$image_path = $matches[1];
			
			$local_image = preg_replace( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $template_dir . '/sampledata/sample_images/$1.jpg', $postmeta->meta_value );
			
			$local_image = preg_replace( '/s:55:/', 's:' . strlen( $template_dir . '/sampledata/sample_images/' . $image_path . '.jpg' ) . ':', $local_image );
			
			$wpdb->update( $wpdb->postmeta, array( 'meta_value' => $local_image ), array( 'meta_id' => $postmeta->meta_id ), array( '%s' ) );
		}
	}

	if ( !isset($_POST['importepanel']) )
		return;
	
	$importOptions = 'YTo3Njp7czowOiIiO047czoxNToiZGFpbHlub3Rlc19sb2dvIjtzOjA6IiI7czoxODoiZGFpbHlub3Rlc19mYXZpY29uIjtzOjA6IiI7czoyMzoiZGFpbHlub3Rlc19jb2xvcl9zY2hlbWUiO3M6NzoiRGVmYXVsdCI7czoyMToiZGFpbHlub3Rlc19ncmFiX2ltYWdlIjtOO3M6MzA6ImRhaWx5bm90ZXNfYXJjaGl2ZV9jdXN0b21wb3N0cyI7czoxOiI1IjtzOjI3OiJkYWlseW5vdGVzX2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyMzoiZGFpbHlub3Rlc19jYXRudW1fcG9zdHMiO3M6MToiNiI7czoyNjoiZGFpbHlub3Rlc19zZWFyY2hudW1fcG9zdHMiO3M6MToiNSI7czoyMzoiZGFpbHlub3Rlc190YWdudW1fcG9zdHMiO3M6MToiNSI7czoyMjoiZGFpbHlub3Rlc19kYXRlX2Zvcm1hdCI7czo2OiJNIGosIFkiO3M6MjI6ImRhaWx5bm90ZXNfdXNlX2V4Y2VycHQiO047czoyNToiZGFpbHlub3Rlc19ob21lcGFnZV9wb3N0cyI7czoxOiI4IjtzOjIwOiJkYWlseW5vdGVzX21lbnVwYWdlcyI7TjtzOjI3OiJkYWlseW5vdGVzX2VuYWJsZV9kcm9wZG93bnMiO3M6Mjoib24iO3M6MjA6ImRhaWx5bm90ZXNfaG9tZV9saW5rIjtzOjI6Im9uIjtzOjIxOiJkYWlseW5vdGVzX3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MjE6ImRhaWx5bm90ZXNfb3JkZXJfcGFnZSI7czozOiJhc2MiO3M6Mjg6ImRhaWx5bm90ZXNfdGllcnNfc2hvd25fcGFnZXMiO3M6MToiMyI7czoxOToiZGFpbHlub3Rlc19tZW51Y2F0cyI7TjtzOjM4OiJkYWlseW5vdGVzX2VuYWJsZV9kcm9wZG93bnNfY2F0ZWdvcmllcyI7czoyOiJvbiI7czoyNzoiZGFpbHlub3Rlc19jYXRlZ29yaWVzX2VtcHR5IjtzOjI6Im9uIjtzOjMzOiJkYWlseW5vdGVzX3RpZXJzX3Nob3duX2NhdGVnb3JpZXMiO3M6MToiMyI7czoxOToiZGFpbHlub3Rlc19zb3J0X2NhdCI7czo0OiJuYW1lIjtzOjIwOiJkYWlseW5vdGVzX29yZGVyX2NhdCI7czozOiJhc2MiO3M6MjY6ImRhaWx5bm90ZXNfZGlzYWJsZV90b3B0aWVyIjtOO3M6MTk6ImRhaWx5bm90ZXNfcG9zdGluZm8iO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjIxOiJkYWlseW5vdGVzX3RodW1ibmFpbHMiO3M6Mjoib24iO3M6Mjg6ImRhaWx5bm90ZXNfc2hvd19wb3N0Y29tbWVudHMiO3M6Mjoib24iO3M6MjY6ImRhaWx5bm90ZXNfcGFnZV90aHVtYm5haWxzIjtOO3M6Mjk6ImRhaWx5bm90ZXNfc2hvd19wYWdlc2NvbW1lbnRzIjtOO3M6MjQ6ImRhaWx5bm90ZXNfY3VzdG9tX2NvbG9ycyI7TjtzOjIwOiJkYWlseW5vdGVzX2NoaWxkX2NzcyI7TjtzOjIzOiJkYWlseW5vdGVzX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MjU6ImRhaWx5bm90ZXNfY29sb3JfbWFpbmZvbnQiO3M6MDoiIjtzOjI1OiJkYWlseW5vdGVzX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyNToiZGFpbHlub3Rlc19jb2xvcl9wYWdlbGluayI7czowOiIiO3M6MjU6ImRhaWx5bm90ZXNfY29sb3JfaGVhZGluZ3MiO3M6MDoiIjtzOjIyOiJkYWlseW5vdGVzX2NvbG9yX3F1b3RlIjtzOjA6IiI7czoyNToiZGFpbHlub3Rlc19jb2xvcl9wb3N0aW5mbyI7czowOiIiO3M6MjU6ImRhaWx5bm90ZXNfY29sb3JfcmVhZG1vcmUiO3M6MDoiIjtzOjIyOiJkYWlseW5vdGVzX2Zvb3Rlcl90ZXh0IjtzOjA6IiI7czoyODoiZGFpbHlub3Rlc19jb2xvcl9mb290ZXJsaW5rcyI7czowOiIiO3M6MjU6ImRhaWx5bm90ZXNfc2VvX2hvbWVfdGl0bGUiO047czozMToiZGFpbHlub3Rlc19zZW9faG9tZV9kZXNjcmlwdGlvbiI7TjtzOjI4OiJkYWlseW5vdGVzX3Nlb19ob21lX2tleXdvcmRzIjtOO3M6Mjk6ImRhaWx5bm90ZXNfc2VvX2hvbWVfY2Fub25pY2FsIjtOO3M6Mjk6ImRhaWx5bm90ZXNfc2VvX2hvbWVfdGl0bGV0ZXh0IjtzOjA6IiI7czozNToiZGFpbHlub3Rlc19zZW9faG9tZV9kZXNjcmlwdGlvbnRleHQiO3M6MDoiIjtzOjMyOiJkYWlseW5vdGVzX3Nlb19ob21lX2tleXdvcmRzdGV4dCI7czowOiIiO3M6MjQ6ImRhaWx5bm90ZXNfc2VvX2hvbWVfdHlwZSI7czoyNzoiQmxvZ05hbWUgfCBCbG9nIGRlc2NyaXB0aW9uIjtzOjI4OiJkYWlseW5vdGVzX3Nlb19ob21lX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyNzoiZGFpbHlub3Rlc19zZW9fc2luZ2xlX3RpdGxlIjtOO3M6MzM6ImRhaWx5bm90ZXNfc2VvX3NpbmdsZV9kZXNjcmlwdGlvbiI7TjtzOjMwOiJkYWlseW5vdGVzX3Nlb19zaW5nbGVfa2V5d29yZHMiO047czozMToiZGFpbHlub3Rlc19zZW9fc2luZ2xlX2Nhbm9uaWNhbCI7TjtzOjMzOiJkYWlseW5vdGVzX3Nlb19zaW5nbGVfZmllbGRfdGl0bGUiO3M6OToic2VvX3RpdGxlIjtzOjM5OiJkYWlseW5vdGVzX3Nlb19zaW5nbGVfZmllbGRfZGVzY3JpcHRpb24iO3M6MTU6InNlb19kZXNjcmlwdGlvbiI7czozNjoiZGFpbHlub3Rlc19zZW9fc2luZ2xlX2ZpZWxkX2tleXdvcmRzIjtzOjEyOiJzZW9fa2V5d29yZHMiO3M6MjY6ImRhaWx5bm90ZXNfc2VvX3NpbmdsZV90eXBlIjtzOjIxOiJQb3N0IHRpdGxlIHwgQmxvZ05hbWUiO3M6MzA6ImRhaWx5bm90ZXNfc2VvX3NpbmdsZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzA6ImRhaWx5bm90ZXNfc2VvX2luZGV4X2Nhbm9uaWNhbCI7TjtzOjMyOiJkYWlseW5vdGVzX3Nlb19pbmRleF9kZXNjcmlwdGlvbiI7TjtzOjI1OiJkYWlseW5vdGVzX3Nlb19pbmRleF90eXBlIjtzOjI0OiJDYXRlZ29yeSBuYW1lIHwgQmxvZ05hbWUiO3M6Mjk6ImRhaWx5bm90ZXNfc2VvX2luZGV4X3NlcGFyYXRlIjtzOjM6IiB8ICI7czozNDoiZGFpbHlub3Rlc19pbnRlZ3JhdGVfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czozMjoiZGFpbHlub3Rlc19pbnRlZ3JhdGVfYm9keV9lbmFibGUiO3M6Mjoib24iO3M6Mzc6ImRhaWx5bm90ZXNfaW50ZWdyYXRlX3NpbmdsZXRvcF9lbmFibGUiO3M6Mjoib24iO3M6NDA6ImRhaWx5bm90ZXNfaW50ZWdyYXRlX3NpbmdsZWJvdHRvbV9lbmFibGUiO3M6Mjoib24iO3M6Mjc6ImRhaWx5bm90ZXNfaW50ZWdyYXRpb25faGVhZCI7czowOiIiO3M6Mjc6ImRhaWx5bm90ZXNfaW50ZWdyYXRpb25fYm9keSI7czowOiIiO3M6MzM6ImRhaWx5bm90ZXNfaW50ZWdyYXRpb25fc2luZ2xlX3RvcCI7czowOiIiO3M6MzY6ImRhaWx5bm90ZXNfaW50ZWdyYXRpb25fc2luZ2xlX2JvdHRvbSI7czowOiIiO3M6MjE6ImRhaWx5bm90ZXNfNDY4X2VuYWJsZSI7TjtzOjIwOiJkYWlseW5vdGVzXzQ2OF9pbWFnZSI7czowOiIiO3M6MTg6ImRhaWx5bm90ZXNfNDY4X3VybCI7czowOiIiO30=';
	
	/*global $options;
	
	foreach ($options as $value) {
		if( isset( $value['id'] ) ) { 
			update_option( $value['id'], $value['std'] );
		}
	}*/
	
	$importedOptions = unserialize(base64_decode($importOptions));
	
	foreach ($importedOptions as $key=>$value) {
		if ($value != '') update_option( $key, $value );
	}
} ?>