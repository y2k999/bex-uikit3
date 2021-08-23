<?php
/**
 * Beans Framework.
 * This core file should only be overwritten via your child theme.
 * We strongly recommend to read the Beans documentation to find out more about how to customize the Beans theme.
 * @author Beans
 * @link https://www.getbeans.io
 * @package Beans Extension Uikit3
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/

/**
	[NOTE]
	This theme requires the Beans Extension plugin.
	It is recommended to configure the plugin in the "Uikit Version" section of the first tab ("Preview" panel).
	1. For the "Range of Uikit2 components to use" setting, select "Load only normalize.css" option.
	2. For the "Use Uikit3 via CDN" setting, check the checkbox.
*/


	/**
		@description
			Check if Beans Extension plugin is active.
		@reference
			https://www.wecodeart.com/
	*/
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');

	if(!is_plugin_active('beans-extension/beans-extension.php')){
		if(defined('WP_DEFAULT_THEME') !== FALSE){
			switch_theme(WP_DEFAULT_THEME);
		}
		else{
			switch_theme('default');
		}
	}
	else{
		/**
			@description
				Initialize Beans theme framework.
			@reference
				https://www.getbeans.io
		*/
		require_once dirname(__FILE__) . '/lib/init.php';
	}


	/**
		@description
			Fix https error on class-wp-image-editor-imagick.php.
			https://natural.arthhuman.com/upload-error/
	*/
	add_filter('wp_image_editors',function($array)
	{
		return array('WP_Image_Editor_GD','WP_Image_Editor_Imagick');
	});

