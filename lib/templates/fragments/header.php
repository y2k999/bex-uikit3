<?php
/**
 * Echo header fragments.
 * @package Beans Extension Uikit3
 * @since 1.5.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
*/


	beans_add_smart_action('beans_head','beans_head_meta',0);
	/**
	 * @access (public)
	 * 	Echo head meta.
	 * 	https://www.getbeans.io/code-reference/functions/beans_head_meta/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header.php
	*/
	function beans_head_meta()
	{
	?>
		<meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php
	}// Method


	beans_add_smart_action('wp_head','beans_head_pingback');
	/**
	 * @access (public)
	 * 	Echo head pingback.
	 * 	https://www.getbeans.io/code-reference/functions/beans_head_pingback/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header.php
	*/
	function beans_head_pingback()
	{
	?>
		<link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">

	<?php
	}// Method


	beans_add_smart_action('wp_head','beans_favicon');
	/**
	 * @access (public)
	 * 	Echo head favicon if no icon was added via the customizer.
	 * 	https://www.getbeans.io/code-reference/functions/beans_favicon/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header.php
	*/
	function beans_favicon()
	{
		/**
		 * @since 1.0.1
		 * 	Stop here if and icon was added via the customizer.
		 * @reference (WP)
		 * 	Whether the site has a Site Icon.
		 * 	https://developer.wordpress.org/reference/functions/has_site_icon/
		*/
		if(function_exists('has_site_icon') && has_site_icon()){return;}

		$url = file_exists(get_stylesheet_directory() . '/favicon.ico') ? get_stylesheet_directory_uri() . '/favicon.ico' : BEANS_URL . 'favicon.ico';

		/**
		 * @reference (Beans)
		 * Echo self-close markup and attributes registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup_e/
		*/
		beans_selfclose_markup_e('beans_favicon','link',array(
			'rel' => 'Shortcut Icon',
			/* Automatically escaped. */
			'href' => $url,
			'type' => 'image/x-icon',
		));

	}// Method


	beans_add_smart_action('wp_head','beans_header_image');
	/**
	 * @access (public)
	 * 	Print the header image css inline in the header.
	 * https://www.getbeans.io/code-reference/functions/beans_header_image/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header.php
	*/
	function beans_header_image()
	{
		/**
		 * @reference (WP)
		 * 	Retrieves header image for custom header.
		 * 	https://developer.wordpress.org/reference/functions/get_header_image/
		*/
		$header_image = get_header_image();
		if(!current_theme_supports('custom-header') || !$header_image || empty($header_image)){return;}
		?>
		<style type="text/css">
			.tm-header{
				background-image: url(<?php echo esc_url($header_image); ?>);
				background-position: 50% 50%;
				background-size: cover;
				background-repeat: no-repeat;
			}
		</style>

	<?php
	}// Method


	beans_add_smart_action('beans_header','beans_site_branding');
	/**
	 * @access (public)
	 * 	Echo header site branding.
	 * 	https://www.getbeans.io/code-reference/functions/beans_site_branding/
	 * @return (void)
	 * @reference
	 * 	[Theme]/lib/templates/structure/header-partial.php
	*/
	function beans_site_branding()
	{
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_selfclose_markup_e/
		*/
		beans_open_markup_e('beans_site_branding','div',	array(
			'class' => 'tm-site-branding uk-float-left uk-padding',
		));

			beans_open_markup_e('beans_site_title_link','a',array(
				/* Automatically escaped. */
				'href' => home_url(),
				'rel' => 'home',
				'itemprop' => 'headline',
			));
				/**
				 * @reference (WP)
				 * 	Retrieves theme modification value for the current theme.
				 * 	https://developer.wordpress.org/reference/functions/get_theme_mod/
				*/
				$logo = get_theme_mod('beans_logo_image',FALSE);

				/* phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Code structure mimics HTML markup. */
				if($logo){
					beans_selfclose_markup_e('beans_logo_image','img',array(
						'class' => 'tm-logo',
						/* Automatically escaped. */
						'src' => $logo,
						/* Automatically escaped. */
						'alt' => get_bloginfo('name'),
					));
				}
				else{
					beans_output_e('beans_site_title_text',get_bloginfo('name'));
				}

			/* phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Code structure mimics HTML markup. */
			beans_close_markup_e('beans_site_title_link','a');
		beans_close_markup_e('beans_site_branding','div');

	}// Method


	beans_add_smart_action('beans_site_branding_append_markup','beans_site_title_tag');
	/**
	 * @access (public)
	 * 	Echo header site title tag.
	 * 	https://www.getbeans.io/code-reference/functions/beans_site_title_tag/
	 * @return (void)
	 */
	function beans_site_title_tag()
	{
		/**
		 * @since 1.0.1
		 * 	Stop here if there isn't a description.
		 * @reference (WP)
		 * 	Retrieves information about the current site.
		 * 	https://developer.wordpress.org/reference/functions/get_bloginfo/
		*/
		$description = get_bloginfo('description');

		if(!$description){return;}

		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		*/
		beans_open_markup_e('beans_site_title_tag','span',array(
			'class' => 'tm-site-title-tag uk-text-small uk-text-muted uk-display-block uk-margin-small-top',
			'itemprop' => 'description',
		));
			beans_output_e('beans_site_title_tag_text',$description);
		beans_close_markup_e('beans_site_title_tag','span');

	}// Method
