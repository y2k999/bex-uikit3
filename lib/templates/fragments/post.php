<?php
/**
 * Echo post fragments.
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


	beans_add_smart_action('beans_post_header','beans_post_title');
	/**
	 * @access (public)
	 * 	Echo post title.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_title/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_title()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * @reference (WP)
		 * 	Retrieve post title.
		 * 	https://developer.wordpress.org/reference/functions/get_the_title/
		*/
		$title = beans_output('beans_post_title_text',get_the_title());
		if(empty($title)){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		 * @reference (WP)
		 * 	Determines whether the query is for an existing single post of any post type (post, attachment, page, custom post types).
		 * 	https://developer.wordpress.org/reference/functions/is_singular/
		 * 	Sanitize the current title when retrieving or displaying.
		 * 	https://developer.wordpress.org/reference/functions/the_title_attribute/
		*/
		if(!is_singular()){
			$title_link = beans_open_markup('beans_post_title_link','a',array(
				'class' => 'uk-text-muted',
				/* Automatically escaped. */
				'href' => get_permalink(),
				'title' => the_title_attribute('echo=0'),
				'rel' => 'bookmark',
			));

			$title_link .= $title;
			$title_link .= beans_close_markup('beans_post_title_link','a');

			$title = $title_link;
		}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * @reference (Uikit)
		 * 	https://getuikit.com/docs/article
		*/
		beans_open_markup_e('beans_post_title','h2',array(
			'class' => 'uk-article-title uk-padding-small',
			'itemprop' => 'headline',
		));
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
			echo $title;

		beans_close_markup_e('beans_post_title','h2');

	}// Method


	beans_add_smart_action('beans_before_loop','beans_post_search_title');
	/**
	 * @access (public)
	 * 	Echo search post title.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_search_title/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_search_title()
	{
		/**
		 * @reference (WP)
		 * 	Determines whether the query is for a search.
		 * 	https://developer.wordpress.org/reference/functions/is_search/
		*/
		if(!is_search()){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * @reference (WP)
		 * 	Retrieves the contents of the search WordPress query variable.
		 * 	https://developer.wordpress.org/reference/functions/get_search_query/
		 * @reference (Uikit)
		 * 	https://getuikit.com/docs/article
		*/
		beans_open_markup_e('beans_search_title','h2',array('class' => 'uk-article-title uk-margin-remove-adjacent uk-margin'));
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Each placeholder is escaped. */
			printf('%1$s%2$s',beans_output('beans_search_title_text',esc_html__('Search results for: ','bex-uikit3')),get_search_query());
		beans_close_markup_e('beans_search_title','h2');

	}// Method


	beans_add_smart_action('beans_before_loop','beans_post_archive_title');
	/**
	 * @since 1.4.0
	 * 	Echo archive post title.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_archive_title/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_archive_title()
	{
		/**
		 * @reference (WP)
		 * 	Determines whether the query is for an existing archive page.
		 * 	https://developer.wordpress.org/reference/functions/is_archive/
		*/
		if(!is_archive()){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_archive_title','h1',array('class' => 'uk-heading-line uk-text-bold uk-margin-remove-adjacent uk-margin'));
			/**
			 * @reference (WP)
			 * 	Retrieve the archive title based on the queried object.
			 * 	https://developer.wordpress.org/reference/functions/get_the_archive_title/
			*/
			beans_output_e('beans_archive_title_text',get_the_archive_title());
		beans_close_markup_e('beans_archive_title','h1');

	}// Method


	beans_add_smart_action('beans_post_header','beans_post_meta',15);
	/**
	 * @access (public)
	 * 	Echo post meta.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_meta()
	{
		/**
		 * @since 1.0.1
		 * 	Filter whether {@see beans_post_meta()} should be short-circuit or not.
		 * @param (bool) $pre
		 * 	True to short-circuit, False to let the function run.
		 * @reference (WP)
		 * 	Retrieves the post type of the current post or of a given post.
		 * 	https://developer.wordpress.org/reference/functions/get_post_type/
		*/
		if(apply_filters('beans_pre_post_meta','post' !== get_post_type())){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post_meta','ul',array('class' => 'uk-list uk-flex'));
			/**
			 * @since 1.0.1
			 * 	Filter the post meta actions and order.
			 * 	A do_action( "beans_post_meta_{$array_key}" ) is called for each array key set.
			 * 	Array values are used to set the priority of each actions.
			 * 	The array ordered using asort();
			 * @param (array) $fragments
			 * 	An array of fragment files.
			 */
			$meta_items = apply_filters('beans_post_meta_items',array(
				'date' => 10,
				'author' => 20,
				'comments' => 30,
			));
			asort($meta_items);

			foreach($meta_items as $meta => $priority){
				/**
				 * @reference (Beans)
				 * 	Calls function given by the first parameter and passes the remaining parameters as arguments.
				 * 	https://www.getbeans.io/code-reference/functions/beans_render_function/
				*/
				$content = beans_render_function('do_action',"beans_post_meta_$meta");
				if(!$content){continue;}

				beans_open_markup_e("beans_post_meta_item[_{$meta}]",'li',array('class' => 'uk-article-meta uk-padding-small'));
					beans_output_e("beans_post_meta_item_{$meta}_text",$content);
				beans_close_markup_e("beans_post_meta_item[_{$meta}]",'li');
			}
		beans_close_markup_e('beans_post_meta','ul');

	}// Method


	beans_add_smart_action('beans_post_body','beans_post_image',5);
	/**
	 * @access (public)
	 * 	Echo post image.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_image/
	 * @return (bool)
	 * @reference
	 * 	[Plugin]/beans_extension/api/image/beans.php
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_image()
	{
		/**
		 * @reference (WP)
		 * 	Determines whether a post has an image attached.
		 * 	https://developer.wordpress.org/reference/functions/has_post_thumbnail/
		 * 	Checks a themefs support for a given feature.
		 * 	https://developer.wordpress.org/reference/functions/current_theme_supports/
		*/
		if(!has_post_thumbnail() || !current_theme_supports('post-thumbnails')){
			return FALSE;
		}

		// WP global.
		global $post;

		/**
		 * @since 1.2.5
		 * 	Filter whether Beans should handle the image edition (resize) or let WP do so.
		 * @param (bool) $edit
		 * 	True to use Beans Image API to handle the image edition (resize), false to let {@link https://codex.wordpress.org/Function_Reference/the_post_thumbnail the_post_thumbnail()} taking care of it. Default true.
		 */
		$edit = apply_filters('beans_post_image_edit',TRUE);

		if($edit){
			/**
			 * @since 1.0.1
			 * 	Filter the arguments used by {@see beans_edit_image()} to edit the post image.
			 * @param (bool)|(array) $edit_args
			 * 	Arguments used by {@see beans_edit_image()}.
			 * 	Set to false to use WordPress large size.
			 */
			$edit_args = apply_filters('beans_edit_post_image_args',array(
				'resize' => array(800,FALSE),
			));

			/**
			 * @reference (Beans)
			 * 	Get attachment data.
			 * 	https://www.getbeans.io/code-reference/functions/beans_get_post_attachment/
			 * 	Edit post attachment.
			 * 	https://www.getbeans.io/code-reference/functions/beans_edit_post_attachment/
			*/
			if(empty($edit_args)){
				$image = beans_get_post_attachment($post->ID,'large');
			}
			else{
				$image = beans_edit_post_attachment($post->ID,$edit_args);
			}

			/**
			 * @since 1.0.1
			 * 	Filter the arguments used by {@see beans_edit_image()} to edit the post small image.
			 * 	The small image is only used for screens equal or smaller than the image width set, which is 480px by default.
			 * @param (bool)|(array) $edit_args
			 * 	Arguments used by {@see beans_edit_image()}.
			 * 	Set to false to use WordPress small size.
			 */
			$edit_small_args = apply_filters('beans_edit_post_image_small_args',array(
				'resize' => array(480,FALSE),
			));

			if(empty($edit_small_args)){
				$image_small = beans_get_post_attachment($post->ID,'thumbnail');
			}
			else{
				$image_small = beans_edit_post_attachment($post->ID,$edit_small_args);
			}
		}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post_image','div',array('class' => 'tm-article-image'));

		/**
		 * @reference (WP)
		 * 	Determines whether the query is for an existing single post of any post type (post, attachment, page, custom post types).
		 * 	https://developer.wordpress.org/reference/functions/is_singular/
		*/
		if(!is_singular()){
			beans_open_markup_e('beans_post_image_link','a',array(
				/* Automatically escaped. */
				'href' => get_permalink(),
				'title' => the_title_attribute('echo=0'),
			));
		}
				beans_open_markup_e('beans_post_image_item_wrap','picture');

		if($edit){
			beans_selfclose_markup_e('beans_post_image_small_item','source',array(
				'media'  => '(max-width: ' . $image_small->width . 'px)',
				'srcset' => esc_url($image_small->src),
			),$image_small	);

			beans_selfclose_markup_e('beans_post_image_item','img',array(
				'width' => $image->width,
				'height' => $image->height,
				/* Automatically escaped. */
				'src' => $image->src,
				/* Automatically escaped. */
				'alt' => $image->alt,
				'itemprop' => 'image',
			),$image	);
		}
		else{
			/**
			 * @since 1.0.1
			 * 	Beans API isn't available, use wp_get_attachment_image_attributes filter instead.
			 * @reference (WP)
			 * 	Display the post thumbnail.
			 * 	https://developer.wordpress.org/reference/functions/the_post_thumbnail/
			*/
			the_post_thumbnail();
		}
				beans_close_markup_e('beans_post_image_item_wrap','picture');

		if(!is_singular()){
			beans_close_markup_e('beans_post_image_link','a');
		}

		beans_close_markup_e('beans_post_image','div');

	}// Method


	beans_add_smart_action('beans_post_body','beans_post_content');
	/**
	 * @access (public)
	 * 	Echo post content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_content/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_content()
	{
		global $post;

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post_content','div',array(
			'class' => 'tm-article-content',
			'itemprop' => 'text',
		));
			/**
			 * @reference (WP)
			 * 	Display the post content.
			 * 	https://developer.wordpress.org/reference/functions/the_content/
			*/
			the_content();

			/**
			 * @reference (WP)
			 * 	Determines whether the query is for an existing single post of any post type (post, attachment, page, custom post types).
			 * 	https://developer.wordpress.org/reference/functions/is_singular/
			 * 	Check a post typefs support for a given feature.
			 * 	https://developer.wordpress.org/reference/functions/post_type_supports/
			 * 	Generates and displays the RDF for the trackback information of current post.
			 * 	https://developer.wordpress.org/reference/functions/trackback_rdf/
			*/
			if(is_singular() && 'open' === get_option('default_ping_status') && post_type_supports($post->post_type,'trackbacks')){
				echo '<!--';
				trackback_rdf();
				echo '-->' . "\n";
			}
		beans_close_markup_e('beans_post_content','div');

	}// Method


	// Filter.
	beans_add_smart_action('the_content_more_link','beans_post_more_link');
	/**
	 * @access (public)
	 * 	Modify post "more link".
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_more_link/
	 * @global (WP_Post) $post
	 * 	https://codex.wordpress.org/Global_Variables
	 * @return (string)
	 * 	The modified "more link".
	*/
	function beans_post_more_link()
	{
		// WP global.
		global $post;

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_open_markup('beans_post_more_link','a',array(
			/* Automatically escaped. */
			'href'  => get_permalink(),
			'class' => 'more-link',
		));
			$output .= beans_output('beans_post_more_link_text',esc_html__('Continue reading','bex-uikit3'));

			$output .= beans_open_markup('beans_next_icon[_more_link]','span',array(
				'class' => 'uk-margin-small-left',
				'aria-hidden' => 'true',
				'uk-icon' => 'icon: angle-double-right'
			));
			$output .= beans_close_markup('beans_next_icon[_more_link]','span');

		$output .= beans_close_markup('beans_post_more_link','a');

		return $output;

	}// Method


	beans_add_smart_action('beans_post_body','beans_post_content_navigation',20);
	/**
	 * @access (public)
	 * 	Echo post content navigation.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_content_navigation/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_content_navigation()
	{
		/**
		 * @reference (WP)
		 * 	The formatted output of a list of pages.
		 * 	https://developer.wordpress.org/reference/functions/wp_link_pages/
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		echo wp_link_pages(array(
			'before' => beans_open_markup('beans_post_content_navigation','p',array('class' => 'uk-text-bold')) . beans_output('beans_post_content_navigation_text',__('Pages:','bex-uikit3')),
			'after' => beans_close_markup('beans_post_content_navigation','p'),
			'echo' => FALSE,
		));

	}// Method


	beans_add_smart_action('beans_post_body','beans_post_meta_categories',25);
	/**
	 * @access (public)
	 * 	Echo post meta categories.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_categories/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_meta_categories()
	{
		/**
		 * @reference (Beans)
		 * 	Calls function given by the first parameter and passes the remaining parameters as arguments.
		 * 	https://www.getbeans.io/code-reference/functions/beans_render_function/
		*/
		$categories = beans_render_function('do_shortcode','[beans_post_meta_categories]');
		if(!$categories){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post_meta_categories','span',array('class' => 'uk-text-small uk-text-muted'));
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Shortcode's callback handles the escaping. See beans_post_meta_categories_shortcode(). */
			echo $categories;
		beans_close_markup_e('beans_post_meta_categories','span');

	}// Method


	beans_add_smart_action('beans_post_body','beans_post_meta_tags',30);
	/**
	 * @access (public)
	 * 	Echo post meta tags.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_meta_tags/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_post_meta_tags()
	{
		/**
		 * @reference (Beans)
		 * 	Calls function given by the first parameter and passes the remaining parameters as arguments.
		 * 	https://www.getbeans.io/code-reference/functions/beans_render_function/
		*/
		$tags = beans_render_function('do_shortcode','[beans_post_meta_tags]');
		if(!$tags){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post_meta_tags','span',array('class' => 'uk-text-small uk-text-muted'));
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Shortcode's callback handles the escaping. See beans_post_meta_tags_shortcode(). */
			echo $tags;
		beans_close_markup_e('beans_post_meta_tags','span');

	}// Method


	// Filter.
	beans_add_smart_action('previous_post_link','beans_previous_post_link',10,4);
	/**
	 * @access (public)
	 * 	Modify post "previous link".
	 * 	https://www.getbeans.io/code-reference/functions/beans_previous_post_link/
	 * @param (string) $output
	 * 	"Next link" output.
	 * @param (string) $format
	 * 	Link output format.
	 * @param (string) $link
	 * 	Link permalink format.
	 * @param (int) $post
	 * 	Post ID.
	 * @return (string)
	 * 	The modified "previous link".
	*/
	function beans_previous_post_link($output,$format,$link,$post)
	{
		// Using $link won't apply wp filters, so rather strip tags the $output.
		$text = strip_tags($output);

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_open_markup('beans_previous_link[_post_navigation]','a',array(
			/* Automatically escaped. */
			'href' => get_permalink($post),
			'rel' => 'previous',
			/* Automatically escaped. */
			'title' => $post->post_title,
		));

			$output .= beans_open_markup('beans_previous_icon[_post_navigation]','span',array(
				'class' => 'uk-margin-small-right',
				'aria-hidden' => 'true',
				'uk-icon' => 'icon: angle-double-left'
			));

			$output .= beans_close_markup('beans_previous_icon[_post_navigation]','span');

			$output .= beans_output('beans_previous_text[_post_navigation]',$text);

		$output .= beans_close_markup('beans_previous_link[_post_navigation]','a');

		return $output;

	}// Method


	// Filter.
	beans_add_smart_action('next_post_link', 'beans_next_post_link',10,4);
	/**
	 * @access (public)
	 * 	Modify post "next link".
	 * 	https://www.getbeans.io/code-reference/functions/beans_next_post_link/
	 * @param (string) $output
	 * 	"Next link" output.
	 * @param (string) $format
	 * 	Link output format.
	 * @param (string) $link
	 * 	Link permalink format.
	 * @param (int) $post
	 * 	Post ID.
	 * @return (string)
	 * 	The modified "next link".
	*/
	function beans_next_post_link($output,$format,$link,$post)
	{
		// Using $link won't apply WP filters, so rather strip tags the $output.
		$text = strip_tags($output);

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_open_markup('beans_next_link[_post_navigation]','a',array(
			/* Automatically escaped. */
			'href' => get_permalink($post),
			'rel' => 'next',
			/* Automatically escaped. */
			'title' => $post->post_title,
		));

			$output .= beans_output('beans_next_text[_post_navigation]',$text);

			$output .= beans_open_markup('beans_next_icon[_post_navigation]','span',array(
				'class' => 'uk-margin-small-left',
				'aria-hidden' => 'true',
				'uk-icon' => 'icon: angle-double-right'
			));

			$output .= beans_close_markup('beans_next_icon[_post_navigation]','span');

		$output .= beans_close_markup('beans_next_link[_post_navigation]','a');

		return $output;

	}// Method


	beans_add_smart_action('beans_post_after_markup','beans_post_navigation');
	/**
	 * @access (public)
	 * 	Echo post navigation.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_navigation/
	 * @return (void)
	 * 	phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Layout mirrors HTML markup
	*/
	function beans_post_navigation()
	{
		/**
		 * @since 1.0.1
		 * 	Filter whether {@see beans_post_navigation()} should be short-circuit or not.
		 * @param (bool) $pre
		 * 	True to short-circuit, False to let the function run.
		*/
		if(apply_filters('beans_pre_post_navigation', !is_singular('post'))){return;}

		/**
		 * @reference (WP)
		 * 	Determines whether the query is for an existing attachment page.
		 * 	https://developer.wordpress.org/reference/functions/is_attachment/
		 * 	Retrieves post data given a post ID or post object.
		 * 	https://developer.wordpress.org/reference/functions/get_post/
		 * 	Retrieves the adjacent post.
		 * 	https://developer.wordpress.org/reference/functions/get_adjacent_post/
		*/
		$previous = is_attachment() ? get_post(get_post()->post_parent) : get_adjacent_post(FALSE,'',TRUE);
		$next = get_adjacent_post(FALSE,'',FALSE);

		if(!$next && !$previous){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post_navigation_nav_container','nav',array(
			'role' => 'navigation',
			/* Attributes are automatically escaped. */
			'aria-label' => __('Post Navigation','bex-uikit3'),
		));

			beans_open_markup_e('beans_post_navigation','ul',array('class' => 'uk-pagination uk-flex-center uk-flex-between uk-margin-large-top'));

			if($previous){
				beans_open_markup_e('beans_post_navigation_item[_previous]','li');
					beans_open_markup_e('beans_post_navigation_label[_previous]','span',array('class' => 'uk-pagination-previous uk-padding'));

						/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
						echo get_previous_post_link('&laquo; %link',beans_output('beans_previous_text[_post_navigation_item]',__('Previous Page','bex-uikit3')));
					beans_close_markup_e('beans_post_navigation_label[_previous]','span');
				beans_close_markup_e('beans_post_navigation_item[_previous]','li');
			}

			if($next){
				beans_open_markup_e('beans_post_navigation_item[_previous]','li');
					beans_open_markup_e('beans_post_navigation_label[_previous]','span',array('class' => 'uk-pagination-next uk-padding'));

						/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
						echo get_next_post_link('%link &raquo;',beans_output('beans_next_text[_post_navigation_item]',__('Next Page','bex-uikit3')));
					beans_close_markup_e('beans_post_navigation_label[_next]','span');
				beans_close_markup_e('beans_post_navigation_item[_next]','li');
			}
			beans_close_markup_e('beans_post_navigation','ul');

		beans_close_markup_e('beans_post_navigation_nav_container','nav');

	}// Method


	beans_add_smart_action('beans_after_posts_loop','beans_posts_pagination');
	/**
	 * @access (public)
	 * 	Echo posts pagination.
	 * 	https://www.getbeans.io/code-reference/functions/beans_posts_pagination/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_posts_pagination()
	{
		/**
		 * @since 1.0.1
		 * 	Filter whether {@see beans_posts_pagination()} should be short-circuit or not.
		 * @param (bool) $pre
		 * 	True to short-circuit, False to let the function run.
		 */
		if(apply_filters('beans_pre_post_pagination',is_singular())){return;}

		// WP global.
		global $wp_query;

		if($wp_query->max_num_pages <= 1){return;}

		/**
		 * @reference (WP)
		 * 	Retrieves the value of a query variable in the WP_Query class.
		 * 	https://developer.wordpress.org/reference/functions/get_query_var/
		 * 	Convert a value to non-negative integer.
		 * 	https://developer.wordpress.org/reference/functions/absint/
		*/
		$current = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
		$count = intval($wp_query->max_num_pages);

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_posts_pagination_nav_container','nav',	array(
			'role' => 'navigation',
			/* Attributes are automatically escaped. */
			'aria-label' => __('Posts Pagination Navigation','bex-uikit3'),
		));

			beans_open_markup_e('beans_posts_pagination','ul',array('class' => 'uk-pagination uk-flex-center uk-padding'));

			/**
			 * @since 1.0.1
			 * 	Previous.
			 * @reference (WP)
			 * 	Retrieves the previous posts page link.
			 * 	https://developer.wordpress.org/reference/functions/get_previous_posts_link/
			 * 	Displays or retrieves the previous posts page link.
			 * 	https://developer.wordpress.org/reference/functions/previous_posts/
			*/
			if(get_previous_posts_link()){
				beans_open_markup_e('beans_posts_pagination_item[_previous]','li');
					beans_open_markup_e('beans_previous_link[_posts_pagination]','a',array(
						/* Attributes are automatically escaped. */
						'href' => previous_posts(FALSE),
						),$current);

						beans_open_markup_e('beans_previous_icon[_posts_pagination]','span',array(
							'class' => 'uk-margin-small-right',
							'aria-hidden' => 'true',
							'uk-icon' => 'icon: angle-double-left'
						));

						beans_close_markup_e('beans_previous_icon[_posts_pagination]','span');

						beans_output_e('beans_previous_text[_posts_pagination]',esc_html__('Previous Page','bex-uikit3'));

					beans_close_markup_e('beans_previous_link[_posts_pagination]','a');
				beans_close_markup_e('beans_posts_pagination_item[_previous]','li');
			}

			// Links.
			foreach(range(1,(int) $wp_query->max_num_pages) as $link){
				// Skip if next is set.
				if(isset($next) && $link !== $next){
					continue;
				}
				else{
					$next = $link + 1;
				}

				$is_separator = array(
					// Not first.
					1 !== $link,
					// Force first 3 items.
					1 === $current && 3 === $link ? FALSE : TRUE,
					// More.
					$count > 3,
					// Not last.
					$count !== $link,
					// Not previous.
					($current - 1) !== $link,
					// Not current.
					$current !== $link,
					// Not next.
					($current + 1 ) !== $link,
				);

				// Separator.
				if(!in_array(false,$is_separator,TRUE)){
					beans_open_markup_e('beans_posts_pagination_item[_separator]','li');
						beans_output_e('beans_posts_pagination_item_separator_text','...');
					beans_close_markup_e('beans_posts_pagination_item[_separator]','li');

					// Jump.
					if($link < $current){
						$next = $current - 1;
					}
					elseif($link > $current){
						$next = $count;
					}
					continue;
				}

				// Integer.
				if($link === $current){
					beans_open_markup_e('beans_posts_pagination_item[_active]','li',array('class' => 'uk-active'));
						beans_open_markup_e('beans_posts_pagination_item[_active]_wrap','span');
							beans_output_e('beans_posts_pagination_item[_active]_text',$link);
						beans_close_markup_e('beans_posts_pagination_item[_active]_wrap','span');
					beans_close_markup_e('beans_posts_pagination_item[_active]','li');
				}
				else{
					beans_open_markup_e('beans_posts_pagination_item','li');
						beans_open_markup_e('beans_posts_pagination_item_link','a',array(
							/* Attributes are automatically escaped. */
							'href' => get_pagenum_link($link),
						),
						$link
					);
							beans_output_e('beans_posts_pagination_item_link_text',$link);
						beans_close_markup_e('beans_posts_pagination_item_link','a');
					beans_close_markup_e('beans_posts_pagination_item','li');
				}
			}

			/**
			 * @since 1.0.1
			 * 	Next.
			 * @reference (WP)
			 * 	Retrieves the next posts page link.
			 * 	https://developer.wordpress.org/reference/functions/get_next_posts_link/
			 * 	Displays or retrieves the next posts page link.
			 * 	https://developer.wordpress.org/reference/functions/next_posts/
			*/
			if(get_next_posts_link()){
				beans_open_markup_e('beans_posts_pagination_item[_next]','li');
					beans_open_markup_e('beans_next_link[_posts_pagination]','a',array(
						/* Attributes are automatically escaped. */
						'href' => next_posts($count,FALSE),
					),$current);
						beans_output_e('beans_next_text[_posts_pagination]',esc_html__('Next Page','bex-uikit3'));
						beans_open_markup_e('beans_next_icon[_posts_pagination]','span',array(
							'class' => 'uk-margin-small-left',
							'aria-hidden' => 'true',
							'uk-icon' => 'icon: angle-double-right'
						));
						beans_close_markup_e('beans_next_icon[_posts_pagination]','span');
					beans_close_markup_e('beans_next_link[_posts_pagination]','a');
				beans_close_markup_e('beans_posts_pagination_item[_next]','li');
			}

			beans_close_markup_e('beans_posts_pagination','ul');
		beans_close_markup_e('beans_posts_pagination_nav_container','nav');

	}// Method


	beans_add_smart_action('beans_no_post','beans_no_post');
	/**
	 * @access (public)
	 * 	Echo no post content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_no_post/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/loop.php
	*/
	function beans_no_post()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_post','article',array('class' => 'tm-no-article uk-article' . (current_theme_supports('beans-default-styling') ? ' uk-panel-box' : NULL)));
			beans_open_markup_e('beans_post_header','header');
				beans_open_markup_e('beans_post_title', 'h1',array('class' => 'uk-article-title'));
					beans_output_e('beans_no_post_article_title_text',esc_html__('Whoops, no result found!','bex-uikit3'));
				beans_close_markup_e('beans_post_title','h1');
			beans_close_markup_e('beans_post_header','header');

			beans_open_markup_e('beans_post_body','div');
				beans_open_markup_e('beans_post_content','div',array('class' => 'tm-article-content'));
					beans_open_markup_e('beans_no_post_article_content','p',array('class' => 'uk-alert uk-alert-warning'));
						beans_output_e('beans_no_post_article_content_text',esc_html__('It looks like nothing was found at this location. Maybe try a search?','bex-uikit3'));
					beans_close_markup_e('beans_no_post_article_content','p');
						/**
						 * @reference (WP)
						 * 	Display search form.
						 * 	https://developer.wordpress.org/reference/functions/get_search_form/
						*/
						beans_output_e('beans_no_post_search_form',get_search_form(FALSE));
				beans_close_markup_e('beans_post_content','div');
			beans_close_markup_e('beans_post_body','div');
		beans_close_markup_e('beans_post','article');

	}// Method


	// Filter.
	beans_add_smart_action('the_password_form','beans_post_password_form');
	/**
	 * @access (public)
	 * 	Modify password protected form.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_password_form/
	 * @return (string)
	 * 	The form.
	 */
	function beans_post_password_form()
	{
		// WP global.
		global $post;
		$label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/

		// Notice.
		$output = beans_open_markup('beans_password_form_notice','p',array('class' => 'uk-alert uk-alert-warning'));
			$output .= beans_output('beans_password_form_notice_text',esc_html__('This post is protected. To view it, enter the password below!','bex-uikit3'));
		$output .= beans_close_markup('beans_password_form_notice','p');

		// Form.
		$output .= beans_open_markup('beans_password_form','form',array(
			'class' => 'uk-form uk-margin-bottom',
			'method' => 'post',
			/* Attributes are automatically escaped. */
			'action' => home_url('wp-login.php?action=postpass','login_post'),
		));
			$output .= beans_selfclose_markup('beans_password_form_input','input',array(
				'class' => 'uk-margin-small-top uk-margin-small-right',
				'type' => 'password',
				/* Attributes are automatically escaped. */
				'placeholder' => apply_filters('beans_password_form_input_placeholder',__('Password','bex-uikit3')),
				'name' => 'post_password',
			));
			$output .= beans_selfclose_markup('beans_password_form_submit','input',array(
				'class' => 'uk-button uk-button-default uk-margin-small-top',
				'type' => 'submit',
				'name' => 'submit',
				/* Attributes are automatically escaped. */
				'value' => apply_filters('beans_password_form_submit_text',__('Submit','bex-uikit3')),
			));
		$output .= beans_close_markup('beans_password_form','form');

		return $output;

	}// Method


	// Filter.
	beans_add_smart_action('post_gallery','beans_post_gallery',10,3);
	/**
	 * @since 1.3.0
	 * 	Modify WP {@link https://codex.wordpress.org/Function_Reference/gallery_shortcode Gallery Shortcode} output.
	 * 	This implements the functionality of the Gallery Shortcode for displaying WordPress images in a post.
	 * 	https://www.getbeans.io/code-reference/functions/beans_post_gallery/
	 * @param (string) $output
	 * 	The gallery output.
	 * 	Default empty.
	 * @param (array) $attr
	 * 	Attributes of the {@link https://codex.wordpress.org/Function_Reference/gallery_shortcode gallery_shortcode()}.
	 * @param (int) $instance
	 * 	Unique numeric ID of this gallery shortcode instance.
	 * @return (string)
	 * 	HTML content to display gallery.
	*/
	function beans_post_gallery($output,$attr,$instance)
	{
		$post = get_post();
		$html5 = current_theme_supports('html5','gallery');
		$defaults = array(
			'order' => 'ASC',
			'orderby' => 'menu_order ID',
			'id' => $post ? $post->ID : 0,
			'itemtag' => $html5 ? 'figure' : 'dl',
			'icontag' => $html5 ? 'div' : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns' => 3,
			'size' => 'thumbnail',
			'include' => '',
			'exclude' => '',
			'link' => '',
		);

		/**
		 * @reference (WP)
		 * 	Combine user attributes with known attributes and fill in defaults when needed.
		 * 	https://developer.wordpress.org/reference/functions/shortcode_atts/
		*/
		$atts = shortcode_atts($defaults,$attr,'gallery');
		$id = intval($atts['id']);

		/**
		 * @since 1.0.1
		 * 	Set attachments.
		 * @reference (WP)
		 * 	Retrieves an array of the latest posts, or posts matching the given criteria.
		 * 	https://developer.wordpress.org/reference/functions/get_posts/
		*/
		if(!empty($atts['include'])){
			$_attachments = get_posts(	array(
				'include' => $atts['include'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
			));

			$attachments = array();
			foreach($_attachments as $key => $val){
				$attachments[$val->ID] = $_attachments[$key];
			}
		}

		/**
		 * @reference (WP)
		 * 	Retrieve all children of the post parent ID.
		 * 	https://developer.wordpress.org/reference/functions/get_children/
		*/
		elseif(!empty($atts['exclude'])){
			$attachments = get_children(array(
				'post_parent' => $id,
				'exclude' => $atts['exclude'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
			));
		}
		else{
			$attachments = get_children(array(
				'post_parent' => $id,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
			));
		}

		// Stop here if no attachment.
		if(empty($attachments)){
			return '';
		}

		/**
		 * @reference (WP)
		 * 	Determines whether the query is for a feed.
		 * 	https://developer.wordpress.org/reference/functions/is_feed/
		*/
		if(is_feed()){
			$output = "\n";
			foreach($attachments as $att_id => $attachment){
				/**
				 * @reference (WP)
				 * 	Retrieve an attachment page link using an image or icon, if possible.
				 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_link/
				*/
				$output .= wp_get_attachment_link($att_id,$atts['size'],TRUE) . "\n";
			}
			return $output;
		}

		/**
		 * @since 1.0.1
		 * 	Valid tags.
		 * @reference (WP)
		 * 	Returns an array of allowed HTML tags and attributes for a given context.
		 * 	https://developer.wordpress.org/reference/functions/wp_kses_allowed_html/
		*/
		$valid_tags = wp_kses_allowed_html('post');
		$validate = array(
			'itemtag',
			'captiontag',
			'icontag',
		);

		// Validate tags.
		foreach($validate as $tag){
			if(!isset($valid_tags[$atts[$tag]])){
				$atts[$tag] = $defaults[$tag];
			}
		}

		/**
		 * @since 1.0.1
		 * 	Set variables used in the output.
		 * @reference (WP)
		 * 	Sanitizes an HTML classname to ensure it only contains valid characters.
		 * 	https://developer.wordpress.org/reference/functions/sanitize_html_class/
		*/
		$columns = intval($atts['columns']);
		$size_class = sanitize_html_class($atts['size']);

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/

		// WP adds the opening div in the gallery_style filter (weird), so we follow it as we don't want to break people's site.
		$gallery_div = beans_open_markup("beans_post_gallery[_{$id}]",'div',array(
			/* Attributes are automatically escaped. */
			'class' => "uk-grid uk-grid-width-small-1-{$columns} gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}",
			'data-uk-grid-margin' => FALSE,
		),$id,$columns);

		/**
		 * @ignore
		 * 	Apply WP core filter. Filter the default gallery shortcode CSS styles.
		 * 	Documented in WordPress.
		*/

		/* phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Used in function scope. */
		$output = apply_filters('gallery_style',$gallery_div);

		$i = 0;
		foreach($attachments as $attachment_id => $attachment){
			$attr = (trim($attachment->post_excerpt)) ? array('aria-describedby' => "gallery-{$instance}-{$id}") : '';
			/**
			 * @reference (WP)
			 * 	Retrieves attachment metadata for attachment ID.
			 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_metadata/
			*/
			$image_meta = wp_get_attachment_metadata($attachment_id);
			$orientation = '';

			if(isset($image_meta['height'],$image_meta['width'])){
				$orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';
			}

			/**
			 * @since 1.0.1
			 * 	Set the image output.
			 * @reference (WP)
			 * 	Get an HTML img element representing an image attachment.
			 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
			 * 	Retrieve an attachment page link using an image or icon, if possible.
			 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_link/
			*/
			if('none' === $atts['link']){
				$image_output = wp_get_attachment_image($attachment_id,$atts['size'],FALSE,$attr);
			}
			else{
				$image_output = wp_get_attachment_link($attachment_id,$atts['size'],('file' !== $atts['link']),FALSE,FALSE,$attr);
			}

			$output .= beans_open_markup("beans_post_gallery_item[_{$attachment_id}]",$atts['itemtag'],array('class' => 'gallery-item'));

			/* Attributes are automatically escaped. */
			$output .= beans_open_markup("beans_post_gallery_icon[_{$attachment_id}]",$atts['icontag'],array('class' => "gallery-icon {$orientation}"));

			$output .= beans_output("beans_post_gallery_icon[_{$attachment_id}]",$image_output,$attachment_id,$atts);

			$output .= beans_close_markup("beans_post_gallery_icon[_{$attachment_id}]",$atts['icontag']);

			if($atts['captiontag'] && trim($attachment->post_excerpt)){
				$output .= beans_open_markup("beans_post_gallery_caption[_{$attachment_id}]",$atts['captiontag'],array('class' => 'wp-caption-text gallery-caption'));
				/**
				 * @reference (WP)
				 * 	Replaces common plain text characters with formatted entities.
				 * 	https://developer.wordpress.org/reference/functions/wptexturize/
				*/
				$output .= beans_output("beans_post_gallery_caption_text[_{$attachment_id}]",wptexturize($attachment->post_excerpt));
				$output .= beans_close_markup("beans_post_gallery_caption[_{$attachment_id}]",$atts['captiontag']);
			}
			$output .= beans_close_markup("beans_post_gallery_item[_{$attachment_id}]",$atts['itemtag']);
		}

		$output .= beans_close_markup("beans_post_gallery[_{$id}]",'div');

		return $output;

	}// Method
