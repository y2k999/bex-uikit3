<?php
/**
 * Modify the search from.
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


	// Filter.
	beans_add_smart_action('get_search_form','beans_search_form');
	/**
	 * @access (public)
	 * 	Modify the search form.
	 * 	https://www.getbeans.io/code-reference/functions/beans_search_form/
	 * @return (string)
	 * 	The form.
	 * @reference (WP)
	 * 	Filters the HTML output of the search form.
	 * 	https://developer.wordpress.org/reference/hooks/get_search_form/
	*/
	function beans_search_form()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		 * @reference (WP)
		 * 	Retrieves the contents of the search WordPress query variable.
		 * 	https://developer.wordpress.org/reference/functions/get_search_query/
		*/
		$output = beans_open_markup('beans_search_form_wrapper','div',array('class' => 'uk-margin'));
			$output .= beans_open_markup('beans_search_form','form',array(
				'class' => 'uk-search uk-search-default',
				'method' => 'get',
				'action' => esc_url(home_url('/')),
				'role' => 'search',
			));
				$output .= beans_open_markup('beans_search_form_input_icon','span',	array(
					'class' => 'uk-search-icon-flip uk-search-icon',
					'aria-hidden' => 'true',
					'uk-icon' => 'icon: search'
				));
				$output .= beans_close_markup('beans_search_form_input_icon','span');

				$output .= beans_selfclose_markup('beans_search_form_input','input',array(
					'class' => 'uk-search-input uk-width-1-1',
					'type' => 'search',
					/* Automatically escaped. */
					'placeholder' => __('Search...','bex-uikit3'),
					'value' => esc_attr(get_search_query()),
					'name' => 's',
				));
			$output .= beans_close_markup('beans_search_form','form');
		$output .= beans_close_markup('beans_search_form_wrapper','div');

		return $output;

	}// Method
