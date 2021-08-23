<?php
/**
 * Add post shortcodes.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	beans_add_smart_action('beans_post_meta_date','beans_post_meta_date_shortcode');
	/**
	 * @access (public)
	 * 	Echo post meta date shortcode.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_date_shortcode/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/post-shortcodes.php
	*/
	function beans_post_meta_date_shortcode()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_output_e('beans_post_meta_date_prefix',esc_html__('Posted on ','bex-uikit3'));

		beans_open_markup_e('beans_post_meta_date','time',array(
			'datetime' => get_the_time('c'),
			'itemprop' => 'datePublished',
		));
			/**
			 * @reference (WP)
			 * 	Retrieve the time at which the post was written.
			 * 	https://developer.wordpress.org/reference/functions/get_the_time/
			*/
			beans_output_e('beans_post_meta_date_text',get_the_time(get_option('date_format')));
		beans_close_markup_e('beans_post_meta_date','time');

	}// Method


	beans_add_smart_action('beans_post_meta_author','beans_post_meta_author_shortcode');
	/**
	 * @access (public)
	 * 	Echo post meta author shortcode.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_author_shortcode/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/post-shortcodes.php
	*/
	function beans_post_meta_author_shortcode()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_output_e('beans_post_meta_author_prefix',esc_html__('By ','bex-uikit3'));

		/**
		 * @reference (WP)
		 * 	Retrieve the URL to the author page for the user with the ID provided.
		 * 	https://developer.wordpress.org/reference/functions/get_author_posts_url/
		 * 	Retrieves the requested data of the author of the current post.
		 * 	https://developer.wordpress.org/reference/functions/get_the_author_meta/
		*/
		beans_open_markup_e('beans_post_meta_author','a',array(
			/* Automatically escaped. */
			'href' => get_author_posts_url(get_the_author_meta('ID')),
			'rel' => 'author',
			'itemprop' => 'author',
			'itemscope' => '',
			'itemtype' => 'https://schema.org/Person',
		));
			/**
			 * @reference (WP)
			 * 	Retrieve the author of the current post.
			 * 	https://developer.wordpress.org/reference/functions/get_the_author/
			*/
			beans_output_e('beans_post_meta_author_text',get_the_author());

			beans_selfclose_markup_e('beans_post_meta_author_name_meta','meta',array(
				'itemprop' => 'name',
				/* Automatically escaped. */
				'content' => get_the_author(),
			));
		beans_close_markup_e('beans_post_meta_author','a');

	}// Method


	beans_add_smart_action('beans_post_meta_comments','beans_post_meta_comments_shortcode');
	/**
	 * @access (public)
	 * 	Echo post meta comments shortcode.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_comments_shortcode/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/post-shortcodes.php
	*/
	function beans_post_meta_comments_shortcode()
	{
		/**
		 * @reference (WP)
		 * 	Whether post requires password and correct password has been provided.
		 * 	https://developer.wordpress.org/reference/functions/post_password_required/
		 * 	Determines whether the current post is open for comments.
		 * 	https://developer.wordpress.org/reference/functions/comments_open/
		*/
		if(post_password_required() || !comments_open()){return;}

		// WP global.
		global $post;
		/**
		 * @reference (WP)
		 * 	Retrieves the amount of comments a post has.
		 * 	https://developer.wordpress.org/reference/functions/get_comments_number/
		*/
		$comments_number = (int) get_comments_number($post->ID);

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		if($comments_number < 1){
			$comment_text = beans_output('beans_post_meta_empty_comment_text',esc_html__('Leave a comment','bex-uikit3'));
		}
		elseif(1 === $comments_number){
			$comment_text = beans_output('beans_post_meta_comments_text_singular',esc_html__('1 comment','bex-uikit3'));
		}
		else{
			/* translators: %s: Number of comments. Plural. */
			$comment_text = beans_output('beans_post_meta_comments_text_plural',esc_html__('%s comments','bex-uikit3'));
		}

		/* Automatically escaped. */
		beans_open_markup_e('beans_post_meta_comments','a',array('href' => get_comments_link()));
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Escaping handled prior to this printf. */
			printf($comment_text,(int) get_comments_number($post->ID));
		beans_close_markup_e('beans_post_meta_comments','a');

	}// Method


	beans_add_smart_action('beans_post_meta_tags','beans_post_meta_tags_shortcode');
	/**
	 * @access (public)
	 * 	Echo post meta tags shortcode.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_tags_shortcode/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/post-shortcodes.php
	*/
	function beans_post_meta_tags_shortcode()
	{
		/**
		 * @reference (WP)
		 * 	Retrieves the tags for a post formatted as a string.
		 * 	https://developer.wordpress.org/reference/functions/get_the_tag_list/
		*/
		$tags = get_the_tag_list(null,', ');

		if(!$tags || is_wp_error($tags)){return;}

		/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Tags are escaped by WordPress. */
		printf('%1$s%2$s',beans_output('beans_post_meta_tags_prefix',esc_html__('Tagged with: ','bex-uikit3')),$tags);

	}// Method


	beans_add_smart_action('beans_post_meta_categories','beans_post_meta_categories_shortcode');
	/**
	 * @access (public)
	 * 	Echo post meta categories shortcode.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_categories_shortcode/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/post-shortcodes.php
	*/
	function beans_post_meta_categories_shortcode()
	{
		/**
		 * @reference (WP)
		 * 	Retrieves category list for a post in either HTML list or custom format.
		 * 	https://developer.wordpress.org/reference/functions/get_the_category_list/
		*/
		$categories = get_the_category_list(', ');

		if(!$categories || is_wp_error($categories)){return;}

		/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Categories are escaped by WordPress. */
		printf('%1$s%2$s',beans_output('beans_post_meta_categories_prefix',esc_html__('Filed under: ','bex-uikit3')),$categories);

	}// Method
