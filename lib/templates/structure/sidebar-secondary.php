<?php
/**
 * Echo the secondary sidebar structural markup. It also calls the secondary sidebar action hooks.
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
	beans_open_markup_e('beans_sidebar_secondary','aside',array(
		/* Automatically escaped. */
		'class' => 'tm-tertiary uk-padding-small ' . beans_get_layout_class('sidebar_secondary'),
		'id' => 'beans-secondary-sidebar',
		'role' => 'complementary',
		'itemscope' => 'itemscope',
		'itemtype' => 'https://schema.org/WPSideBar',
		'tabindex' => '-1',
	));
		/**
		 * @reference (Beans)
		 * 	Fires in the secondary sidebar.
		 * 	https://www.getbeans.io/code-reference/hooks/beans_sidebar_secondary/
		*/
		do_action('beans_sidebar_secondary');

	beans_close_markup_e('beans_sidebar_secondary','aside');
