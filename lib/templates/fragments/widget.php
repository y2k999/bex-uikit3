<?php
/**
 * Echo widget fragments.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	beans_add_smart_action('beans_widget','beans_widget_badge',5);
	/**
	 * @access (public)
	 * 	Echo widget badge.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_badge/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/templates/structure/widget-area.php
	*/
	function beans_widget_badge()
	{
		/**
		 * @reference (Beans)
		 * 	Retrieve data from the current widget in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget/
		*/
		if(!beans_get_widget('badge')){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup_e/
		 * 	Search content for shortcodes and filter shortcodes through their hooks.
		 * 	https://www.getbeans.io/code-reference/functions/beans_widget_shortcodes/
		*/
		beans_open_markup_e('beans_widget_badge' . _beans_widget_subfilters(),'div','class=uk-card-body');
			/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Echoes HTML output. */
			echo beans_widget_shortcodes(beans_get_widget('badge_content'));
		beans_close_markup_e('beans_widget_badge' . _beans_widget_subfilters(),'div');

	}// Method


	beans_add_smart_action('beans_widget','beans_widget_title');
	/**
	 * @access (public)
	 * 	Echo widget title.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_title/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/templates/structure/widget-area.php
	*/
	function beans_widget_title()
	{
		/**
		 * @reference (Beans)
		 * 	Retrieve data from the current widget in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget/
		*/
		$title = beans_get_widget('title');
		if(!$title || !beans_get_widget('show_title')){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_widget_title' . _beans_widget_subfilters(),'h4','class=widget-title uk-card-title uk-padding-small');
			beans_output_e('beans_widget_title_text',$title);
		beans_close_markup_e('beans_widget_title' . _beans_widget_subfilters(),'h4');

	}// Method


	beans_add_smart_action('beans_widget','beans_widget_content',15);
	/**
	 * @access (public)
	 * 	Echo widget content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_content/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/templates/structure/widget-area.php
	*/
	function beans_widget_content()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * 	Retrieve data from the current widget in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget/
		*/
		beans_open_markup_e('beans_widget_content' . _beans_widget_subfilters(),'div','class=uk-card-body');
			beans_output_e('beans_widget_content' . _beans_widget_subfilters(),beans_get_widget('content'));
		beans_close_markup_e('beans_widget_content' . _beans_widget_subfilters(),'div');

	}// Method


	beans_add_smart_action('beans_no_widget','beans_no_widget');
	/**
	 * @access (public)
	 * 	Echo no widget content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_no_widget/
	 * @return (void)
	 * @reference
	 * 	[Plugin]/beans_extension/api/widget/beans.php
	 * 	[Theme]/lib/templates/structure/widget-area.php
	*/
	function beans_no_widget()
	{
		// Only apply this notice to sidebar_primary and sidebar_secondary.
		if(!in_array(beans_get_widget_area('id'),array('sidebar_primary','sidebar_secondary'),true)){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * 	Retrieve data from the current widget area in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget_area/
		*/
		beans_open_markup_e('beans_no_widget_notice','p',array('class' => 'uk-alert-warning'));
			/* translators: Name of the widget area. */
			beans_output_e(	'beans_no_widget_notice_text',sprintf(esc_html__('%s does not have any widget assigned!','bex-uikit3'),beans_get_widget_area('name')));
		beans_close_markup_e('beans_no_widget_notice','p');

	}// Method


	beans_add_filter('beans_widget_content_rss_output','beans_widget_rss_content');
	/**
	 * @access (public)
	 * 	Modify RSS widget content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_widget_rss_content/
	 * @return (string)
	 * 	The RSS widget content.
	*/
	function beans_widget_rss_content()
	{
		/**
		 * @reference (Beans)
		 * 	Retrieve data from the current widget in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget/
		*/
		$options = beans_get_widget('options');
		return '<p><a class="uk-button" href="' . beans_get('url',$options) . '" target="_blank">' . esc_html__('Read feed','bex-uikit3') . '</a><p>';

	}// Method


	beans_add_filter('beans_widget_content_attributes','beans_modify_widget_content_attributes');
	/**
	 * @access (public)
	 * 	Modify core widgets content attributes, so they use the default UIKit styling.
	 * 	https://www.getbeans.io/code-reference/functions/beans_modify_widget_content_attributes/
	 * @param (array) $attributes
	 * 	The current widget attributes.
	 * @return (array)
	 * 	The modified widget attributes.
	*/
	function beans_modify_widget_content_attributes($attributes)
	{
		/**
		 * @reference (Beans)
		 * 	Retrieve data from the current widget in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget/
		*/
		$type = beans_get_widget('type');

		$target = array(
			'archives',
			'categories',
			'links',
			'meta',
			'pages',
			'recent-posts',
			'recent-comments',
		);

		$current_class = isset($attributes['class']) ? $attributes['class'] . ' ' : '';

		if(in_array(beans_get_widget('type'),$target,true)){
			/* Automatically escaped. */
			$attributes['class'] = $current_class . 'uk-list uk-list-circle';
		}

		if('calendar' === $type){
			/* Automatically escaped. */
			$attributes['class'] = $current_class . 'uk-table uk-table-condensed';
		}

		return $attributes;

	}// Method


	beans_add_filter('beans_widget_content_categories_output','beans_modify_widget_count');
	beans_add_filter('beans_widget_content_archives_output','beans_modify_widget_count');
	/**
	 * @access (public)
	 * 	Modify widget count.
	 * 	https://www.getbeans.io/code-reference/functions/beans_modify_widget_count/
	 * @param (string) $content
	 * 	The widget content.
	 * @return (string)
	 * 	The modified widget content.
	*/
	function beans_modify_widget_count($content)
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		$count = beans_output('beans_widget_count','$1');

		/**
		 * @reference (Beans)
		 * 	Retrieve data from the current widget in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget/
		*/
		if(true === beans_get('dropdown',beans_get_widget('options'))){
			$output = $count;
		}
		else{
			$output  = beans_open_markup('beans_widget_count','span','class=tm-count');
			$output .= $count;
			$output .= beans_close_markup('beans_widget_count','span');
		}

		// Keep closing tag to avoid overwriting the inline JavaScript.
		return preg_replace('#>((\s|&nbsp;)\((.*)\))#','>' . $output,$content);

	}// Method


	beans_add_filter('beans_widget_content_categories_output','beans_remove_widget_dropdown_label');
	beans_add_filter('beans_widget_content_archives_output','beans_remove_widget_dropdown_label');
	/**
	 * @access (public)
	 * 	Modify widget dropdown label.
	 * 	https://www.getbeans.io/code-reference/functions/beans_remove_widget_dropdown_label/
	 * @param (string) $content
	 * 	The widget content.
	 * @return (string)
	 * 	The modified widget content.
	*/
	function beans_remove_widget_dropdown_label($content)
	{
		return preg_replace('#<label([^>]*)class="screen-reader-text"(.*?)>(.*?)</label>#','',$content);

	}// Method

