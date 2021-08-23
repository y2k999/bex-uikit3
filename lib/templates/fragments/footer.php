<?php
/**
 * Echo footer fragments.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	beans_add_smart_action('beans_footer','beans_footer_content');
	/**
	 * @access (public)
	 * 	Echo the footer content.
	 * 	https://www.getbeans.io/code-reference/functions/beans_footer_content/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/footer-partial.php
	*/
	function beans_footer_content()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup/
		*/
		beans_open_markup_e('beans_credit_panel','div',array('class' => 'uk-card uk-padding uk-padding-remove-bottom uk-width-1-1@m'));

			beans_open_markup_e('beans_footer_credit','div',array('class' => 'uk-clearfix uk-text-small uk-text-muted'));

				beans_open_markup_e('beans_footer_credit_left','span',array('class' => 'uk-align-left'));

					beans_output_e('beans_footer_credit_text',sprintf(
						/* translators: Footer credits. Date followed by the name of the website. */
						__('&#x000A9; %1$s - %2$s. All rights reserved.','bex-uikit3'),
						date('Y'),
						/**
						 * @reference (WP)
						 * 	Retrieves information about the current site.
						 * 	https://developer.wordpress.org/reference/functions/get_bloginfo/
						*/
						get_bloginfo('name')
					));

				beans_close_markup_e('beans_footer_credit_left','span');

				$framework_link = beans_open_markup('beans_footer_credit_framework_link','a',array(
					/* Automatically escaped. */
					'href' => 'https://www.getbeans.io',
					'rel' => 'nofollow',
				));
					$framework_link .= beans_output('beans_footer_credit_framework_link_text','Beans');

				$framework_link .= beans_close_markup('beans_footer_credit_framework_link','a');

				beans_open_markup_e('beans_footer_credit_right','span',array('class' => 'uk-align-right'));

					beans_output_e('beans_footer_credit_right_text',sprintf(
						/* translators: Link to the Beans website. */
						__('%1$s theme for WordPress.','bex-uikit3'),
						$framework_link
					));

				beans_close_markup_e('beans_footer_credit_right','span');
			beans_close_markup_e('beans_footer_credit','div');

		beans_close_markup_e('beans_credit_panel','div');

	}// Method


	beans_add_smart_action('wp_footer','beans_replace_nojs_class');
	/**
	 * @access (public)
	 * 	Print inline JavaScript in the footer to replace the 'no-js' class with 'js'.
	 * 	https://www.getbeans.io/code-reference/functions/beans_replace_nojs_class/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/footer.php
	*/
	function beans_replace_nojs_class()
	{
		?><script type="text/javascript">
			(function() {
				document.body.className = document.body.className.replace('no-js','js');
			}());
		</script>

	<?php
	}// Method
