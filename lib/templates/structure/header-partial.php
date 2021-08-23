<?php
/**
 * Since WordPress force us to use the header.php name to open the document, we add a header-partial.php template for the actual header.
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
	beans_open_markup_e('beans_header','section',array(
		'class' => 'tm-header uk-section-default',
	));
		beans_open_markup_e('beans_fixed_wrap[_header]','header',array(
			'id' => 'masthead',
			'class' => 'uk-container',
			'role' => 'banner',
			'itemscope' => 'itemscope',
			'itemtype' => 'https://schema.org/WPHeader',
		));
			/**
			 * @reference (Beans)
			 * 	Fires in the header.
			 * 	https://www.getbeans.io/code-reference/hooks/beans_header/
			*/
			do_action('beans_header');

		beans_close_markup_e('beans_fixed_wrap[_header]','header');
	beans_close_markup_e('beans_header','section');
