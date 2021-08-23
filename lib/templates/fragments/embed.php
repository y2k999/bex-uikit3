<?php
/**
 * Extends WordPress Embed.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	// Filter.
	beans_add_smart_action('embed_oembed_html','beans_embed_oembed');
	/**
	 * @access (public)
	 * 	Add markup to embed.
	 * 	https://www.getbeans.io/code-reference/functions/beans_embed_oembed/
	 * @param (string) $html
	 * 	The embed HTML.
	 * @return (string)
	 * 	The modified embed HTML.
	 */
	function beans_embed_oembed($html)
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_open_markup('beans_embed_oembed','div','class=tm-oembed');
			$output .= $html;
		$output .= beans_close_markup('beans_embed_oembed','div');

		return $output;

	}// Method
