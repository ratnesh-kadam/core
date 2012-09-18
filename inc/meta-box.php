<?php
/**
 * FIXME: Edit Title Content
 *
 * FIXME: Edit Description Content
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 * FIXME: POINT USERS TO DOWNLOAD OUR STARTER CHILD THEME AND DOCUMENTATION
 *
 * @category Cyber Chimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

add_action('admin_head', 'cyberchimps_load_meta_boxes_scripts');
function cyberchimps_load_meta_boxes_scripts() {
	global $post_type;

	//TODO HS Will need to add more post types as they are created
	if ( $post_type == 'page' ) :		
		wp_enqueue_style( 'meta-boxes-css', get_template_directory_uri().'/core/lib/css/metabox-tabs.css' );
		wp_enqueue_script('meta-boxes-js', get_template_directory_uri().'/core/lib/js/metabox-tabs.js', array('jquery'));	
	endif;
}

add_action('init', 'cyberchimps_init_meta_boxes');
function cyberchimps_init_meta_boxes() {
	global $options;
	
	// Store URL of the template to a variable
	define('TEMPLATE_URL', get_template_directory_uri());
	define('CORE_IMAGE', TEMPLATE_URL . "/core/lib/images/");
	
	// Declare variables
	$portfolio_options = array(); 
	$carousel_options = array();
	$slider_options = array();
	$blog_options = array();
	
	// Call taxonomies for select options
	$portfolio_terms = get_terms('portfolio_categories', 'hide_empty=0');
	if( ! is_wp_error( $portfolio_terms ) ):
	foreach($portfolio_terms as $term) {
		$portfolio_options[$term->slug] = $term->name;
	}
	endif;
	
	$carousel_terms = get_terms('carousel_categories', 'hide_empty=0');
	if( ! is_wp_error( $carousel_terms ) ): 
	foreach($carousel_terms as $term) {
		$carousel_options[$term->slug] = $term->name;
	}
	endif;
	
	$slide_terms = get_terms('slide_categories', 'hide_empty=0');
	if( ! is_wp_error( $slide_terms ) ):
	foreach($slide_terms as $term) {
		$slider_options[$term->slug] = $term->name;
	}
	endif;
	
	$category_terms = get_terms('category', 'hide_empty=0');
	if( ! is_wp_error( $category_terms ) ):
	$blog_options['all'] = "All";
	foreach($category_terms as $term) {
		$blog_options[$term->slug] = $term->name;
	}
	endif;
	
	// End taxonomy call
	
	$meta_boxes = array();
		
	$mb = new Chimps_Metabox('post_slide_options', __('Slider Options', 'cyberchimps'), array('pages' => array('post')));
	$mb
		->tab("Slider Options")
			->single_image('cyberchimps_slider_image', __('Slider Image', 'cyberchimps'), '')
			->text('cyberchimps_slider_text', __('Slider Text', 'cyberchimps'), __('Enter your slider text here', 'cyberchimps'))			
			->checkbox('slider_hidetitle', __('Title Bar', 'cyberchimps'), '', array('std' => 'on'))
			->single_image('slider_custom_thumb', __('Custom Thumbnail', 'cyberchimps'), __('Use the image uploader to upload a custom navigation thumbnail', 'cyberchimps'))
			->sliderhelp('', __('Need Help?', 'cyberchimps'), '')
		->end();

	$mb = new Chimps_Metabox('pages', 'Page Options', array('pages' => array('page')));
	$mb
		->tab("Page Options")
			->image_select('cyberchimps_page_sidebar', 'Select Page Layout', '',  array('options' => array(
				'right_sidebar' => get_template_directory_uri() . '/core/lib/images/right.png',
				'left_right_sidebar' => get_template_directory_uri() . '/core/lib/images/tworight.png',
				'content_middle' => get_template_directory_uri() . '/core/lib/images/rightleft.png',
				'full_width' => get_template_directory_uri() . '/core/lib/images/none.png',
				'left_sidebar' => get_template_directory_uri() . '/core/lib/images/left.png')
			))
			->section_order('cyberchimps_page_section_order', 'Page Elements', '', array(
				'std' => array(
					'breadcrumbs' => 'Breadcrumbs',
				),
				'options' => array(
					'breadcrumbs' => 'Breadcrumbs',
					'page_slider' => 'iFeature Slider',
					'callout_section' => 'Callout',
					'twitterbar_section' => 'Twitter Bar',
					'portfolio_element' => 'Portfolio',
					'product_element' => 'Product',
					'page_section' => 'Page',
					'widgets_section' => 'Widgets',
					'carousel_section' => 'Carousel',
					'portfolio_lite' => 'Portfolio Lite',
					'recent_posts' => 'Recent Posts',
					'slider_lite' => 'Slider Lite',
					'featured_posts' => 'Featured Posts',
					'magazine' => 'Magazine'
				)
				))
			->pagehelp('', 'Need Help?', '')
		->tab("Magazine Layout Options")
			->select('no_of_box', 'Number of Columns', '', array('options' => array('2', '3')) )
		->tab("Featured Posts Options")
			->select('cyberchimps_featured_post_category_toggle', 'Select post source', '', array('options' => array('Latest posts', 'From category')) )
			->text('cyberchimps_featured_post_category', 'Enter category', '', array('std' => 'featured'))
		->tab("Slider Lite Options")
			->single_image('cyberchimps_slider_lite_slide_one_image', 'Slide One Image', '', array('std' =>  CORE_IMAGE . 'sliderdefault.jpg'))
			->text('cyberchimps_slider_lite_slide_one_url', 'Slide One Link', '', array('std' => 'http://wordpress.org'))
			->single_image('cyberchimps_slider_lite_slide_two_image', 'Slide Two Image', '', array('std' =>  CORE_IMAGE . 'slide2.jpg'))
			->text('cyberchimps_slider_lite_slide_two_url', 'Slide Two Link', '', array('std' => 'http://wordpress.org'))
			->single_image('cyberchimps_slider_lite_slide_three_image', 'Slide Three Image', '', array('std' =>  CORE_IMAGE . 'slide3.jpg'))
			->text('cyberchimps_slider_lite_slide_three_url', 'Slide Three Link', '', array('std' => 'http://wordpress.org'))
		->tab("Slider Options")
			->select('page_slider_size', 'Select Slider Size', '', array('options' => array('Full-Width', 'Half-Width')) )
			->select('page_slider_type', 'Select Slider Type', '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select('slider_category', 'Custom Slide Category', '', array('options' => $slider_options) )
			->select('slider_blog_category', 'Blog Post Category', '', array('options' => $blog_options, 'all') )
			->text('slider_blog_posts_number', 'Number of Featured Blog Posts', '', array('std' => '5'))
			->text('slider_height', 'Slider Height', '', array('std' => '330'))
			->text('slider_delay', 'Slider Delay Time (MS)', '', array('std' => '3500'))
			->select('page_slider_animation', 'Slider Animation Type', '', array('options' => array('Horizontal-Push (default)', 'Fade', 'Horizontal-Slide', 'Vertical-Slide')) )
			->select('page_slider_navigation_style', 'Slider Navigation Style', '', array('options' => array('Dots (default)', 'Thumbnails', 'None')) )
			->select('page_slider_caption_style', 'Slider Caption Style', '', array('options' => array('None (default)', 'Bottom', 'Left', 'Right')) )
			->checkbox('hide_arrows', 'Navigation Arrows', '', array('std' => 'on'))
			->checkbox('enable_wordthumb', 'WordThumb Image Resizing', '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab("Product Options")
			->select('cyberchimps_product_text_align', 'Text Align', '', array('options' => array('Left', 'Right')) )
			->text('cyberchimps_product_title', 'Product Title', '', array('std' => 'Product'))
			->textarea('cyberchimps_product_text', 'Product Text', '', array('std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. '))
			->select('cyberchimps_product_type', 'Media Type', '', array('options' => array('Image', 'Video')) )
			->single_image('cyberchimps_product_image', 'Product Image', '', array('std' =>  get_template_directory_uri() . '/images/pro/product.jpg'))
			->textarea('cyberchimps_product_video', 'Video Embed', '')
			->checkbox('cyberchimps_product_link_toggle', 'Product Link', '', array('std' => 'on'))
			->text('cyberchimps_product_link_url', 'Link URL', '', array('std' => home_url()))
			->text('cyberchimps_product_link_text', 'Link Text', '', array('std' => 'Buy Now'))
		->tab("Callout Options")
			->text('callout_title', 'Callout Title', '')
			->textarea('callout_text', 'Callout Text', '')
			->checkbox('disable_callout_button', 'Callout Button', '', array('std' => 'on'))
			->text('callout_button_text', 'Callout Button Text', '')
			->text('callout_url', 'Callout Button URL', '')
			->checkbox('extra_callout_options', 'Custom Callout Options', '', array('std' => 'off'))
			->single_image('callout_image', 'Custom Button Image', '')
			->color('custom_callout_color', 'Custom Background Color', '')
			->color('custom_callout_title_color', 'Custom Title Color', '')
			->color('custom_callout_text_color', 'Custom Text Color', '')
			->color('custom_callout_button_color', 'Custom Button Color', '')
			->color('custom_callout_button_text_color', 'Custom Button Text Color', '')
			->pagehelp('', 'Need help?', '')
		->tab("Portfolio Options")
			->select('portfolio_row_number', 'Images per row', '', array('options' => array('Three (default)', 'Two', 'Four')) )
			->select('portfolio_category', 'Portfolio Category', '', array('options' => $portfolio_options) )
			->checkbox('portfolio_title_toggle', 'Portfolio Title', '')
			->text('portfolio_title', 'Title', '', array('std' => 'Portfolio'))
		->tab("Portfolio Lite Options")
			->single_image('cyberchimps_portfolio_lite_image_one', 'First Portfolio Image', '', array('std' =>  get_template_directory_uri() . '/core/lib/images/portfolio.jpg'))
			->text('cyberchimps_portfolio_lite_image_one_caption', 'First Portfolio Image Caption', '', array('std' => 'Image 1'))
			->checkbox('cyberchimps_portfolio_link_toggle_one', 'First Porfolio Link', '', array('std' => 'on'))
			->text('cyberchimps_portfolio_link_url_one', 'Link URL', '', array('std' => home_url()))
			->single_image('cyberchimps_portfolio_lite_image_two', 'Second Portfolio Image', '', array('std' =>  get_template_directory_uri() . '/core/lib/images/portfolio.jpg'))
			->text('cyberchimps_portfolio_lite_image_two_caption', 'Second Portfolio Image Caption', '', array('std' => 'Image 2'))
			->checkbox('cyberchimps_portfolio_link_toggle_two', 'Second Porfolio Link', '', array('std' => 'on'))
			->text('cyberchimps_portfolio_link_url_two', 'Link URL', '', array('std' => home_url()))
			->single_image('cyberchimps_portfolio_lite_image_three', 'Third Portfolio Image', '', array('std' =>  get_template_directory_uri() . '/core/lib/images/portfolio.jpg'))
			->text('cyberchimps_portfolio_lite_image_three_caption', 'Third Portfolio Image Caption', '', array('std' => 'Image 3'))
			->checkbox('cyberchimps_portfolio_link_toggle_three', 'Third Porfolio Link', '', array('std' => 'on'))
			->text('cyberchimps_portfolio_link_url_three', 'Link URL', '', array('std' => home_url()))
			->single_image('cyberchimps_portfolio_lite_image_four', 'Fourth Portfolio Image', '', array('std' =>  get_template_directory_uri() . '/core/lib/images/portfolio.jpg'))
			->text('cyberchimps_portfolio_lite_image_four_caption', 'Fourth Portfolio Image Caption', '', array('std' => 'Image 4'))
			->checkbox('cyberchimps_portfolio_link_toggle_four', 'Fourth Porfolio Link', '', array('std' => 'on'))
			->text('cyberchimps_portfolio_link_url_four', 'Link URL', '', array('std' => home_url()))
			->checkbox('cyberchimps_portfolio_title_toggle', 'Portfolio Title', '')
			->text('cyberchimps_portfolio_title', 'Title', '', array('std' => 'Portfolio'))
		->tab("Recent Posts Options")
			->checkbox('cyberchimps_recent_posts_title_toggle', 'Title', '')
			->text('cyberchimps_recent_posts_title', '', '')
			->select('cyberchimps_recent_posts_category', 'Post Category', '', array('options' => $blog_options, 'all') )
			->checkbox('cyberchimps_recent_posts_images_toggle', 'Images', '')
		->tab("Carousel Options")
			->select('carousel_category', 'Carousel Category', '', array('options' => $carousel_options) )
			->text('carousel_speed', 'Carousel Animation Speed (ms)', '', array('std' => '750'))
		->tab("Twitter Options")
			->text('cyberchimps_twitter_handle', 'Twitter Handle', 'Enter your Twitter handle if using the Twitter bar')
			->checkbox('cyberchimps_twitter_reply', 'Show @ Replies', '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}
}