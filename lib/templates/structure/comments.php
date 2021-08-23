<?php
/**
 * Echo the structural markup that wraps around comments.
 * It also calls the comments action hooks.
 * This template will return empty if the post which is called is password protected.
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
	 * 	Stop here if the post is password protected.
	 * @reference (WP)
	 * 	Whether post requires password and correct password has been provided.
	 * 	https://developer.wordpress.org/reference/functions/post_password_required/
	*/
	if(post_password_required()){return;}

	/**
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/
	beans_open_markup_e('beans_comments','div',array(
		'id' => 'comments',
		'class' => 'tm-comments uk-padding uk-margin-small',
	));
		/* phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Code structure mirrors HTML markup. */
		if(comments_open() || get_comments_number()){

			/**
			 * @reference (WP)
			 * 	Determines whether current WordPress query has comments to loop over.
			 * 	https://developer.wordpress.org/reference/functions/have_comments/
			*/
			if(have_comments()){
				beans_open_markup_e('beans_comments_list','ol',array('class' => 'uk-comment-list'));
					/**
					 * @reference (WP)
					 * 	Displays a list of comments.
					 * 	https://developer.wordpress.org/reference/functions/wp_list_comments/
					*/
					wp_list_comments(array(
						'avatar_size' => 50,
						'callback' => 'beans_comment_callback',
					));
				beans_close_markup_e('beans_comments_list','ol');
			}
			else{
				/**
				 * @reference (Beans)
				 * 	Fires if no comments exist.
				 * 	This hook only fires if comments are open.
				 * 	https://www.getbeans.io/code-reference/hooks/beans_no_comment/
				*/
				do_action('beans_no_comment');
			}

			/**
			 * @reference (Beans)
			 * 	Fires after the comments list.
			 * 	This hook only fires if comments are open.
			 * 	https://www.getbeans.io/code-reference/hooks/beans_after_open_comments/
			*/
			do_action('beans_after_open_comments');
		}

		/**
		 * @reference (WP)
		 * 	Determines whether the current post is open for comments.
		 * 	https://developer.wordpress.org/reference/functions/comments_open/
		*/
		if(!comments_open()){
			/**
			 * @reference (Beans)
			 * 	Fires if comments are closed.
			 * 	https://www.getbeans.io/code-reference/hooks/beans_comments_closed/
			*/
			do_action('beans_comments_closed');
		}

	beans_close_markup_e('beans_comments','div');

	/* phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Code structure mirrors HTML markup. */
