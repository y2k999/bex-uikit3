<?php
/**
 * Loads Beans fragments.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	// Filter.
	beans_add_smart_action('template_redirect','beans_load_global_fragments',1);
	/**
	 * @since 1.0.1
	 * 	Load global fragments and dynamic views.
	 * 	https://www.getbeans.io/code-reference/functions/beans_load_global_fragments/
	 * @return (void)
	 * @reference (WP)
	 * 	Fires before determining which template to load.
	 * 	https://developer.wordpress.org/reference/hooks/template_redirect/
	 * @reference
	 * 	[Theme]/lib/init.php
	*/
	function beans_load_global_fragments()
	{
		/**
		 * @reference (Beans)
		 * 	Load fragment file.
		 * 	https://www.getbeans.io/code-reference/functions/beans_load_fragment_file/
		*/
		beans_load_fragment_file('breadcrumb',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('footer',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('header',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('menu',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('post-shortcodes',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('post',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('widget-area',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('embed',BEANS_FRAGMENTS_PATH);
		beans_load_fragment_file('deprecated',BEANS_FRAGMENTS_PATH);

	}// Method


	// Filter.
	beans_add_smart_action('comments_template','beans_load_comments_fragment');
	/**
	 * @since 1.0.1
	 * 	Load comments fragments.
	 * 	The comments fragments only loads if comments are active to prevent unnecessary memory usage.
	 * 	https://www.getbeans.io/code-reference/functions/beans_load_comments_fragment/
	 * @param (string) $template
	 * 	The template filename.
	 * @return (string)
	 * 	The template filename.
	 * @reference (WP)
	 * 	Filters the path to the theme template file used for the comments template.
	 * 	https://developer.wordpress.org/reference/hooks/comments_template/
	 * @reference
	 * 	[Theme]/lib/init.php
	*/
	function beans_load_comments_fragment($template)
	{
		if(empty($template)){return;}

		/**
		 * @reference (Beans)
		 * Load fragment file.
		 * 	https://www.getbeans.io/code-reference/functions/beans_load_fragment_file/
		*/
		beans_load_fragment_file('comments',BEANS_FRAGMENTS_PATH);
		return $template;

	}// Method


	beans_add_smart_action('dynamic_sidebar_before','beans_load_widget_fragment',-1);
	/**
	 * @since 1.0.1
	 * 	Load widget fragments.
	 * 	The widget fragments only loads if a sidebar is active to prevent unnecessary memory usage.
	 * 	https://www.getbeans.io/code-reference/functions/beans_load_widget_fragment/
	 * @return (bool)
	 * 	True on success, false on failure.
	 * @reference (WP)
	 * 	Fires before widgets are rendered in a dynamic sidebar.
	 * https://developer.wordpress.org/reference/hooks/dynamic_sidebar_before/
	 * @reference
	 * 	[Plugin]/beans_extension/utility/general.php
	 * 	[Theme]/lib/init.php
	*/
	function beans_load_widget_fragment()
	{
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){return;}
		/**
		 * @reference (Beans)
		 * 	Load fragment file.
		 * 	https://www.getbeans.io/code-reference/functions/beans_load_fragment_file/
		*/
		return beans_load_fragment_file('widget',BEANS_FRAGMENTS_PATH);

	}// Method


	beans_add_smart_action('pre_get_search_form','beans_load_search_form_fragment');
	/**
	 * @since 1.0.1
	 * 	Load search form fragments.
	 * 	The search form fragments only loads if search is active to prevent unnecessary memory usage.
	 * 	https://www.getbeans.io/code-reference/functions/beans_load_search_form_fragment/
	 * @return (bool)
	 * 	True on success, false on failure.
	 * @reference (WP)
	 * 	Fires before the search form is retrieved, at the start of get_search_form().
	 * 	https://developer.wordpress.org/reference/hooks/pre_get_search_form/
	 * @reference
	 * 	[Theme]/lib/init.php
	*/
	function beans_load_search_form_fragment()
	{
		/**
		 * @reference (Beans)
		 * 	Load fragment file.
		 * 	https://www.getbeans.io/code-reference/functions/beans_load_fragment_file/
		*/
		return beans_load_fragment_file('searchform',BEANS_FRAGMENTS_PATH);

	}// Method
