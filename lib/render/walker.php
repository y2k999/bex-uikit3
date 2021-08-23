<?php
/**
 * Extends WordPress walker.
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
 * @since 1.0.1
 * 	Extends WordPress Walker_Nav_Menu class.
 * @package Beans\Framework\Render
*/
class _Beans_Walker_Nav_Menu extends Walker_Nav_Menu
{

	/**
	 * @access (public)
	 * 	Extend WordPress start first menu level.
	 * @param (string) $output
	 * 	Used to append additional content (passed by reference).
	 * @param (int) $depth
	 * 	Depth of menu item.
	 * 	Used for padding.
	 * @param (stdClass) $args
	 * 	An object of wp_nav_menu() arguments.
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/utility/beans.php
	*/
	public function start_lvl(&$output,$depth = 0,$args = array())
	{
		// Stop here if the depth is smaller than starting depth.
		if($depth < $args->beans_start_level){return;}

		$type = beans_get('beans_type',$args);
		$location = beans_get('theme_location',$args);
		$location_subfilter = $location ? "[_{$location}]" : NULL;

		// Default attributes.
		$attr = array(
			'class' => array('sub-menu'),
		);

		// Add UIkit sidenav and offcanvas class.
		if($depth > 0 || in_array($type,array('sidenav','offcanvas'),TRUE)){
			$attr['class'][] = 'uk-nav uk-navbar-dropdown-navs uk-nav-sub';
		}

		// Add UIkit navbar stuff.
		if('navbar' === $type && $args->beans_start_level === $depth){
			// Add UIkit navbar attributes.
			$attr['class'][] = 'uk-nav-sub uk-navbar-dropdown-nav';

			/**
			 * @since 1.0.1
			 * 	Open sub_menu wrap.
			 * @reference (Beans)
			 * 	Register open markup and attributes by ID.
			 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
			*/
			$output .= beans_open_markup("beans_sub_menu_wrap[_{$type}]{$location_subfilter}",'div',array(
				'class' => 'uk-navbar-dropdown'
			),$depth,$args);
		}

		// Implode to avoid empty spaces.
		$attr['class'] = implode(' ',array_filter($attr['class']));

		// Set to null if empty to avoid outputing empty class html attribute.
		if(!$attr['class']){
			$attr['class'] = NULL;
		}

		/**
		 * @since 1.0.1
		 * 	Open sub_menu.
		 * @reference (Beans)
		 * 	Register open markup and attributes by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		*/
		$output .= beans_open_markup("beans_sub_menu[_{$type}]{$location_subfilter}",'ul',$attr,$depth,$args);

	}// Method


