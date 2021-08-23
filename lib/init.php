<?php
/**
 * Prepare and initialize theme.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/


/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	/**
	 * @since 1.0.1
	 * 	Define constants.
	 * @return (void)
	*/
	add_action('beans_init','beans_define_constants',-1);
	function beans_define_constants()
	{
		// Define version.
		if(!defined('BEANS_VERSION')){
			define('BEANS_VERSION','1.5.1');
		}

		// Define paths.
		if(!defined('BEANS_THEME_PATH')){
			/**
				@reference (WP)
					Normalize a filesystem path.
					https://developer.wordpress.org/reference/functions/wp_normalize_path/
					Retrieves template directory path for current theme.
					https://developer.wordpress.org/reference/functions/get_template_directory/
			*/
			define('BEANS_THEME_PATH',wp_normalize_path(trailingslashit(get_template_directory())));
		}

		if(!defined('BEANS_PATH')){
			define('BEANS_PATH',BEANS_THEME_PATH . 'lib/');
		}

		if(!defined('BEANS_ASSETS_PATH')){
			define('BEANS_ASSETS_PATH',BEANS_PATH . 'assets/');
		}

		if(!defined('BEANS_LANGUAGES_PATH')){
			define('BEANS_LANGUAGES_PATH',BEANS_PATH . 'languages/');
		}

		if(!defined('BEANS_RENDER_PATH')){
			define('BEANS_RENDER_PATH',BEANS_PATH . 'render/');
		}

		if(!defined('BEANS_TEMPLATES_PATH')){
			define('BEANS_TEMPLATES_PATH',BEANS_PATH . 'templates/');
		}

		if(!defined('BEANS_STRUCTURE_PATH')){
			define('BEANS_STRUCTURE_PATH',BEANS_TEMPLATES_PATH . 'structure/');
		}

		if(!defined('BEANS_FRAGMENTS_PATH')){
			define('BEANS_FRAGMENTS_PATH',BEANS_TEMPLATES_PATH . 'fragments/');
		}

		// Define urls.
		if(!defined('BEANS_THEME_URL')){
			/**
			 * @reference (WP)
			 * 	Retrieves template directory URI for current theme.
			 * 	https://developer.wordpress.org/reference/functions/get_template_directory_uri/
			*/
			define('BEANS_THEME_URL',trailingslashit(get_template_directory_uri()));
		}

		if(!defined('BEANS_URL')){
			define('BEANS_URL', BEANS_THEME_URL . 'lib/');
		}

		if(!defined('BEANS_ASSETS_URL')){
			define('BEANS_ASSETS_URL', BEANS_THEME_URL . 'assets/');
		}

		if(!defined('BEANS_LESS_URL')){
			define('BEANS_LESS_URL', BEANS_ASSETS_URL . 'less/');
		}

		if(!defined('BEANS_JS_URL')){
			define('BEANS_JS_URL', BEANS_ASSETS_URL . 'js/');
		}

		if(!defined('BEANS_IMAGE_URL')){
			define('BEANS_IMAGE_URL', BEANS_ASSETS_URL . 'images/');
		}

	}// Method


	/**
	 * @since 1.0.1
	 * 	Add theme support.
	 * @return (void)
	*/
	add_action('beans_init','beans_add_theme_support');
	function beans_add_theme_support()
	{
		/**
		 * @reference (WP)
		 * 	Registers theme support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/add_theme_support/
		*/
		add_theme_support('title-tag');
		add_theme_support('custom-background');
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5',array('comment-list','comment-form','search-form','gallery','caption'));
		add_theme_support('custom-header',array(
			'width' => 2000,
			'height' => 500,
			'flex-height' => TRUE,
			'flex-width' => TRUE,
			'header-text' => FALSE,
		));

		// Beans specific.
		add_theme_support('offcanvas-menu');
		add_theme_support('beans-default-styling');

	}// Method


	/**
	 * @since 1.0.1
	 * 	Include framework files.
	 * @return (void)
	*/
	add_action('beans_init','beans_includes');
	function beans_includes()
	{
		// Include assets.
		require_once BEANS_ASSETS_PATH . 'assets.php';

		// Include renderers.
		require_once BEANS_RENDER_PATH . 'template-parts.php';
		require_once BEANS_RENDER_PATH . 'fragments.php';
		require_once BEANS_RENDER_PATH . 'widget-area.php';
		require_once BEANS_RENDER_PATH . 'walker.php';
		require_once BEANS_RENDER_PATH . 'menu.php';

	}// Method


	/**
	 * @since 1.0.1
	 * 	Load the themeÅfs translated strings.
	 * 	https://developer.wordpress.org/reference/functions/load_theme_textdomain/
	 * @return (void)
	*/
	add_action('beans_init','beans_load_textdomain');
	function beans_load_textdomain()
	{
		load_theme_textdomain('bex-uikit3',BEANS_LANGUAGES_PATH);

	}// Method


	/**
	 * @since 1.0.1
	 * 	Fires before Beans loads.
	 * 	https://www.getbeans.io/code-reference/hooks/beans_before_init/
	*/
	do_action('beans_before_init');

	/**
	 * @since 1.0.1
	 * 	Load Beans framework.
	 * 	https://www.getbeans.io/code-reference/hooks/beans_init/
	*/
	do_action('beans_init');

	/**
	 * @since 1.0.1
	 * 	Fires after Beans loads.
	 * 	https://www.getbeans.io/code-reference/hooks/beans_after_init/
	*/
	do_action('beans_after_init');
