<?php
/**
 * Echo the structural markup for each comment.
 * It also calls the comment action hooks.
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
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/
	beans_open_markup_e('beans_comment','article',array(
		/* Automatically escaped. */
		'id' => 'div-comment-' . get_comment_ID(),
		'class' => 'uk-comment uk-flex',
		'itemprop' => 'comment',
		'itemscope' => 'itemscope',
		'itemtype' => 'https://schema.org/Comment',
	));
		beans_open_markup_e('beans_comment_header','header',array('class' => 'uk-comment-header uk-padding-small uk-padding-remove-bottom'));
			/**
			 * @reference (Beans)
			 * 	Fires in the comment header.
			 * 	https://www.getbeans.io/code-reference/hooks/beans_comment_header/
			*/
			do_action('beans_comment_header');

		beans_close_markup_e('beans_comment_header','header');

		beans_open_markup_e('beans_comment_body','div',array(
			'class' => 'uk-comment-body uk-padding-small uk-padding-remove-bottom',
			'itemprop' => 'text',
		));
			/**
			 * @reference (Beans)
			 * 	Fires in the comment body.
			 * 	https://www.getbeans.io/code-reference/hooks/beans_comment_content/
			*/
			do_action('beans_comment_content');

		beans_close_markup_e('beans_comment_body','div');

	beans_close_markup_e('beans_comment','article');

	/* phpcs:ignore Generic.WhiteSpace.ScopeIndent.Incorrect -- Code structure mirrors HTML markup. */
