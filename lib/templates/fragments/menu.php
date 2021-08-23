<?php
/**
 * Echo menu fragments.
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


	beans_add_smart_action('beans_header','beans_primary_menu',15);
	/**
	 * @access (public)
	 * 	Echo primary menu.
	 * 	https://www.getbeans.io/code-reference/functions/beans_primary_menu/
	 * @since 1.5.0
	 * 	Added ID and tabindex for skip links.
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header-partial.php
	*/
	function beans_primary_menu()
	{
		/**
		 * @reference (WP)
		 * 	Checks a themefs support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/current_theme_supports/
		*/
		$nav_visibility = current_theme_supports('offcanvas-menu') ? 'uk-visible@m' : '';

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_primary_menu','nav',array(
			'id' => 'beans-primary-navigation',
			'class' => 'tm-primary-menu uk-navbar-container uk-navbar-transparent',
			'role' => 'navigation',
			'itemscope' => 'itemscope',
			'itemtype' => 'https://schema.org/SiteNavigationElement',
			'aria-label' => esc_attr__('Primary Navigation Menu','bex-uikit3'),
			'tabindex' => '-1',
			'uk-navbar ' => '',
		));
			beans_open_markup_e('beans_primary_menu_wrapper','div',array(
				'class' => 'uk-navbar-right',
			));
				/**
				 * @since 1.0.1
				 * 	Filter the primary menu arguments.
				 * @param (array) $args
				 * 	Nav menu arguments.
				 * @reference (WP)
				 * 	Displays a navigation menu.
				 * 	https://developer.wordpress.org/reference/functions/wp_nav_menu/
				 * 	Determines whether a registered nav menu location has a menu assigned to it.
				 * 	https://developer.wordpress.org/reference/functions/has_nav_menu/
				*/
				// Navigation.
				beans_output_e('beans_primary_menu',wp_nav_menu(array(
					'theme_location' => has_nav_menu('primary') ? 'primary' : '',
					'fallback_cb'	=> 'beans_no_menu_notice',
					'container'	 => '',
					/* Automatically escaped. */
					'menu_class'	 => $nav_visibility,
					'echo' => FALSE,
					'beans_type'	 => 'navbar',
				)));

			beans_close_markup_e('beans_primary_menu_wrapper','div');
		beans_close_markup_e('beans_primary_menu','nav');

	}// Method


	beans_add_smart_action('beans_primary_menu_append_markup','beans_primary_menu_offcanvas_button',5);
	/**
	 * @access (public)
	 * 	Echo primary menu offcanvas button.
	 * 	https://www.getbeans.io/code-reference/functions/beans_primary_menu_offcanvas_button/
	 * @return (void)
	*/
	function beans_primary_menu_offcanvas_button()
	{
		/**
		 * @reference (WP)
		 * 	Checks a themefs support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/current_theme_supports/
		*/
		if(!current_theme_supports('offcanvas-menu')){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_primary_menu_offcanvas_button','a',array(
			'class' => 'uk-button uk-button-default uk-hidden@m',
			'uk-toggle' => 'target: #offcanvas_menu',
		));
			beans_open_markup_e('beans_primary_menu_offcanvas_button_icon','span',array(
				'class' => 'uk-margin-small-right',
				'aria-hidden' => 'true',
				'uk-icon="menu"' => '',
			));
			beans_close_markup_e('beans_primary_menu_offcanvas_button_icon','span');

			beans_output_e('beans_offcanvas_menu_button',esc_html__('Menu','bex-uikit3'));

		beans_close_markup_e('beans_primary_menu_offcanvas_button','a');

	}// Method


	beans_add_smart_action('beans_widget_area_offcanvas_bar_offcanvas_menu_prepend_markup','beans_primary_offcanvas_menu');
	/**
	 * @access (public)
	 * 	Echo off-canvas primary menu.
	 * 	https://www.getbeans.io/code-reference/functions/beans_primary_offcanvas_menu/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/widget-area.php
	*/
	function beans_primary_offcanvas_menu()
	{
		/**
		 * @reference (WP)
		 * 	Checks a themefs support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/current_theme_supports/
		*/
		if(!current_theme_supports('offcanvas-menu')){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_primary_offcanvas_menu','nav',array(
			'class' => 'tm-primary-offcanvas-menu uk-margin uk-margin-top',
			'role' => 'navigation',
			'aria-label' => esc_attr__('Off-Canvas Primary Navigation Menu','bex-uikit3'),
		));
			/**
			 * @since 1.0.1
			 * 	Filter the off-canvas primary menu arguments.
			 * @param (array) $args
			 * 	Off-canvas nav menu arguments.
			*/
			beans_output_e('beans_primary_offcanvas_menu',wp_nav_menu(array(
				'theme_location' => has_nav_menu('primary') ? 'primary' : '',
				'fallback_cb'	=> 'beans_no_menu_notice',
				'container' => '',
				'echo' => FALSE,
				'beans_type'	 => 'offcanvas',
			)));
		beans_close_markup_e('beans_primary_offcanvas_menu','nav');

	}// Method


	/**
	 * @access (public)
	 * 	Echo no menu notice.
	 * 	https://www.getbeans.io/code-reference/functions/beans_no_menu_notice/
	 * @return (void)
	*/
	function beans_no_menu_notice()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_no_menu_notice','p',array('class' => 'uk-alert uk-alert-warning'));
			beans_output_e('beans_no_menu_notice_text',esc_html__('Whoops,your site does not have a menu!','bex-uikit3'));
		beans_close_markup_e('beans_no_menu_notice','p');

	}// Method
