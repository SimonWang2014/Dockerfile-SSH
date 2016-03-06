<?php
/**
 * @package All-in-One-SEO-Pack
 */
/**
 * The Feature Manager class.
 */
if ( !class_exists( 'All_in_One_SEO_Pack_Feature_Manager' ) ) {
	class All_in_One_SEO_Pack_Feature_Manager extends All_in_One_SEO_Pack_Module {

		protected $module_info = Array( );

		function __construct( $mod ) {
			$this->name = __('Feature Manager', 'all-in-one-seo-pack');		// Human-readable name of the plugin
			$this->prefix = 'aiosp_feature_manager_';						// option prefix
			$this->file = __FILE__;									// the current file
			parent::__construct();
			$this->module_info = Array( 
				'sitemap'		=> Array( 'name'		=> __( 'XML Sitemaps', 'all-in-one-seo-pack' ),
										'description'	=> __( 'Create and manage your XML Sitemaps using this feature and submit your XML Sitemap to Google, Bing/Yahoo and Ask.com.', 'all-in-one-seo-pack' ) ),
				'opengraph'		=> Array( 'name'		=> __( 'Social Meta', 'all-in-one-seo-pack' ),
									    'description'	=> __( 'Activate this feature to add Social Meta data to your site to deliver closer integration between your website/blog and Facebook, Twitter, and Google+.', 'all-in-one-seo-pack' ) ),
				'robots'	=> Array( 'name' => __( 'Robots.txt', 'all-in-one-seo-pack' ),
									  'description' => __( 'Generate and validate your robots.txt file to guide search engines through your site.', 'all-in-one-seo-pack' ) ),
				'file_editor' => Array( 'name' => __( 'File Editor', 'all-in-one-seo-pack' ),
									  'description' => __( 'Edit your robots.txt file and your .htaccess file to fine-tune your site.', 'all-in-one-seo-pack' ) ),
				'bad_robots'=> Array( 'name' => __( 'Bad Bot Blocker', 'all-in-one-seo-pack' ),
									  'description' => __( 'Stop badly behaving bots from slowing down your website.', 'all-in-one-seo-pack' ) ),
				'performance' => Array( 'name'			=> __( 'Performance', 'all-in-one-seo-pack' ),
										'description'	=> __( 'Optimize performance related to SEO and check your system status.', 'all-in-one-seo-pack' ),
										'default'	=> 'on' ),
				'importer_exporter'	=> Array( 'name' => __( 'Importer & Exporter', 'all-in-one-seo-pack' ),
									  'description' => __( 'Exports and imports your All in One SEO Pack plugin settings.', 'all-in-one-seo-pack' ) ),
				'coming_soon' => Array( 'name'			=> __( 'Coming Soon...', 'all-in-one-seo-pack' ),
					 					'description'	=> __( 'Video Sitemap', 'all-in-one-seo-pack' ),
										'save'		=> false ) );

			// Set up default settings fields
			// name			- Human-readable name of the setting
			// help_text	- Inline documentation for the setting
			// type			- Type of field; this defaults to checkbox; currently supported types are checkbox, text, select, multiselect
			// default		- Default value of the field
			// initial_options - Initial option list used for selects and multiselects
			// Other supported options: class, id, style -- allows you to set these HTML attributes on the field

			$this->default_options = array();
			$this->module_info = apply_filters( 'aioseop_module_info', $this->module_info );
			$mod[] = 'coming_soon';
			
			foreach ( $mod  as $m ) {
				if ( $m == 'performance' && !is_super_admin() ) continue;
				$module_name = ucwords( strtr( $m, '_', ' ' ) );
				$this->default_options["enable_$m"] = Array( 'name'		 => $this->module_info[$m]['name'],
				 											 'help_text' => $this->module_info[$m]['description'],
				 											 'type'		 => 'custom',
															 'class'	 => 'aioseop_feature',
															 'id'		 => "aioseop_$m",
															 'save'		 => true );
				
				if ( !empty( $this->module_info[$m]['image'] ) )
					$this->default_options["enable_$m"]['image'] = $this->module_info[$m]['image'];
				if ( !empty( $this->module_info[$m] ) )
					foreach( Array( 'save', 'default' ) as $option )
						if ( isset( $this->module_info[$m][$option] ) )
							$this->default_options["enable_$m"][$option] = $this->module_info[$m][$option];
			}
			$this->layout = Array(
				'default' => Array(
						'name' => $this->name,
						'help_link' => 'http://semperplugins.com/documentation/feature-manager/',
						'options' => array_keys( $this->default_options )
					)
			);
			// load initial options / set defaults
			$this->update_options( );
			if ( is_admin() ) {
				add_filter( $this->prefix . 'output_option', Array( $this, 'display_option_div' ), 10, 2 );
				add_filter( $this->prefix . 'submit_options', Array( $this, 'filter_submit' ) );				
			}
		}
		
		function menu_order() {
			return 20;
		}
		
		function filter_submit( $submit, $location = null ) {
			$submit['Submit']['value'] = __( 'Update Features', 'all-in-one-seo-pack' )  . ' &raquo;';
			$submit['Submit']['class'] .= " hidden";
			$submit['Submit_Default']['value'] = __( 'Reset Features', 'all-in-one-seo-pack' ) . ' &raquo;';
			return $submit;
		}
		
		function display_option_div( $buf, $args ) {
			$name = $img = $desc = $checkbox = $class = '';
			if ( isset( $args['options']['help_text'] ) && !empty( $args['options']['help_text'] ) )
				$desc .= '<p class="aioseop_desc">' . $args['options']['help_text'] . '</p>';
			if ($args['value']) $class = ' active';
			if ( isset( $args['options']['image'] ) && !empty( $args['options']['image'] ) )
				$img .= '<p><img src="' . AIOSEOP_PLUGIN_IMAGES_URL . $args['options']['image'] . '"></p>';
			else
				$img .= '<p><span class="aioseop_featured_image' . $class . '"></span></p>';
			
			if ( $args['options']['save'] ) {
				$name = "<h3>{$args['options']['name']}</h3>";
				$checkbox .= '<input type="checkbox" onchange="jQuery(\'#' . $args["options"]["id"] . ' .aioseop_featured_image, #' . $args["options"]["id"] . ' .feature_button\').toggleClass(\'active\', this.checked);jQuery(\'input[name=Submit]\').trigger(\'click\');" style="display:none;" id="' . $args['name'] . '" name="' . $args['name'] . '"';
				if ($args['value']) $checkbox .= " CHECKED";
				$checkbox .= '><span class="button-primary feature_button' . $class . '"></span>';
			} else {
				$name = "<b>{$args['options']['name']}</b>";
			}
			if ( !empty( $args['options']['id'] ) ) $args['attr'] .= " id='{$args['options']['id']}'";
			return $buf . "<div {$args['attr']}><label for='{$args['name']}'>{$name}{$img}{$desc}{$checkbox}</label></div>";
		}
	}
}
