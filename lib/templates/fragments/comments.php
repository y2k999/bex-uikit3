<?php
/**
 * Echo comments fragments.
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


	beans_add_smart_action('beans_comments_list_before_markup','beans_comments_title');
	/**
	 * @access (public)
	 * 	Echo the comments title.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comments_title/
	 * @return (void)
	 * @reference
	 * [Theme]/lib/templates/structure/comments.php
	*/
	function beans_comments_title()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_comments_title','h4',array(
			'class' => 'uk-heading-divider uk-text-large uk-text-center',
		));
			beans_output_e('beans_comments_title_text',sprintf(
				/* translators: Number of comments, one or many. */
				_n('%s Comment to this Article','%s Comments to this Article',get_comments_number(),'bex-uikit3'),
				/**
				 * @reference (WP)
				 * 	Convert float number to format based on the locale.
				 * 	https://developer.wordpress.org/reference/functions/number_format_i18n/
				 * 	Retrieves the amount of comments a post has.
				 * 	https://developer.wordpress.org/reference/functions/get_comments_number/
				*/
				number_format_i18n(get_comments_number())
			));
		beans_close_markup_e('beans_comments_title','h4');

	}// Method


	beans_add_smart_action('beans_comment_title_append_markup','beans_comment_badges');
	/**
	 * @access (public)
	 * 	Echo the comment badges.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_badges/
	 * @return(void)
	*/
	function beans_comment_badges()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/

		// WP global.
		global $comment;

		// Trackback badge.
		if('trackback' === $comment->comment_type){
			beans_open_markup_e('beans_trackback_badge','span',array('class' => 'uk-badge uk-margin-small-left'));
				beans_output_e('beans_trackback_text',esc_html__('Trackback','bex-uikit3'));
			beans_close_markup_e('beans_trackback_badge','span');
		}

		// Pindback badge.
		if('pingback' === $comment->comment_type){
			beans_open_markup_e('beans_pingback_badge','span',array('class' => 'uk-badge uk-margin-small-left'));
				beans_output_e('beans_pingback_text',esc_html__('Pingback','bex-uikit3'));
			beans_close_markup_e('beans_pingback_badge','span');
		}

		// Moderation badge.
		if('0' === $comment->comment_approved){
			beans_open_markup_e('beans_moderation_badge','span',array('class' => 'uk-badge uk-margin-small-left uk-badge-warning'));
				beans_output_e('beans_moderation_text',esc_html__('Awaiting Moderation','bex-uikit3'));
			beans_close_markup_e('beans_moderation_badge','span');
		}

		/**
		 * @since 1.0.1
		 * 	Moderator badge.
		 * @reference (WP)
		 * 	Returns whether a particular user has the specified capability.
		 * 	https://developer.wordpress.org/reference/functions/user_can/
		*/
		if(user_can($comment->user_id,'moderate_comments')){
			beans_open_markup_e('beans_moderator_badge','span',array('class' => 'uk-badge uk-margin-small-left'));
				beans_output_e('beans_moderator_text',esc_html__('Moderator','bex-uikit3'));
			beans_close_markup_e('beans_moderator_badge','span');
		}

	}// Method


	beans_add_smart_action('beans_comment_header','beans_comment_avatar',5);
	/**
	 * @access (public)
	 * 	Echo the comment avatar.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_avatar/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comment.php
	*/
	function beans_comment_avatar()
	{
		// WP global.
		global $comment;

		/**
		 * @reference (WP)
		 * 	Retrieve the avatar <img> tag for a user, email address, MD5 hash, comment, or post.
		 * 	https://developer.wordpress.org/reference/functions/get_avatar/
		*/
		$avatar = get_avatar($comment,$comment->args['avatar_size']);

		// Stop here if no avatar.
		if(!$avatar){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_comment_avatar','div',array('class' => 'uk-comment-avatar'));
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes get_avatar(). */
			echo $avatar;
		beans_close_markup_e('beans_comment_avatar','div');

	}// Method


	beans_add_smart_action('beans_comment_header','beans_comment_author');
	/**
	 * @access (public)
	 * 	Echo the comment author title.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_author/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comment.php
	*/
	function beans_comment_author()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_comment_title',	'div',array(
			'class' => 'uk-comment-title',
			'itemprop' => 'author',
			'itemscope' => 'itemscope',
			'itemtype' => 'https://schema.org/Person',
		));
			/**
			 * @reference (WP)
			 * 	Retrieves the HTML link to the URL of the author of the current comment.
			 * 	https://developer.wordpress.org/reference/functions/get_comment_author_link/
			*/
			echo get_comment_author_link();
		beans_close_markup_e('beans_comment_title','div');

	}// Method


	beans_add_smart_action('beans_comment_header','beans_comment_metadata',15);
	/**
	 * @access (public)
	 * 	Echo the comment metadata.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_metadata/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comment.php
	*/
	function beans_comment_metadata()
	{
		/**
		 * @reference (WP)
		 * 	Retrieves the comment date of the current comment.
		 * 	https://developer.wordpress.org/reference/functions/get_comment_date/
		 * 	Retrieves the comment time of the current comment.
		 * 	https://developer.wordpress.org/reference/functions/get_comment_time/
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_comment_meta','div',array('class' => 'uk-comment-meta'));
			beans_open_markup_e('beans_comment_time','time',array(
				'datetime' => get_comment_time('c'),
				'itemprop' => 'datePublished',
			));
				beans_output_e('beans_comment_time_text',sprintf(
					/* translators: Date of the comment, time of the comment. */
					_x('%1$s at %2$s','1: date,2: time','bex-uikit3'),
					get_comment_date(),
					get_comment_time()
				));
			beans_close_markup_e('beans_comment_time','time');
		beans_close_markup_e('beans_comment_meta','div');

	}// Method


	beans_add_smart_action('beans_comment_content','beans_comment_content');
	/**
	 * @access (public)
	 * 	Echo the comment content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_content/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comment.php
	*/
	function beans_comment_content()
	{
		/**
		 * @reference (Beans)
		 * 	Echo output registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	Calls function given by the first parameter and passes the remaining parameters as arguments.
		 * 	https://www.getbeans.io/code-reference/functions/beans_render_function/
		*/
		beans_output_e('beans_comment_content',beans_render_function('comment_text'));

	}// Method


	beans_add_smart_action('beans_comment_content','beans_comment_links',15);
	/**
	 * @access (public)
			Echo the comment links.
			https://www.getbeans.io/code-reference/functions/beans_comment_links/
		@return (void)
		@reference
			[Theme]/lib/templates/structure/comment.php
	*/
	function beans_comment_links()
	{
		// WP global.
		global $comment;

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		beans_open_markup_e('beans_comment_links', 'ul',array('class' => 'tm-comment-links uk-flex uk-subnav-divider'));

			// Reply.
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
			echo get_comment_reply_link(array_merge($comment->args,array(
				'add_below' => 'comment-content',
				'depth' => $comment->depth,
				'max_depth' => $comment->args['max_depth'],
				'before' => beans_open_markup('beans_comment_item[_reply]','li'),
				'after' => beans_close_markup('beans_comment_item[_reply]','li'),
			)));

		/**
		 * @since 1.0.1
		 * 	Edit.
		 * @reference (WP)
		 * 	Returns whether the current user has the specified capability.
		 * 	https://developer.wordpress.org/reference/functions/current_user_can/
		 * 	Retrieves the edit comment link.
		 * 	https://developer.wordpress.org/reference/functions/get_edit_comment_link/
		*/
		if(current_user_can('moderate_comments')){
			beans_open_markup_e('beans_comment_item[_edit]','li');
				beans_open_markup_e('beans_comment_item_link[_edit]','a',array(
					/* Automatically escaped. */
					'href' => get_edit_comment_link($comment->comment_ID),
				));
					beans_output_e('beans_comment_edit_text',esc_html__('Edit','bex-uikit3'));
				beans_close_markup_e('beans_comment_item_link[_edit]','a');
			beans_close_markup_e('beans_comment_item[_edit]','li');
		}

			/**
			 * @since 1.0.1
			 * 	Link.
			 * @reference (WP)
			 * 	Retrieves the link to a given comment.
			 * 	https://developer.wordpress.org/reference/functions/get_comment_link/
			*/
			beans_open_markup_e('beans_comment_item[_link]','li');

				beans_open_markup_e('beans_comment_item_link[_link]','a',array(
					/* Automatically escaped. */
					'href' => get_comment_link($comment->comment_ID),
				));
					beans_output_e('beans_comment_link_text',esc_html__('Link','bex-uikit3'));

				beans_close_markup_e('beans_comment_item_link[_link]','a');
			beans_close_markup_e('beans_comment_item[_link]','li');
		beans_close_markup_e('beans_comment_links','ul');

	}// Method


	/**
	 * @access (public)
	 * 	Echo no comment content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_no_comment/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comments.php
	*/
	beans_add_smart_action('beans_no_comment','beans_no_comment');
	function beans_no_comment()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_no_comment','p','class=uk-text-muted');
			beans_output_e('beans_no_comment_text',esc_html__('No comment yet, add your voice below!','bex-uikit3'));
		beans_close_markup_e('beans_no_comment','p');

	}// Method


	/**
	 * @access (public)
	 * 	Echo closed comments content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comments_closed/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comments.php
	*/
	beans_add_smart_action('beans_comments_closed','beans_comments_closed');
	function beans_comments_closed()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_comments_closed','p',array('class' => 'uk-alert-warning uk-margin-bottom-remove'));
			beans_output_e('beans_comments_closed_text',esc_html__('Comments are closed for this article!','bex-uikit3'));
		beans_close_markup_e('beans_comments_closed','p');

	}// Method


	beans_add_smart_action('beans_comments_list_after_markup','beans_comments_navigation');
	/**
	 * @access (public)
	 * 	Echo comments navigation.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comments_navigation/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comments.php
	*/
	function beans_comments_navigation()
	{
		/**
		 * @reference (WP)
		 * 	Calculate the total number of comment pages.
		 * 	https://developer.wordpress.org/reference/functions/get_comment_pages_count/
		*/
		if(get_comment_pages_count() <= 1 && !get_option('page_comments')){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/

		/* phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Layout mirrors HTML markup. */
		beans_open_markup_e('beans_comments_navigation_nav_container','nav',array(
			'role' => 'navigation',
			'aria-label' => esc_attr__('Comments Pagination Navigation','bex-uikit3'),
		));

			beans_open_markup_e('beans_comments_navigation','ul',array(
				'class' => 'uk-pagination uk-flex-center',
			));

			/**
			 * @since 1.0.1
			 * 	Previous.
			 * @reference (Beans)
			 * 	Retrieves the link to the previous comments page.
			 * 	https://developer.wordpress.org/reference/functions/get_previous_comments_link/
			*/
			if(get_previous_comments_link()){
				beans_open_markup_e('beans_comments_navigation_item[_previous]','li',array('class' => 'uk-pagination-previous'));

					$previous_icon = beans_open_markup('beans_previous_icon[_comments_navigation]','span',array(
						'uk-icon' => 'icon: chevron-double-left',
						'class' => 'uk-margin-small-left',
						'aria-hidden' => 'true',
					));
					$previous_icon .= beans_close_markup('beans_previous_icon[_comments_navigation]','span');

					/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
					echo get_previous_comments_link(
						$previous_icon . beans_output('beans_previous_text[_comments_navigation]',__('Previous Comments','bex-uikit3'))
					);
				beans_close_markup_e( 'beans_comments_navigation_item[_previous]','li');
			}

			/**
			 * @since 1.0.1
			 * 	Next.
			 * @reference (Beans)
			 * 	Retrieves the link to the next comments page.
			 * 	https://developer.wordpress.org/reference/functions/get_next_comments_link/
			*/
			if(get_next_comments_link()){
				beans_open_markup_e('beans_comments_navigation_item[_next]','li',array('class' => 'uk-pagination-next'));

					$next_icon  = beans_open_markup('beans_next_icon[_comments_navigation]','span',array(
						'uk-icon' => 'icon: chevron-double-right',
						'class' => 'uk-margin-small-right',
						'aria-hidden' => 'true',
					));
					$next_icon .= beans_close_markup('beans_next_icon[_comments_navigation]','span');

					/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
					echo get_next_comments_link(
						beans_output('beans_next_text[_comments_navigation]',__('Next Comments ','bex-uikit3')) . $next_icon
					);
				beans_close_markup_e('beans_comments_navigation_item_[_next]','li');
			}
			beans_close_markup_e('beans_comments_navigation','ul');
		beans_close_markup_e('beans_comments_navigation_nav_container','nav');

	}// Method


	beans_add_smart_action('beans_after_open_comments','beans_comment_form_divider');
	/**
	 * @access (public)
	 * 	Echo comment divider.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_form_divider/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comments.php
	*/
	function beans_comment_form_divider()
	{
		/**
		 * @reference (Beans)
		 * 	Echo self-close markup and attributes registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup_e/
		*/
		beans_selfclose_markup_e('beans_comment_form_divider','hr',array('class' => 'uk-divider-icon'));

	}// Method


	beans_add_smart_action('beans_after_open_comments','beans_comment_form');
	/**
	 * @access (public)
	 * 	Echo comment form.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_form/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/comments.php
	*/
	function beans_comment_form()
	{
		/**
		 * @reference (Beans)
		 * 	Calls function given by the first parameter and passes the remaining parameters as arguments.
		 * 	https://www.getbeans.io/code-reference/functions/beans_render_function/
		 * 	HTML markup
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_render_function('comment_form',array('title_reply' => beans_output('beans_comment_form_title_text',__('Add a Comment','bex-uikit3'))));

		$submit = beans_open_markup('beans_comment_form_submit','button',array(
			'class' => 'uk-button uk-button-primary uk-width-1-1@m',
			'type' => 'submit',
		));
			$submit .= beans_output('beans_comment_form_submit_text',esc_html__('Post Comment','bex-uikit3'));
		$submit .= beans_close_markup('beans_comment_form_submit','button');

		// WordPress, please make it easier for us.
		/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Escaped above or as an attribute. */
		echo preg_replace('#<input[^>]+type="submit"[^>]+>#',$submit,$output);

	}// Method


	// Filter.
	beans_add_smart_action('cancel_comment_reply_link','beans_comment_cancel_reply_link',10,3);
	/**
	 * @access (public)
	 * 	Echo comment cancel reply link.
	 * 	This function replaces the default WordPress comment cancel reply link.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_cancel_reply_link/
	 * @param (string) $html
	 * 	HTML.
	 * @param (string) $link
	 * 	Cancel reply link.
	 * @param (string) $text
	 * 	Text to output.
	 * @return (string)
	*/
	function beans_comment_cancel_reply_link($html,$link,$text)
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_open_markup('beans_comment_cancel_reply_link','a',array(
			'rel' => 'nofollow',
			'id' => 'cancel-comment-reply-link',
			'class' => 'uk-button uk-button-danger uk-button-small uk-margin-small-right',
			/* phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification -- Used to determine inline style. */
			'style' => isset($_GET['replytocom']) ? '' : 'display: none;',
			/* Automatically escaped. */
			'href' => $link,
		));
			$output .= beans_output('beans_comment_cancel_reply_link_text',$text);

		$output .= beans_close_markup('beans_comment_cancel_reply_link','a');

		return $output;

	}// Method


	// Filter.
	beans_add_smart_action('comment_form_field_comment','beans_comment_form_comment');
	/**
	 * @access (public)
	 * 	Echo comment textarea field.
	 * 	This function replaces the default WordPress comment textarea field.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_form_comment/
	 * @return (string)
	*/
	function beans_comment_form_comment()
	{
		/**
		 * @reference (Beans)
		 * 	Call the functions added to a filter hook.
		 * 	https://www.getbeans.io/code-reference/functions/beans_apply_filters/
		 * 	HTML markup
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$output = beans_open_markup('beans_comment_form[_comment]','fieldset',array('class' => 'uk-fieldset uk-margin-small uk-padding-small'));

		/**
		 * @since 1.0.1
		 * 	Filter whether the comment form textarea legend should load or not.
		*/
		if(beans_apply_filters('beans_comment_form_legend[_comment]',FALSE)){
			$output .= beans_open_markup('beans_comment_form_legend[_comment]','legend');
			$output .= beans_output('beans_comment_form_legend_text[_comment]',esc_html__('Comment *','bex-uikit3'));
			$output .= beans_close_markup('beans_comment_form_legend[_comment]','legend');
		}

		$output .= beans_open_markup('beans_comment_form_field[_comment]','textarea',array(
			'id' => 'comment',
			'class' => 'uk-width-1-1@m',
			'name' => 'comment',
			'required' => '',
			'rows' => 8,
		));
		$output .= beans_close_markup('beans_comment_form_field[_comment]','textarea');

		$output .= beans_close_markup('beans_comment_form[_comment]','fieldset');

		return $output;

	}// Method


	beans_add_smart_action('comment_form_before_fields','beans_comment_before_fields',9999);
	/**
	 * @access (public)
	 * 	Echo comment fields opening wraps.
	 * 	This function must be attached to the WordPress 'comment_form_before_fields' action which is only called if the user is not logged in.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_before_fields/
	 * @return (void)
	 */
	function beans_comment_before_fields()
	{
		/**
		 * @reference (Beans)
		 * 	Echo open markup and attributes registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		*/
		beans_open_markup_e('beans_comment_fields_wrap','div',array('class' => ''));
			beans_open_markup_e('beans_comment_fields_inner_wrap','div',array(
				'class' => 'uk-grid-collapse',
				'uk-grid' => '',
			));

	}// Method


	// Filter.
	beans_add_smart_action('comment_form_default_fields','beans_comment_form_fields');
	/**
	 * @access (public)
	 * 	Modify comment form fields.
	 * 	This function replaces the default WordPress comment fields.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_form_fields/
	 * @param (array) $fields
	 * 	The WordPress default fields.
	 * @return (array)
	 * 	The modified fields.
	 */
	function beans_comment_form_fields($fields)
	{
		/**
		 * @reference (WP)
		 * 	Get current commenterfs name, email, and URL.
		 * 	https://developer.wordpress.org/reference/functions/wp_get_current_commenter/
		*/
		$commenter = wp_get_current_commenter();
		$grid = count((array) $fields);

		/**
		 * @reference (Beans)
		 * 	Call the functions added to a filter hook.
		 * 	https://www.getbeans.io/code-reference/functions/beans_apply_filters/
		 * 	HTML markup
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup/
		*/

		// Author.
		if(isset($fields['author'])){
			$author = beans_open_markup('beans_comment_form[_name]','div',array('class' => "uk-width-1-$grid@m"));
			/**
			 * @since 1.0.1
			 * 	Filter whether the comment form name legend should load or not.
			 */
			if(beans_apply_filters('beans_comment_form_legend[_name]',TRUE)){
				$author .= beans_open_markup('beans_comment_form_legend[_name]','legend');
				$author .= beans_output('beans_comment_form_legend_text[_name]',esc_html__('Name *','bex-uikit3'));
				$author .= beans_close_markup('beans_comment_form_legend[_name]','legend');
			}
				$author .= beans_selfclose_markup('beans_comment_form_field[_name]','input',array(
					'id' => 'author',
					'class' => 'uk-width-1-1@m',
					'type' => 'text',
					/* Automatically escaped. */
					'value' => $commenter['comment_author'],
					'name' => 'author',
					'required' => 'required',
				));
			$author .= beans_close_markup('beans_comment_form[_name]','div');

			$fields['author'] = $author;
		}

		// Email.
		if(isset( $fields['email'])){
			$email = beans_open_markup('beans_comment_form[_email]','div',array('class' => "uk-width-1-$grid@m"));
			/**
			 * @since 1.0.1
			 * 	Filter whether the comment form email legend should load or not.
			 * @reference (Beans)
			 * 	Call the functions added to a filter hook.
			 * 	https://www.getbeans.io/code-reference/functions/beans_apply_filters/
			*/
			if(beans_apply_filters('beans_comment_form_legend[_email]',TRUE)){
				$email .= beans_open_markup('beans_comment_form_legend[_email]','legend');
				$email .= beans_output('beans_comment_form_legend_text[_email]',sprintf(
					/* translators: Whether or not submitting an email address is required. */
					__('Email %s','bex-uikit3'),
					(get_option('require_name_email') ? ' *' : '')
				));
				$email .= beans_close_markup('beans_comment_form_legend[_email]','legend');
			}

			$email .= beans_selfclose_markup('beans_comment_form_field[_email]','input',array(
				'id' => 'email',
				'class' => 'uk-width-1-1@m',
				'type' => 'text',
				/* Automatically escaped. */
				'value' => $commenter['comment_author_email'],
				'name' => 'email',
				'required' => get_option('require_name_email') ? 'required' : NULL,
			));
			$email .= beans_close_markup('beans_comment_form[_email]','div');

			$fields['email'] = $email;
		}

		// Url.
		if(isset( $fields['url'])){
			$url = beans_open_markup('beans_comment_form[_website]','div',array('class' => "uk-width-1-$grid@m"));

			/**
			 * @since 1.0.1
			 * 	Filter whether the comment form url legend should load or not.
			 * @reference (Beans)
			 * 	Call the functions added to a filter hook.
			 * 	https://www.getbeans.io/code-reference/functions/beans_apply_filters/
			*/
			if(beans_apply_filters('beans_comment_form_legend[_url]',TRUE)){
				$url .= beans_open_markup('beans_comment_form_legend','legend');
				$url .= beans_output('beans_comment_form_legend_text[_url]',esc_html__('Website','bex-uikit3'));
				$url .= beans_close_markup('beans_comment_form_legend[_url]','legend');
			}

			$url .= beans_selfclose_markup('beans_comment_form_field[_url]','input',array(
				'id' => 'url',
				'class' => 'uk-width-1-1@m',
				'type' => 'text',
				/* Automatically escaped. */
				'value' => $commenter['comment_author_url'],
				'name' => 'url',
			));
			$url .= beans_close_markup('beans_comment_form[_website]','div');

			$fields['url'] = $url;
		}

		return $fields;

	}// Method


	beans_add_smart_action('comment_form_after_fields','beans_comment_form_after_fields',3);
	/**
	 * @access (public)
	 * 	Echo comment fields closing wraps.
	 * 	This function must be attached to the WordPress 'comment_form_after_fields' action which is only called if the user is not logged in.
	 * 	https://www.getbeans.io/code-reference/functions/beans_comment_form_after_fields/
	 * @return (void)
	 */
	function beans_comment_form_after_fields()
	{
		/**
		 * @reference (Beans)
		 * 	Echo close markup registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_close_markup_e('beans_comment_fields_inner_wrap','div');
		beans_close_markup_e('beans_comment_fields_wrap','div');

	}// Method
