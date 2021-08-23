<?php
/**
 * Sets up the Beans menus.
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


	beans_add_smart_action('after_setup_theme','beans_do_register_default_menu');
	/**
	 * @since 1.0.1
	 * 	Register default menu.
	 * 	https://www.getbeans.io/code-reference/functions/beans_do_register_default_menu/
	 * @return (void)
	 * @reference (WP)
	 * 	Fires after the theme is loaded.
	 * 	https://developer.wordpress.org/reference/hooks/after_setup_theme/
	*/
	function beans_do_register_default_menu()
	{
		/**
		 * @since 1.0.1
		 * 	Stop here if a menu already exists.
		 * @reference (WP)
		 * Returns all navigation menu objects.
		 * 	https://developer.wordpress.org/reference/functions/wp_get_nav_menus/
		*/
		if(wp_get_nav_menus()){return;}

		$name = __('Navigation','bex-uikit3');

		/**
		 * @since 1.0.1
		 * 	Set up a default menu if it doesn't exist.
		 * @reference (WP)
		 * 	Returns a navigation menu object.
		 * 	https://developer.wordpress.org/reference/functions/wp_get_nav_menu_object/
		*/
		if(!wp_get_nav_menu_object($name)){
			/**
			 * @reference (WP)
			 * 	Save the properties of a menu item or create a new one.
			 * 	https://developer.wordpress.org/reference/functions/wp_update_nav_menu_item/
			 * 	Creates a navigation menu.
			 * 	https://developer.wordpress.org/reference/functions/wp_create_nav_menu/
			 * 	Retrieves the URL for the current site where the front end is accessible.
			 * 	https://developer.wordpress.org/reference/functions/home_url/
			*/
			wp_update_nav_menu_item(wp_create_nav_menu($name),0,array(
				'menu-item-title' => __('Home','bex-uikit3'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish',
			));
		}

	}// Method


	beans_add_smart_action('after_setup_theme','beans_do_register_nav_menus');
	/**
	 * @since 1.0.1
	 * 	Register nav menus.
	 * 	https://www.getbeans.io/code-reference/functions/beans_do_register_nav_menus/
	 * @return (void)
	 * @reference (WP)
	 * 	Fires after the theme is loaded.
	 * 	https://developer.wordpress.org/reference/hooks/after_setup_theme/
	*/
	function beans_do_register_nav_menus()
	{
		/**
		 * @reference (WP)
		 * 	Registers navigation menu locations for a theme.
		 * 	https://developer.wordpress.org/reference/functions/register_nav_menus/
		*/
		register_nav_menus(array(
			'primary' => __('Primary Menu','bex-uikit3'),
		));

	}// Method


	// Filter.
	beans_add_smart_action('wp_nav_menu_args','beans_modify_menu_args');
	/**
	 * @since 1.0.1
	 * 	Modify wp_nav_menu arguments.
	 * 	This function converts the wp_nav_menu to UIkit format. It uses the Beans custom walker and also makes use of the Beans HTML API.
	 * 	https://www.getbeans.io/code-reference/functions/beans_modify_menu_args/
	 * @param (array) $args
	 * 	The wp_nav_menu arguments.
	 * @return (array)
	 * 	The modified wp_nav_menu arguments.
	 * @reference (WP)
	 * 	Filters the arguments used to display a navigation menu.
	 * 	https://developer.wordpress.org/reference/hooks/wp_nav_menu_args/
	 * @reference
	 * 	[Plugin]/beans_extension/utility/beans.php
	 * 	[Plugin]/beans_extension/api/html/beans.php
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	*/
	function beans_modify_menu_args($args)
	{
		// Get type.
		$type = beans_get('beans_type',$args);

		/**
		 * @since 1.0.1
		 * 	Check if the menu is in a widget area and set the type accordingly if it is defined.
		 * @reference (Beans)
		 * 	Retrieve data from the current widget area in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget_area/
		*/
		$widget_area_type = beans_get_widget_area('beans_type');

		if($widget_area_type){
			$type = 'stack' === $widget_area_type ? 'sidenav' : $widget_area_type;
		}

		// Stop if it isn't a Beans menu.
		if(!$type){
			return $args;
		}

		// Default item wrap attributes.
		$attr = array(
			'id' => '%1$s',
			'class' => array(beans_get('menu_class',$args)),
		);

		// Add UIkit navbar item wrap attributes.
		if('navbar' === $type){
			$attr['class'][] = 'uk-navbar-nav';
		}

		// Add UIkit sidenav item wrap attributes.
		if('sidenav' === $type){
			$attr['class'][] = 'uk-nav uk-nav-parent-icon uk-nav-side';
			$attr['uk-nav'] = '{multiple:true}';
		}

		// Add UIkit offcanvas item wrap attributes.
		if('offcanvas' === $type){
			$attr['class'][] = 'uk-nav uk-nav-parent-icon uk-nav-default';
			// $attr['uk-offcanvas'] = '';
		}

		// Implode to avoid empty spaces.
		$attr['class'] = implode(' ',array_filter($attr['class']));

		// Set to null if empty to avoid outputing an empty HTML class attribute.
		if(!$attr['class']){
			$attr['class'] = NULL;
		}

		$location = beans_get('theme_location',$args);

		$location_subfilter = $location ? "[_{$location}]" : NULL;

		/**
		 * @since 1.0.1
		 * 	Force Beans menu arguments.
		 * @reference (Beans)
		 * 	Register open markup and attributes by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	Register close markup by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$force = array(
			'beans_type' => $type,
			'items_wrap' => beans_open_markup("beans_menu[_{$type}]{$location_subfilter}",'ul',$attr,$args) . '%3$s' . beans_close_markup("beans_menu[_{$type}]{$location_subfilter}",'ul',$args),
		);

		// Allow walker overwrite.
		if(!beans_get('walker',$args)){
			$args['walker'] = new _Beans_Walker_Nav_Menu();
		}

		// Adapt level to walker depth.
		$level = beans_get('beans_start_level',$args);

		$force['beans_start_level'] = $level ? $level - 1 : 0;

		return array_merge($args,$force);

	}// Method