	/**
	 * @access (public)
	 * 	Extend WordPress end first menu level.
	 * @param (string) $output
	 * 	Used to append additional content (passed by reference).
	 * @param (int) $depth
	 * 	Depth of menu item. Used for padding.
	 * @param (stdClass) $args
	 * 	An object of wp_nav_menu() arguments.
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/utility/beans.php
	*/
	public function end_lvl(&$output,$depth = 0,$args = array())
	{
		// Stop here if the depth is smaller than starting depth.
		if($depth < $args->beans_start_level){return;}

		$type = beans_get('beans_type',$args);
		$location = beans_get('theme_location',$args);
		$location_subfilter = $location ? "[_{$location}]" : NULL;

		/**
		 * @since 1.0.1
		 * 	Close sub_menu.
		 * @reference (Beans)
		 * 	Register close markup by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output .= beans_close_markup("beans_sub_menu[_{$type}]{$location_subfilter}",'ul');

		/**
		 * @since 1.0.1
		 * 	Close sub_menu wrap.
		 * @reference (Beans)
		 * 	Register close markup by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		if('navbar' === $type && $args->beans_start_level === $depth){
			$output .= beans_close_markup("beans_sub_menu_wrap[_{$type}]{$location_subfilter}",'div',$depth,$args);
		}

	}// Method


	/**
	 * @access (public)
	 * 	Extend WordPress start menu elements.
	 * @param (string) $output
	 * 	Used to append additional content (passed by reference).
	 * @param (WP_Post) $item
	 * 	Menu item data object.
	 * @param (int) $depth
	 * 	Depth of menu item. Used for padding.
	 * @param (stdClass) $args
	 * 	An object of wp_nav_menu() arguments.
	 * @param (int) $id
	 * 	Current item ID.
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/utility/beans.php
	*/
	public function start_el(&$output,$item,$depth = 0,$args = array(),$id = 0)
	{
		// Stop here if the depth is smaller than starting depth.
		if($depth < $args->beans_start_level){return;}

		$item_id = $item->ID;

		// WP item attributes.
		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Used inside method scope. */
		$id = apply_filters('nav_menu_item_id','menu-item-' . $item->ID,$item,$args);
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Used inside method scope. */
		$_classes = join(' ',(array) apply_filters('nav_menu_css_class',array_filter($classes),$item,$args));

		// WP link attributes.
		$_link_attr = array(
			'title' => $item->attr_title,
			'target' => $item->target,
			'rel' => $item->xfn,
			'href' => $item->url,
			'itemprop' => 'url',
		);

		// Prevent empty WP link attributes.
		foreach($_link_attr as $attr => $value){
			if(empty($value)){
				$_link_attr[$attr] = NULL;
			}
		}

		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Used inside method scope. */
		$link_attr = apply_filters('nav_menu_link_attributes',$_link_attr,$item,$args);

		// Set WP item attributes as defaults.
		$item_attr = array(
			'class' => array($_classes),
			'itemprop' => 'name',
		);

		// Add UIkit active class.
		if(in_array('current-menu-item',$classes,true)){
			$item_attr['class'][] = 'uk-active';
		}

		// Add UIkit parent attributes.
		if($args->beans_start_level === $depth && in_array('menu-item-has-children',$classes,TRUE)){
			$item_attr['class'][] = 'uk-parent';

			if(beans_get('beans_type',$args) === 'navbar'){
				$item_attr['data-uk-dropdownaaa'] = '';
				$child_indicator = TRUE;
			}
		}

		// Implode to avoid empty spaces.
		$item_attr['class'] = implode(' ',array_filter($item_attr['class']));

		// Set to null if empty to avoid outputing empty class html attribute.
		if(!$item_attr['class']){
			$item_attr['class'] = NULL;
		}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output .= beans_open_markup("beans_menu_item[_{$item_id}]",'li',$item_attr,$item,$depth,$args);

		$item_output = $args->before;
		$item_output .= beans_open_markup("beans_menu_item_link[_{$item_id}]",'a',$link_attr,$item,$depth,$args);

		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Used inside method scope. */
		$item_output .= beans_output("beans_menu_item_text[_{$item_id}]",$args->link_before . apply_filters('the_title',$item->title,$item->ID) . $args->link_after);

		if(isset($child_indicator)){
			$item_output .= beans_open_markup("beans_menu_item_child_indicator[_{$item_id}]",'i',array('class' => '','uk-icon' => 'icon:triangle-down'),$item,$depth,$args);
			$item_output .= beans_close_markup("beans_menu_item_child_indicator[_{$item_id}]",'i',$item,$depth,$args);
		}
			$item_output .= beans_close_markup("beans_menu_item_link[_{$item_id}]",'a',$link_attr,$item,$depth,$args);

			$item_output .= $args->after;

		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Used inside method scope. */
		$output .= apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);

	}// Method


	/**
	 * @access (public)
	 * 	Extend WordPress end menu elements.
	 * @param (string) $output
	 * 	Used to append additional content (passed by reference).
	 * @param (WP_Post) $item
	 * 	Page data object. Not used.
	 * @param (int) $depth
	 * 	Depth of page. Not Used.
	 * @param (stdClass) $args
	 * 	An object of wp_nav_menu() arguments.
	 * @return (void)
	*/
	public function end_el(&$output,$item,$depth = 0,$args = array())
	{

		// Stop here if the depth is smaller than starting depth.
		if($depth < $args->beans_start_level){return;}

		$item_id = $item->ID;

		/**
		 * @reference (Beans)
		 * 	Register close markup by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output .= beans_close_markup("beans_menu_item[_{$item_id}]",'li',$item,$depth,$args);

	}// Method


}// Class
