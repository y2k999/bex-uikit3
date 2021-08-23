<?php
/**
 * Despite its name, this template echos between the closing primary markup and the closing HTML markup.
 * This template must be called using get_footer().
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
		 * 	Echo close markup registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/

					beans_close_markup_e('beans_main_grid','div');
				beans_close_markup_e('beans_fixed_wrap[_main]','div');
			beans_close_markup_e('beans_main','section');

		beans_close_markup_e('beans_site','div');

		/**
		 * @reference (WP)
		 * 	Fire the wp_footer action.
		 * 	https://developer.wordpress.org/reference/functions/wp_footer/
		*/
		wp_footer();

	beans_close_markup_e('beans_body','body');
beans_close_markup_e('beans_html','html');
