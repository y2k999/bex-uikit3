<?php
/**
 * Echo the widget area and widget loop structural markup.
 * It also calls the widget area and widget loop action hooks.
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

	// This includes everything added to wp hooks before the widgets.

	/**
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/

	/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Widget area has to be echoed. */
	echo beans_get_widget_area('before_widgets');

	/* phpcs:disable Generic.WhiteSpace.ScopeIndent -- Code structure mirrors HTML markup. */
	if('grid' === beans_get_widget_area('beans_type')){
		beans_open_markup_e('beans_widget_area_grid' . _beans_widget_area_subfilters(),'div',array(
			'class' => 'uk-grid-collapse',
			'uk-grid' => '',
		));
	}

		/**
		 * @reference (Beans)
		 * 	Retrieve data from the current widget area in use.
		 * 	https://www.getbeans.io/code-reference/functions/beans_get_widget_area/
		*/
		if('offcanvas' === beans_get_widget_area('beans_type')){
			beans_open_markup_e('beans_widget_area_offcanvas_wrap' . _beans_widget_area_subfilters(),'div',array(
				/* Automatically escaped. */
				'id' => beans_get_widget_area('id'),
				// 'class' => 'uk-offcanvas',
				'uk-offcanvas' => '',
			));
				beans_open_markup_e('beans_widget_area_offcanvas_bar' . _beans_widget_area_subfilters(),'div',array('class' => 'uk-offcanvas-bar'));
		}

			/**
			 * @description
			 * 	Widgets.
			 * @reference (Beans)
			 * 	Whether there are more widgets available in the loop.
			 * 	https://www.getbeans.io/code-reference/functions/beans_have_widgets/
			*/
			if(beans_have_widgets()){
				/**
				 * @reference (Beans)
				 * 	Fires before widgets loop.
				 * 	This hook only fires if widgets exist.
				 * 	https://www.getbeans.io/code-reference/hooks/beans_before_widgets_loop/
				*/
				do_action('beans_before_widgets_loop');

				while(beans_have_widgets()) :
					beans_setup_widget();
					if('grid' === beans_get_widget_area('beans_type')){
						beans_open_markup_e('beans_widget_grid' . _beans_widget_subfilters(),'div', beans_widget_shortcodes('class=uk-width-1-{count}@m'));
					}
							beans_open_markup_e('beans_widget_panel' . _beans_widget_subfilters(),'div',beans_widget_shortcodes('class=tm-widget uk-card widget_{type} {id}'));
								/**
								 * @reference (Beans)
								 * 	Fires in each widget panel structural HTML.
								 * 	https://www.getbeans.io/code-reference/hooks/beans_widget/
								*/
								do_action('beans_widget');
							beans_close_markup_e('beans_widget_panel' . _beans_widget_subfilters(),'div');

						if('grid' === beans_get_widget_area('beans_type')){
							beans_close_markup_e('beans_widget_grid' . _beans_widget_subfilters(),'div');
						}
					endwhile;

				/**
				 * @reference (Beans)
				 * 	Fires after the widgets loop.
				 * 	This hook only fires if widgets exist.
				 * 	https://www.getbeans.io/code-reference/hooks/beans_after_widgets_loop/
				*/
				do_action('beans_after_widgets_loop');
			}
			else{
				/**
				 * @reference (Beans)
				 * 	Fires if no widgets exist.
				 * 	https://www.getbeans.io/code-reference/hooks/beans_no_widget/
				*/
				do_action('beans_no_widget');
			}

		if('offcanvas' === beans_get_widget_area('beans_type')){
				beans_close_markup_e('beans_widget_area_offcanvas_bar' . _beans_widget_area_subfilters(),'div');
			beans_close_markup_e('beans_widget_area_offcanvas_wrap' . _beans_widget_area_subfilters(),'div');
		}

		if('grid' === beans_get_widget_area('beans_type')){
			beans_close_markup_e('beans_widget_area_grid' . _beans_widget_area_subfilters(),'div');
		}

	// This includes everything added to wp hooks after the widgets.

	/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped -- Widget area has to be echoed. */
	echo beans_get_widget_area('after_widgets');

	/* phpcs:enable Generic.WhiteSpace.ScopeIndent -- Code structure mirrors HTML markup. */
