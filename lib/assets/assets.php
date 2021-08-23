<?php
/**
 * Add Beans assets.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	beans_add_smart_action('beans_extension_uikit_enqueue_script','beans_enqueue_uikit_components',5);
	/**
	 * @since 1.0.1
	 * 	Enqueue UIkit components and Beans style.
	 * 	Beans style is enqueued with the UIKit components to have access to UIKit LESS variables.
	 * 	https://www.getbeans.io/code-reference/functions/beans_enqueue_uikit_components/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/init.php
	*/
	function beans_enqueue_uikit_components()
	{
		/**
		 * @since 1.0.1
		 * 	Add the theme default style as a UIkit fragment only if the theme supports it.
		 * @reference (WP)
		 * 	Checks a themefs support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/current_theme_supports/
		*/
		if(current_theme_supports('beans-default-styling')){
			/**
			 * @reference (Beans)
			 * 	Add CSS, LESS or JS fragments to a compiler.
			 * 	https://www.getbeans.io/code-reference/functions/beans_compiler_add_fragment/
			*/
			beans_compiler_add_fragment('uikit',BEANS_ASSETS_PATH . 'less/style.less','less');
		}

	}// Method


	beans_add_smart_action('wp_enqueue_scripts','beans_enqueue_assets',5);
	/**
	 * @since 1.0.1
	 * 	Enqueue Beans assets.
	 * 	https://www.getbeans.io/code-reference/functions/beans_enqueue_assets/
	 * @return (void)
	*/
	function beans_enqueue_assets()
	{
		/**
		 * @reference (WP)
		 * 	Determines whether the query is for an existing single post of any post type (post, attachment, page, custom post types).
		 * 	https://developer.wordpress.org/reference/functions/is_singular/
		 * 	Determines whether the current post is open for comments.
		 * 	https://developer.wordpress.org/reference/functions/comments_open/
		*/
		if(is_singular() && comments_open() && get_option('thread_comments')){
			wp_enqueue_script('comment-reply');
		}

	}// Method


	beans_add_smart_action('after_setup_theme','beans_add_editor_assets');
	/**
	 * @since 1.2.5
	 * 	Add Beans editor assets.
	 * 	https://www.getbeans.io/code-reference/functions/beans_add_editor_assets/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/include/constant.php
	 * 	[Theme]/lib/init.php
	*/
	function beans_add_editor_assets()
	{
		/**
		 * @reference (WP)
		 * 	Adds callback for custom TinyMCE editor stylesheets.
		 * 	https://developer.wordpress.org/reference/functions/add_editor_style/
		*/
		add_editor_style(BEANS_ASSETS_URL . 'css/editor' . BEANS_EXTENSION_MIN_CSS . '.css');

	}// Method
