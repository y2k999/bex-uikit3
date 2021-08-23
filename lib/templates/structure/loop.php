<?php
/**
 * Echo the posts loop structural markup. It also calls the loop action hooks.
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
	 * 	Fires before the loop.
	 * 	This hook fires even if no post exists.
	 * 	https://www.getbeans.io/code-reference/hooks/beans_before_loop/
	*/
	do_action('beans_before_loop');

	/* phpcs:disable Generic.WhiteSpace.ScopeIndent -- Code structure mirrors HTML markup. */
	if(have_posts() && !is_404()){

		/**
		 * @reference (Beans)
		 * 	Fires before posts loop.
		 * 	This hook fires if posts exist.
		 * 	https://www.getbeans.io/code-reference/hooks/beans_before_posts_loop/
		*/
		do_action('beans_before_posts_loop');

		/**
		 * @reference (WP)
		 * 	Determines whether current WordPress query has posts to loop over.
		 * 	https://developer.wordpress.org/reference/functions/have_posts/
		 * 	Iterate the post index in the loop.
		 * 	https://developer.wordpress.org/reference/functions/the_post/
		*/
		while(have_posts()) :	the_post();
			/* phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Variable called in a function scope. */
			$article_attributes = array(
				/* Automatically escaped. */
				'id' => get_the_ID(),
				/* Automatically escaped. */
				'class' => implode(' ',get_post_class(array('uk-article','uk-padding-small',(current_theme_supports('beans-default-styling') ? 'uk-panel-box' : NULL)))),
				'itemscope' => 'itemscope',
				'itemtype' => 'https://schema.org/CreativeWork',
			);

			/**
			 * @since 1.0.1
			 * 	Blog specifc attributes.
			 * @reference (WP)
			 * 	Retrieves the post type of the current post or of a given post.
			 * 	https://developer.wordpress.org/reference/functions/get_post_type/
			*/
			if('post' === get_post_type()){
				$article_attributes['itemtype'] = 'https://schema.org/BlogPosting';
				/**
				 * @since 1.0.1
				 * 	Only add to blogPost attribute to the main query.
				 * @reference (WP)
				 * 	Determines whether the query is the main query.
				 * 	https://developer.wordpress.org/reference/functions/is_main_query/
				 * 	Determines whether the query is for a search.
				 * 	https://developer.wordpress.org/reference/functions/is_search/
				*/
				if(is_main_query() && !is_search()){
					$article_attributes['itemprop'] = 'blogPost';
				}
			}

			/* phpcs:enable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound */

			/**
			 * @reference (Beans)
			 * 	HTML markup.
			 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
			 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
			*/
			beans_open_markup_e('beans_post','article',$article_attributes);
				beans_open_markup_e('beans_post_header','header',array(
					'class' => 'uk-article-header'
				));
					/**
					 * @reference (Beans)
					 * 	Fires in the post header.
					 * 	https://www.getbeans.io/code-reference/hooks/beans_post_header/
					*/
					do_action('beans_post_header');
				beans_close_markup_e('beans_post_header','header');

				beans_open_markup_e('beans_post_body','div',array('itemprop' => 'articleBody'));
					/**
					 * @reference (Beans)
					 * 	Fires in the post body.
					 * 	https://www.getbeans.io/code-reference/hooks/beans_post_body/
					*/
					do_action('beans_post_body');
				beans_close_markup_e('beans_post_body','div');
			beans_close_markup_e('beans_post','article');
		endwhile;

		/**
		 * @reference (Beans)
		 * 	Fires after the posts loop.
		 * 	This hook fires if posts exist.
		 * 	https://www.getbeans.io/code-reference/hooks/beans_after_posts_loop/
		*/
		do_action('beans_after_posts_loop');
	}
	else{
		/**
		 * @reference (Beans)
		 * 	Fires if no posts exist.
		 * 	https://www.getbeans.io/code-reference/hooks/beans_no_post/
		*/
		do_action('beans_no_post');
	}


	/**
	 * @reference (Beans)
	 * 	Fires after the loop.
	 * 	This hook fires even if no post exists.
	 * 	https://www.getbeans.io/code-reference/hooks/beans_after_loop/
	*/
	do_action('beans_after_loop');

	/* phpcs:enable Generic.WhiteSpace.ScopeIndent -- Code structure mirrors HTML markup. */
