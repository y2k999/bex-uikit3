<?php
/**
 * Echo breadcrumb fragment.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/

	/**
	 * @access (public)
	 * 	Echo the breadcrumb.
	 * 	https://www.getbeans.io/code-reference/functions/beans_breadcrumb/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header.php
	*/
	beans_add_smart_action('beans_main_grid_before_markup','beans_breadcrumb');
	function beans_breadcrumb()
	{
		/**
		 * @reference (WP)
		 * 	Determines whether the query is for the blog homepage.
		 * 	https://developer.wordpress.org/reference/functions/is_home/
		 * 	Determines whether the query is for the front page of the site.
		 * 	https://developer.wordpress.org/reference/functions/is_front_page/
		*/
		if(is_home() || is_front_page()){return;}

		/* phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query -- Ensure the main query has been reset to the original main query. */
		wp_reset_query();

		// WP global.
		global $post;

		/**
		 * @reference (WP)
		 * 	Retrieves the post type of the current post or of a given post.
		 * 	https://developer.wordpress.org/reference/functions/get_post_type/
		*/
		$post_type = get_post_type();
		$breadcrumbs = array();
		$breadcrumbs[home_url()] = __('Home','bex-uikit3');

		// Custom post type.
		if(!in_array($post_type, array('page','attachment','post'),TRUE) && !is_404()){

			/**
			 * @reference (WP)
			 * 	Retrieves a post type object by name.
			 * 	https://developer.wordpress.org/reference/functions/get_post_type_object/
			*/
			$post_type_object = get_post_type_object($post_type);

			if($post_type_object){
				/**
				 * @reference (WP)
				 * 	Retrieves the permalink for a post type archive.
				 * 	https://developer.wordpress.org/reference/functions/get_post_type_archive_link/
				*/
				$breadcrumbs[get_post_type_archive_link($post_type)] = $post_type_object->labels->name;
			}
		}

		/**
		 * @since 1.0.1
		 * 	Single posts.
		 * @reference (WP)
		 * 	Determines whether the query is for an existing single post.
		 * 	https://developer.wordpress.org/reference/functions/is_single/
		*/
		if(is_single() && 'post' === $post_type){
			/**
			 * @reference (WP)
			 * 	Retrieves post categories.
			 * 	https://developer.wordpress.org/reference/functions/get_the_category/
			*/
			foreach(get_the_category($post->ID) as $category){
				/**
				 * @reference (WP)
				 * 	Retrieves category link URL.
				 * 	https://developer.wordpress.org/reference/functions/get_category_link/
				*/
				$breadcrumbs[get_category_link($category->term_id)] = $category->name;
			}
			/**
			 * @reference (WP)
			 * 	Retrieve post title.
			 * 	https://developer.wordpress.org/reference/functions/get_the_title/
			*/
			$breadcrumbs[] = get_the_title();
		}
		elseif(is_singular() && !is_home() && !is_front_page()){
			/**
			 * @since 1.0.1
			 * 	Pages/custom post type.
			 * @reference (WP)
			 * 	Determines whether the query is for an existing single post of any post type (post, attachment, page, custom post types).
			 * 	https://developer.wordpress.org/reference/functions/is_singular/
			*/
			$current_page = array($post);

			/**
			 * @since 1.0.1
			 * 	Get the parent pages of the current page if they exist.
			 * @reference (WP)
			 * 	Retrieves post data given a post ID or post object.
			 * 	https://developer.wordpress.org/reference/functions/get_post/
			*/
			if(isset($current_page[0]->post_parent)){
				while($current_page[0]->post_paren){
					array_unshift($current_page,get_post($current_page[0]->post_parent));
				}
			}

			/**
			 * @since 1.0.1
			 * 	Add returned pages to breadcrumbs.
			 * @reference (WP)
			 * 	Retrieves the permalink for the current page or page ID.
			 * 	https://developer.wordpress.org/reference/functions/get_page_link/
			*/
			foreach($current_page as $page){
				$breadcrumbs[get_page_link($page->ID)] = $page->post_title;
			}
		}
		elseif(is_category()){
			/**
			 * @since 1.0.1
			 * 	Categories.
			 * @reference (WP)
			 * 	Determines whether the query is for an existing category archive page.
			 * 	https://developer.wordpress.org/reference/functions/is_category/
			 * 	Display or retrieve page title for category archive.
			 * 	https://developer.wordpress.org/reference/functions/single_cat_title/
			*/
			$breadcrumbs[] = single_cat_title('',FALSE);
		}
		elseif(is_tax()){
			/**
			 * @since 1.0.1
			 * 	Taxonomies.
			 * @reference (WP)
			 * 	Determines whether the query is for an existing custom taxonomy archive page.
			 * 	https://developer.wordpress.org/reference/functions/is_tax/
			 * 	Get all Term data from database by Term field and data.
			 * 	https://developer.wordpress.org/reference/functions/get_term_by/
			 * 	Retrieves the value of a query variable in the WP_Query class.
			 * 	https://developer.wordpress.org/reference/functions/get_query_var/
			*/
			$current_term = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));

			/**
			 * @reference (WP)
			 * 	Get an array of ancestor IDs for a given object.
			 * 	https://developer.wordpress.org/reference/functions/get_ancestors/
			*/
			$ancestors = array_reverse(get_ancestors($current_term->term_id,get_query_var('taxonomy')));

			/**
			 * @reference (WP)
			 * 	Get all Term data from database by Term ID.
			 * 	https://developer.wordpress.org/reference/functions/get_term/
			 * 	Generate a permalink for a taxonomy term archive.
			 * 	https://developer.wordpress.org/reference/functions/get_term_link/
			*/
			foreach($ancestors as $ancestor){
				$ancestor = get_term($ancestor,get_query_var('taxonomy'));
				$breadcrumbs[get_term_link($ancestor->slug,get_query_var('taxonomy'))] = $ancestor->name;
			}
			$breadcrumbs[] = $current_term->name;
		}
		elseif(is_search()){
			/**
			 * @since 1.0.1
			 * 	Searches.
			 * @reference (WP)
			 * 	Determines whether the query is for a search.
			 * 	https://developer.wordpress.org/reference/functions/is_search/
			 * 	Retrieves the contents of the search WordPress query variable.
			 * 	https://developer.wordpress.org/reference/functions/get_search_query/
			*/
			$breadcrumbs[] = __('Results:','bex-uikit3') . ' ' . get_search_query();
		}
		elseif(is_author()){
			/**
			 * @since 1.0.1
			 * 	Author archives.
			 * @reference (WP)
			 * 	Retrieves the currently queried object.
			 * 	https://developer.wordpress.org/reference/functions/get_queried_object/
			*/
			$author = get_queried_object();
			$breadcrumbs[] = __('Author Archives:','bex-uikit3') . ' ' . $author->display_name;
		}
		elseif(is_tag()){
			/**
			 * @since 1.0.1
			 * 	Tag archives.
			 * @reference (WP)
			 * 	Determines whether the query is for an existing tag archive page.
			 * 	https://developer.wordpress.org/reference/functions/is_tag/
			 * 	Display or retrieve page title for tag post archive.
			 * 	https://developer.wordpress.org/reference/functions/single_tag_title/
			*/
			$breadcrumbs[] = __('Tag Archives:','bex-uikit3') . ' ' . single_tag_title('',FALSE);
		}
		elseif(is_date()){
			/**
			 * @since 1.0.1
			 * 	Date archives.
			 * @reference (WP)
			 * 	Determines whether the query is for an existing date archive.
			 * 	https://developer.wordpress.org/reference/functions/is_date/
			 * 	Retrieve the time at which the post was written.
			 * 	https://developer.wordpress.org/reference/functions/get_the_time/
			*/
			$breadcrumbs[] = __('Archives:','bex-uikit3') . ' ' . get_the_time('F Y');
		}
		elseif(is_404()){
			/**
			 * @since 1.0.1
			 * 	404.
			 * @reference (WP)
			 * 	Determines whether the query has resulted in a 404 (returns no results).
			 * 	https://developer.wordpress.org/reference/functions/is_404/
			*/
			$breadcrumbs[] = __('404','bex-uikit3');
		}

		/**
		 * @reference (Beans)
		 * 	HTML markup
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/

		// 	Open breadcrumb.
		beans_open_markup_e('beans_breadcrumb','ul',array('class' => 'uk-breadcrumb uk-padding uk-width-1-1@m'));
			$i = 0;

		foreach($breadcrumbs as $breadcrumb_url => $breadcrumb){

			// Breadcrumb items.
			if(count($breadcrumbs) - 1 !== $i){
				beans_open_markup_e('beans_breadcrumb_item','li');
					/* Automatically escaped. */
					beans_open_markup_e('beans_breadcrumb_item_link','a',array('href' => $breadcrumb_url));

						// Used for mobile devices.
						beans_open_markup_e('beans_breadcrumb_item_link_inner','span');
							beans_output_e('beans_breadcrumb_item_text',$breadcrumb);
						beans_close_markup_e('beans_breadcrumb_item_link_inner','span');

					beans_close_markup_e('beans_breadcrumb_item_link','a');
				beans_close_markup_e('beans_breadcrumb_item','li');
			}
			else{
				// Active.
				beans_open_markup_e('beans_breadcrumb_item[_active]','li',array('class' => 'uk-active uk-text-muted'));
					beans_output_e('beans_breadcrumb_item[_active]_text',$breadcrumb);
				beans_close_markup_e('beans_breadcrumb_item[_active]','li');
			}
			$i++;
		}

		// Close breadcrumb.
		beans_close_markup_e('beans_breadcrumb','ul');

	}// Method
