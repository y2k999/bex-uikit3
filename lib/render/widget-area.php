<?php
/**
 * Registers the Beans default widget areas.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	beans_add_smart_action('widgets_init','beans_do_register_widget_areas',5);
	/**
	 * @access (public)
	 * 	Register Beans's default widget areas.
	 * 	https://www.getbeans.io/code-reference/functions/beans_do_register_widget_areas/
	 * @return (void)
	 * @reference (WP)
	 * 	Fires after all default WordPress widgets have been registered.
	 * 	https://developer.wordpress.org/reference/hooks/widgets_init/
	 * @reference
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Plugin]/beans_extension/utility/general.php
	*/
	function beans_do_register_widget_areas()
	{
		/**
		 * @since 1.0.1
		 * 	Keep primary sidebar first for default widget asignment.
		 * @reference (Beans)
		 * 	Register a widget area.
		 * 	https://www.getbeans.io/code-reference/functions/beans_register_widget_area/
		*/
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){

			register_sidebar(array(
				'name' => __('[WP] Sidebar Primary','bex-uikit3'),
				'id' => 'sidebar_primary',
			));
			register_sidebar(array(
				'name' => __('[WP] Sidebar Secondary','bex-uikit3'),
				'id' => 'sidebar_secondary',
			));
			if(current_theme_supports('offcanvas-menu')){
				register_sidebar(array(
					'name' => __('[WP] Off-Canvas Menu','bex-uikit3'),
					'id' => 'offcanvas_menu',
					// 'beans_type' => 'offcanvas',
				));
			}

		}else{
			beans_register_widget_area(array(
				'name' => __('[Beans] Sidebar Primary','bex-uikit3'),
				'id' => 'sidebar_primary',
			));
			beans_register_widget_area(array(
				'name' => __('[Beans] Sidebar Secondary','bex-uikit3'),
				'id' => 'sidebar_secondary',
			));

			/**
			 * @reference (WP)
			 * 	Checks a themefs support for a given feature.
			 * 	https://developer.wordpress.org/reference/functions/current_theme_supports/
			*/
			if(current_theme_supports('offcanvas-menu')){
				beans_register_widget_area(array(
					'name' => __('[Beans] Off-Canvas Menu','bex-uikit3'),
					'id' => 'offcanvas_menu',
					'beans_type' => 'offcanvas',
				));
			}
		}

	}// Method


	if(!Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){
		/**
		 * @since 1.0.1
		 * 	Call register sidebar.
		 * 	Because the WordPress.org checker doesn't understand that we are using register_sidebar properly,we have to add this useless call which only has to be declared once.
		 * @reference (WP)
		 * 	Fires after all default WordPress widgets have been registered.
		 * 	https://developer.wordpress.org/reference/hooks/widgets_init/
		 * @reference
		 * 	[Plugin]/beans_extension/api/widget/beans.php
		 * 	[Plugin]/beans_extension/utility/general.php
		*/
		add_action('widgets_init','beans_register_widget_area');
	}
