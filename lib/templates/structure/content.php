<?php
/**
 * Echo the structural markup for the main content. It also calls the content action hooks.
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


	/* phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Variable called in a function scope. */
	$content_attributes = array(
		'id' => 'beans-primary',
		'class' => 'tm-primary ' . beans_get_layout_class('content'),
		'role' => 'main',
		'itemprop' => 'mainEntityOfPage',
		'tabindex' => '-1',
	);

	/**
	 * @since 1.0.1
	 * 	Blog specific attributes.
	 * @reference (WP)
	 * 	Determines whether the query is for the blog homepage.
	 * 	https://developer.wordpress.org/reference/functions/is_home/
	 * 	Determines whether currently in a page template.
	 * 	https://developer.wordpress.org/reference/functions/is_page_template/
	 * 	Determines whether the query is for an existing single post of any post type (post, attachment, page, custom post types).
	 * 	https://developer.wordpress.org/reference/functions/is_singular/
	 * 	Determines whether the query is for an existing archive page.
	 * 	https://developer.wordpress.org/reference/functions/is_archive/
	*/
	if(is_home() || is_page_template('page_blog.php') || is_singular('post') || is_archive()){
		/* Automatically escaped. */
		$content_attributes['itemscope'] = 'itemscope';
		/* Automatically escaped. */
		$content_attributes['itemtype'] = 'https://schema.org/Blog';
	}

	/**
	 * @since 1.0.1
	 * 	Blog specific attributes.
	 * @reference (WP)
	 * 	Determines whether the query is for a search.
	 * 	https://developer.wordpress.org/reference/functions/is_search/
	*/
	if(is_search()){
		/* Automatically escaped. */
		$content_attributes['itemscope'] = 'itemscope';
		/* Automatically escaped. */
		$content_attributes['itemtype'] = 'https://schema.org/SearchResultsPage';
	}

	/* phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound */

	beans_open_markup_e('beans_primary','main',$content_attributes);
		/**
		 * @reference (Beans)
		 * 	Fires in the main content.
		 * 	https://www.getbeans.io/code-reference/hooks/beans_content/
		*/
		do_action('beans_content');

	beans_close_markup_e('beans_primary','main');
