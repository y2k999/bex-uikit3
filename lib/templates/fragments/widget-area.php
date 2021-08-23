<?php
/**
 * Echo widget areas.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
 * 
 * Inspired by Beans Frontend Framework, using UiKit3 Plugin
 * @link https://bowriverstudio.com
 * @author Maurice Tadros, Yaidel Ferralize, Disnel Rodriguez
*/


	beans_add_smart_action('beans_sidebar_primary','beans_widget_area_sidebar_primary');
	/**
	 * @access (public)
	 * 	Echo primary sidebar widget area.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_area_sidebar_primary/
	 * @return (void)
	*/
	function beans_widget_area_sidebar_primary()
	{
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){
			dynamic_sidebar('sidebar_primary');
		}
		else{
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
			echo beans_get_widget_area_output('sidebar_primary');
		}

	}// Method


	beans_add_smart_action('beans_sidebar_secondary','beans_widget_area_sidebar_secondary');
	/**
	 * @access (public)
	 * 	Echo secondary sidebar widget area.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_area_sidebar_secondary/
	 * @return (void)
	*/
	function beans_widget_area_sidebar_secondary()
	{
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){
			dynamic_sidebar('sidebar_secondary');
		}
		else{
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
			echo beans_get_widget_area_output('sidebar_secondary');
		}

	}// Method


	beans_add_smart_action('beans_site_after_markup','beans_widget_area_offcanvas_menu');
	/**
	 * @access (public)
	 * 	Echo off-canvas widget area.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_area_offcanvas_menu/
	 * @return (void)
	*/
	function beans_widget_area_offcanvas_menu()
	{
		if(!current_theme_supports('offcanvas-menu')){return;}

		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){
			dynamic_sidebar('offcanvas_menu');
		}
		else{
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
			echo beans_get_widget_area_output('offcanvas_menu');
		}

	}// Method
