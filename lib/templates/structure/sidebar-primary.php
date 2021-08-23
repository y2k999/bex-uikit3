<?php
/**
 * Echo the primary sidebar structural markup. It also calls the primary sidebar action hooks.
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


	/**
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/
	beans_open_markup_e('beans_sidebar_primary','aside',array(
		/* Automatically escaped. */
		'class' => 'tm-secondary uk-padding-small ' . beans_get_layout_class('sidebar_primary'),
		'id' => 'beans-primary-sidebar',
		'role' => 'complementary',
		'itemscope' => 'itemscope',
		'itemtype' => 'https://schema.org/WPSideBar',
		'tabindex' => '-1',
	));
		/**
		 * @reference (Beans)
		 * 	Fires in the primary sidebar.
		 * 	https://www.getbeans.io/code-reference/hooks/beans_sidebar_primary/
		*/
		do_action('beans_sidebar_primary');

	beans_close_markup_e('beans_sidebar_primary','aside');
