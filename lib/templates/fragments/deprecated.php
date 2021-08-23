<?php
/**
 * Deprecated fragments.
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
	 * 	Deprecated. Echo head title.
	 * 	This function is deprecated since it was replaced by the 'title-tag' theme support.
	 * @deprecated 1.2.0
	 * @return (void)
	*/
	function beans_head_title()
	{
		_deprecated_function(__FUNCTION__,'1.2.0','wp_title()');
		wp_title('|',TRUE,'right');

	}// Method


	/**
	 * @since 1.0.1
	 * 	Deprecated. Modify head wp title.
	 * 	This function is deprecated since it was replaced by the 'title-tag' theme support.
	 * @deprecated 1.2.0
	 * @param (string) $title
	 * 	The WordPress default title.
	 * @param (string) $sep
	 * 	The title separator.
	 * @return (string)
	 * 	The modified title.
	 */
	function beans_wp_title($title,$sep)
	{
		_deprecated_function(__FUNCTION__,'1.2.0','wp_title()');
		global $page,$paged;

		/**
		 * @reference (WP)
		 * 	Determines whether the query is for a feed.
		 * 	https://developer.wordpress.org/reference/functions/is_feed/
		*/
		if(is_feed()){
			return $title;
		}

		/**
		 * @since 1.0.1
		 * 	Add the blog name.
		 * @reference (WP)
		 * 	Retrieves information about the current site.
		 * 	https://developer.wordpress.org/reference/functions/get_bloginfo/
		*/
		$title .= get_bloginfo('name');

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo('description','display');

		/**
		 * @reference (WP)
		 * 	Determines whether the query is for the blog homepage.
		 * 	https://developer.wordpress.org/reference/functions/is_home/
		 * 	Determines whether the query is for the front page of the site.
		 * 	https://developer.wordpress.org/reference/functions/is_front_page/
		*/
		if($site_desciption && (is_home() || is_front_page())){
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if($paged >= 2 || $page >= 2 ){
			/* translators: Page number. */
			$title .= " $sep " . sprintf(__('Page %s','bex-uikit3'),max($paged,$page));
		}

		return $title;

	}// Method


	/**
	 * @deprecated 1.2.0
	 * 	Deprecated shortcodes.
	 * 	We declare the shortcodes for backward compatibility purposes but they shouldn't be used for further development.
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/post-shortcodes.php
	*/

	// WP global.
	global $shortcode_tags;

	/* phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited -- Deprecated function. */
	$shortcode_tags = array_merge($shortcode_tags,array(
		'beans_post_meta_date' => 'beans_post_meta_date_shortcode',
		'beans_post_meta_author' => 'beans_post_meta_author_shortcode',
		'beans_post_meta_comments' => 'beans_post_meta_comments_shortcode',
		'beans_post_meta_tags' => 'beans_post_meta_tags_shortcode',
		'beans_post_meta_categories' => 'beans_post_meta_categories_shortcode',
	));
