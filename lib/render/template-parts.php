<?php
/**
 * Loads the Beans template parts.
 * The template parts contain the structural markup and hooks to which the fragments are attached.
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
	 * 	Echo header template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_header_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/template/beans.php
	*/
	beans_add_smart_action('beans_load_document','beans_header_template',5);
	function beans_header_template()
	{
		/**
		 * @reference (WP)
		 * 	Load header template.
		 * 	https://developer.wordpress.org/reference/functions/get_header/
		*/
		get_header();

	}// Method


	/**
	 * @since 1.3.0
	 * 	Echo header partial template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_header_partial_template/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/init.php
	 * 	[Theme]/lib/templates/structure/header.php
	*/
	beans_add_smart_action('beans_site_prepend_markup','beans_header_partial_template');
	function beans_header_partial_template()
	{
		/**
		 * @since 1.0.1
		 * 	Allow overwrite.
		 * @reference (WP)
		 * 	Retrieve the name of the highest priority template file that exists.
		 * 	https://developer.wordpress.org/reference/functions/locate_template/
		*/
		if('' !== locate_template('header-partial.php',TRUE,FALSE)){return;}

		require BEANS_STRUCTURE_PATH . 'header-partial.php';

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo main content template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_content_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/template/beans.php
	 * 	[Theme]/lib/init.php
	*/
	beans_add_smart_action('beans_load_document','beans_content_template');
	function beans_content_template()
	{
		/**
		 * @since 1.0.1
		 * 	Allow overwrite.
		 * @reference (WP)
		 * 	Retrieve the name of the highest priority template file that exists.
		 * 	https://developer.wordpress.org/reference/functions/locate_template/
		*/
		if('' !== locate_template('content.php',TRUE)){return;}

		require_once BEANS_STRUCTURE_PATH . 'content.php';

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo loop template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_loop_template/
	 * @param (string) $id
	 * 	[Optional].
	 * 	The loop ID is used to filter the loop WP_Query arguments.
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/init.php
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	beans_add_smart_action('beans_content','beans_loop_template');
	function beans_loop_template($id = FALSE)
	{
		// Set default loop id.
		if(!$id){
			$id = 'main';
		}

		/**
		 * @since 1.0.1
		 * 	Only run new query if a filter is set.
		 * @reference (Beans)
		 * 	Check if any filter has been registered for a hook.
		 * 	https://www.getbeans.io/code-reference/functions/beans_has_filters/
		*/
		$_has_filter = beans_has_filters("beans_loop_query_args[_{$id}]");

		if($_has_filter){
			global $wp_query;

			/**
			 * @reference (Beans)
			 * 	Filter the beans loop query.
			 * 	This can be used for custom queries.
			 * 	https://www.getbeans.io/code-reference/hooks/beans_loop_query_args_id/
			*/
			$args = beans_apply_filters("beans_loop_query_args[_{$id}]",FALSE);
			/* phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited -- Used inside a function scope. */
			$wp_query = new WP_Query($args);
		}// endif

		/**
		 * @since 1.0.1
		 * 	Allow overwrite. Require the default loop.php if no overwrite is found.
		 * @reference (WP)
		 * 	Retrieve the name of the highest priority template file that exists.
		 * 	https://developer.wordpress.org/reference/functions/locate_template/
		*/
		if('' === locate_template('loop.php',TRUE,FALSE)){
			require BEANS_STRUCTURE_PATH . 'loop.php';
		}

		// Only reset the query if a filter is set.
		if($_has_filter){
			/* phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query -- Ensure the main query has been reset to the original main query. */
			wp_reset_query();
		}

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo comments template part.
	 * 	The comments template part only loads if comments are active to prevent unnecessary memory usage.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comments_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/utility/beans.php
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	beans_add_smart_action('beans_post_after_markup','beans_comments_template',15);
	function beans_comments_template()
	{
		global $post;

		/**
		 * @reference (WP)
		 * 	Determines whether the current post is open for comments.
		 * 	https://developer.wordpress.org/reference/functions/comments_open/
		 * 	Retrieves the amount of comments a post has.
		 * 	https://developer.wordpress.org/reference/functions/get_comments_number/
		 * 	Check a post typefs support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/post_type_supports/
		*/
		$shortcircuit_conditions = array(
			beans_get('ID',$post) && !(comments_open() || get_comments_number()),
			!post_type_supports(beans_get('post_type',$post),'comments'),
		);
		if(in_array(TRUE,$shortcircuit_conditions,TRUE)){return;}

		/**
		 * @reference (WP)
		 * 	Loads the comment template specified in $file.
		 * 	https://developer.wordpress.org/reference/functions/comments_template/
		*/
		comments_template();

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo comment template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_template/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/init.php
	 * 	[Theme]/lib/templates/structure/comment.php
	*/
	// beans_add_smart_action('beans_comment','beans_comment_template');
	beans_add_smart_action('beans_extension_comment','beans_comment_template');
	function beans_comment_template()
	{
		/**
		 * @since 1.0.1
		 * 	Allow overwrite.
		 * @reference (WP)
		 * 	Retrieve the name of the highest priority template file that exists.
		 * 	https://developer.wordpress.org/reference/functions/locate_template/
		*/
		if('' !== locate_template('comment.php',TRUE,FALSE)){return;}

		require BEANS_STRUCTURE_PATH . 'comment.php';

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo widget area template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_area_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/utility/general.php
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/init.php
	*/
	beans_add_smart_action('beans_widget_area','beans_widget_area_template');
	function beans_widget_area_template()
	{
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){return;}
		/**
		 * @since 1.0.1
		 * 	Allow overwrite.
		 * @reference (WP)
		 * 	Retrieve the name of the highest priority template file that exists.
		 * 	https://developer.wordpress.org/reference/functions/locate_template/
		*/
		if('' !== locate_template('widget-area.php',TRUE,FALSE)){return;}

		require BEANS_STRUCTURE_PATH . 'widget-area.php';

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo primary sidebar template part.
	 * 	The primary sidebar template part only loads if the layout set includes it. This prevents unnecessary memory usage.
	 * 	https://www.getbeans.io/code-reference/functions/beans_sidebar_primary_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/layout/beans.php
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/templates/structure/content.php
	*/
	beans_add_smart_action('beans_primary_after_markup','beans_sidebar_primary_template');
	function beans_sidebar_primary_template()
	{
		/**
		 * @reference (Beans)
		 * 	Get the current layout.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_layout/
		 * 	Check whether a widget area is registered.
		 * 	https://www.getbeans.io/code-reference/functions/beans_has_widget_area/
		*/
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){
			if(FALSE === stripos(beans_get_layout(),'sp') || !is_active_sidebar('sidebar_primary')){return;}
		}
		else{
			if(FALSE === stripos(beans_get_layout(),'sp') || !beans_has_widget_area('sidebar_primary')){return;}
		}

		/**
		 * @reference (WP)
		 * 	Load sidebar template.
		 * 	https://developer.wordpress.org/reference/functions/get_sidebar/
		*/
		get_sidebar('primary');

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo secondary sidebar template part.
	 * 	The secondary sidebar template part only loads if the layout set includes it. This prevents unnecessary memory usage.
	 * 	https://www.getbeans.io/code-reference/functions/beans_sidebar_secondary_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/layout/beans.php
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/templates/structure/content.php
	*/
	beans_add_smart_action('beans_primary_after_markup','beans_sidebar_secondary_template');
	function beans_sidebar_secondary_template()
	{
		/**
		 * @reference (Beans)
		 * Get the current layout.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_layout/
		 * 	Check whether a widget area is registered.
		 * 	https://www.getbeans.io/code-reference/functions/beans_has_widget_area/
		*/
		if(Beans_Extension\__utility_get_beans_admin_settings('stop_widget')){
			if(FALSE === stripos(beans_get_layout(),'ss') || !is_active_sidebar('sidebar_secondary')){return;}
		}
		else{
			if(FALSE === stripos(beans_get_layout(),'ss') || !beans_has_widget_area('sidebar_secondary')){return;}
		}

		/**
		 * @reference (WP)
		 * 	Load sidebar template.
		 * 	https://developer.wordpress.org/reference/functions/get_sidebar/
		*/
		get_sidebar('secondary');

	}// Method


	/**
	 * @since 1.3.0
	 * 	Echo footer partial template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_footer_partial_template/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/init.php
	 * 	[Theme]/lib/templates/structure/footer.php
	*/
	beans_add_smart_action('beans_site_append_markup','beans_footer_partial_template');
	function beans_footer_partial_template()
	{
		/**
		 * @since 1.0.1
		 * 	Allow overwrite.
		 * @reference (WP)
		 * 	Retrieve the name of the highest priority template file that exists.
		 * 	https://developer.wordpress.org/reference/functions/locate_template/
		*/
		if('' !== locate_template('footer-partial.php',TRUE,FALSE)){	return;}
		require BEANS_STRUCTURE_PATH . 'footer-partial.php';

	}// Method


	/**
	 * @since 1.0.1
	 * 	Echo footer template part.
	 * 	https://www.getbeans.io/code-reference/functions/beans_footer_template/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/template/beans.php
	*/
	beans_add_smart_action('beans_load_document','beans_footer_template');
	function beans_footer_template()
	{
		/**
		 * @reference (WP)
		 * 	Load footer template.
		 * 	https://developer.wordpress.org/reference/functions/get_footer/
		*/
		get_footer();

	}// Method


	/**
	 * @access (private)
	 * @since 1.2.0
	 * 	Set the content width based on the Beans default layout.
	 * 	This is mainly added to align to WordPress.org requirements.
	*/
	if(!isset($content_width)){
		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Valid use case. */
		$content_width = 800;
	}
