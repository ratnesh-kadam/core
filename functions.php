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

//set global theme options variable
$options = get_option('cyberchimps_options');

// FIXME: Fix documentation
// Enqueue core scripts and core styles
function cyberchimps_core_scripts() {
	global $post;
	$path = get_template_directory_uri() . '/core/lib/js/';
	
	// Load JS for slimbox
	wp_enqueue_script( 'slimbox', get_template_directory_uri() . '/core/lib/js/jquery.slimbox.js', array( 'jquery' ), true );

	// Load library for jcarousel
	wp_enqueue_script( 'jcarousel', get_template_directory_uri() . '/core/lib/js/jquery.jcarousel.min.js', array( 'jquery' ), true );
	wp_enqueue_style( 'jcarousel-skin', get_template_directory_uri() . '/core/lib/css/jcarousel/skin.css', array('bootstrap-responsive-style', 'bootstrap-style'), '1.0' );

	// Load Custom JS
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/core/lib/js/custom.js', array( 'jquery' ), true );
	
	// Load JS for swipe functionality in slider
	wp_enqueue_script( 'event-swipe-move', $path . 'jquery.event.move.js', array('jquery') );
	wp_enqueue_script( 'event-swipe', $path . 'jquery.event.swipe.js', array('jquery') );
	wp_enqueue_script( 'swipe', $path . 'swipe.js', array('jquery') );
	
	// Load Bootstrap Library Items
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/core/lib/bootstrap/css/bootstrap.min.css', false, '2.0.4' );
	wp_enqueue_style( 'bootstrap-responsive-style', get_template_directory_uri() . '/core/lib/bootstrap/css/bootstrap-responsive.min.css', array('bootstrap-style'), '2.0.4' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/core/lib/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '2.0.4', true );
	
	// Load Core Stylesheet
	wp_enqueue_style( 'core-style', get_template_directory_uri() . '/core/lib/css/core.css', array('bootstrap-responsive-style', 'bootstrap-style'), '1.0' );
	
	// Load Theme Stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri(), array('core-style', 'bootstrap-responsive-style', 'bootstrap-style'), '1.0' );
	
	// Add thumbnail size
	if ( function_exists( 'add_image_size' ) ) { 
        add_image_size( 'featured-thumb', 100, 80, true);
        add_image_size( 'headline-thumb', 200, 225, true);
    } 
}
add_action( 'wp_enqueue_scripts', 'cyberchimps_core_scripts', 20 );

if ( ! function_exists( 'cyberchimps_posted_on' ) ) :
// FIXME: Fix documentation
//Prints HTML with meta information for the current post-date/time and author.
function cyberchimps_posted_on() {
	global $options;
	
	if( is_single() ) {
		$show_date = $options['single_post_byline_elements']['date']; 
		$show_author = $options['single_post_byline_elements']['author']; 
	}
	elseif( is_archive() ) {
		$show_date = $options['archive_post_byline_elements']['date'];  
		$show_author = $options['archive_post_byline_elements']['author'];
	}
	else {
		$show_date = $options['post_byline_elements']['date']; 
		$show_author = $options['post_byline_elements']['author']; 
	}
	
	$posted_on = sprintf( __( '%8$s<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline">%9$s<span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'cyberchimps' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		( $show_date ) ? esc_html( get_the_date() ) : '',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'cyberchimps' ), get_the_author() ) ),
		( $show_author ) ? esc_html( get_the_author() ) : '',
		( $show_date ) ? 'Posted on ' : '',
		( $show_author ) ? ' by ' : ''
	);
	apply_filters( 'cyberchimps_posted_on', $posted_on );
	echo $posted_on;
}
endif;

// share icons at the end of the post
function cyberchimps_article_share() {
	global $options;
	
	if( is_single() ) {
		$show = $options['single_post_byline_elements']['share']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_post_byline_elements']['share'];  
	}
	else {
		$show = $options['post_byline_elements']['share'];  
	}
	if( $show ): ?>
  
  <div class="cyberchimps_article_share">
					&nbsp;<a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/facebook.png" alt="Share on Facebook" height="16px" width="16px" /></a> 
					<a href="http://twitter.com/home?status=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/twitter.png" alt="Share on Twitter" height="16px" width="16px" /></a> 
					<a href="http://reddit.com/submit?url=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/reddit.png" alt="Share on Reddit" height="16px" width="16px" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/share/linkedin.png" alt="Share on LinkedIn" height="16px" width="16px" /></a>	
  </div>

<?php endif;
}

//add meta entry category to single post, archive and blog list if set in options
function cyberchimps_posted_in() {
	global $options, $post;

	if( is_single() ) {
		$show = $options['single_post_byline_elements']['categories']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_post_byline_elements']['categories'];  
	}
	else {
		$show = $options['post_byline_elements']['categories'];  
	}
	if( $show ):
				$categories_list = get_the_category_list( __( ', ', 'cyberchimps' ) );
				if ( $categories_list ) :
				$cats = sprintf( __( 'Posted in %1$s', 'cyberchimps' ), $categories_list );
			?>
			<span class="cat-links">
				<?php echo apply_filters( 'cyberchimps_post_categories', $cats ); ?>
			</span>
      <span class="sep"> <?php echo apply_filters( 'cyberchimps_entry_meta_sep', '|' ); ?> </span>
	<?php endif;
	endif;
}

//add meta entry tags to single post, archive and blog list if set in options
function cyberchimps_post_tags() {
	global $options, $post;
	
	if( is_single() ) {
		$show = $options['single_post_byline_elements']['tags']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_post_byline_elements']['tags'];  
	}
	else {
		$show = $options['post_byline_elements']['tags'];  
	}
	if( $show ):
	$tags_list = get_the_tag_list( '', __( ', ', 'cyberchimps' ) );
				if ( $tags_list ) :
				$tags = sprintf( __( 'Tags: %1$s', 'cyberchimps' ), $tags_list );
			?>
			<span class="tag-links">
				<?php echo apply_filters( 'cyberchimps_post_tags', $tags ); ?>
			</span>
      <span class="sep"> <?php echo apply_filters( 'cyberchimps_entry_meta_sep', '|' ); ?> </span>
			<?php endif; // End if $tags_list
	endif;
}

//add meta entry comments to single post, archive and blog list if set in options
function cyberchimps_post_comments() {
	global $options, $post;
	
	if( is_single() ) {
		$show = $options['single_post_byline_elements']['comments']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_post_byline_elements']['comments'];  
	}
	else {
		$show = $options['post_byline_elements']['comments'];  
	}
	if( $show ):
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'cyberchimps' ), __( '1 Comment', 'cyberchimps' ), __( '% Comments', 'cyberchimps' ) ); ?></span>
      <span class="sep"> <?php echo apply_filters( 'cyberchimps_entry_meta_sep', '|' ); ?> </span>
    <?php endif;
	endif;
}

// add featured image to single post, archive and blog page if set in options
function cyberchimps_featured_image() {
	global $options, $post;
	
	if( is_single() ) {
		$show = $options['single_post_featured_images']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_featured_images'];  
	}
	else {
		$show = $options['post_featured_images'];  
	}
	if( $show ):
		if( has_post_thumbnail() ): ?>
    <div class="featured-image">
      <?php the_post_thumbnail( apply_filters( 'cyberchimps_post_thumbnail_size', 'thumbnail' ) ); ?>
    </div>
<?php endif;
		endif;
}

// add breadcrumbs to single posts and archive pages if set in options
function cyberchimps_breadcrumbs() {
	global $options, $post;
	
	if( is_single() ) {
		$show = $options['single_post_breadcrumbs']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_breadcrumbs'];  
	}
	if( isset( $show ) ):
		do_action( 'breadcrumbs' );
	endif;
}
add_action( 'cyberchimps_before_container', 'cyberchimps_breadcrumbs' );

function cyberchimps_post_format_icon() {
	global $options, $post;
	
	$format = get_post_format( $post->ID );
	if( $format == '' ) {
		$format = 'default'; 
	}
	
	if( is_single() ) {
		$show = $options['single_post_format_icons']; 
	}
	elseif( is_archive() ) {
		$show = $options['archive_format_icons'];  
	}
	else {
		$show = $options['post_format_icons'];  
	}
	if( $show ):
	?>
	
	<div class="postformats"><!--begin format icon-->
		<img src="<?php echo get_template_directory_uri(); ?>/images/formats/<?php echo $format; ?>.png" alt="formats" />
	</div><!--end format-icon-->
<?php	
	endif;
}

// FIXME: Fix documentation
// Returns true if a blog has more than 1 category
function cyberchimps_categorized_blog() {
	if ( false === ( $cyberchimps_categorized_transient = get_transient( 'cyberchimps_categorized_transient' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$cyberchimps_categorized_transient = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$cyberchimps_categorized_transient = count( $cyberchimps_categorized_transient );

		set_transient( 'cyberchimps_categorized_transient', $cyberchimps_categorized_transient );
	}

	if ( '1' != $cyberchimps_categorized_transient ) {
		// This blog has more than 1 category so cyberchimps_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so cyberchimps_categorized_blog should return false
		return false;
	}
}

// FIXME: Fix documentation
// Flush out the transients used in cyberchimps_categorized_blog
function cyberchimps_category_transient_flusher() {
	// Remove transient
	delete_transient( 'cyberchimps_categorized_transient' );
}
add_action( 'edit_category', 'cyberchimps_category_transient_flusher' );
add_action( 'save_post', 'cyberchimps_category_transient_flusher' );



// FIXME: Fix documentation
function cyberchimps_default_site_title() {
	global $page, $paged;

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cyberchimps' ), max( $paged, $page ) );
}
add_filter('wp_title', 'cyberchimps_default_site_title');


// FIXME: Fix documentation
function cyberchimps_seo_compatibility_check() {
	if ( cyberchimps_detect_seo_plugins() ) {
		remove_filter( 'wp_title', 'cyberchimps_default_site_title', 10, 3 );
	}
}
add_action( 'after_setup_theme', 'cyberchimps_seo_compatibility_check', 5 );


// FIXME: Fix documentation
// TODO: Give Genesis/StudioPress Credit
// Detect some SEO Plugin that add constants, classes or functions.
function cyberchimps_detect_seo_plugins() {

	return cyberchimps_detect_plugin(
		// Use this filter to adjust plugin tests.
		apply_filters(
			'cyberchimps_detect_seo_plugins',
			/** Add to this array to add new plugin checks. */
			array(

				// Classes to detect.
				'classes' => array(
					'wpSEO',
					'All_in_One_SEO_Pack',
					'HeadSpace_Plugin',
					'Platinum_SEO_Pack',
				),

				// Functions to detect.
				'functions' => array(),

				// Constants to detect.
				'constants' => array( 'WPSEO_VERSION', ),
			)
		)
	);
}

// TODO: Give Genesis/StudioPress Credit
// FIXME: Fix documentation
function cyberchimps_detect_event_plugins() {
	return cyberchimps_detect_plugin(
		// Use this filter to adjust plugin tests.
		apply_filters(
			'cyberchimps_detect_event_plugins',
			/** Add to this array to add new plugin checks. */
			array(

				// Classes to detect.
				'classes' => array( 'TribeEvents' ),

				// Functions to detect.
				'functions' => array(),

				// Constants to detect.
				'constants' => array(),
			)
		)
	);
}


// FIXME: Fix documentation
// TODO: Give Genesis/StudioPress Credit
// Detect plugin by constant, class or function existence.
function cyberchimps_detect_plugin( $plugins ) {

	/** Check for classes */
	if ( isset( $plugins['classes'] ) ) {
		foreach ( $plugins['classes'] as $name ) {
			if ( class_exists( $name ) )
				return true;
		}
	}

	/** Check for functions */
	if ( isset( $plugins['functions'] ) ) {
		foreach ( $plugins['functions'] as $name ) {
			if ( function_exists( $name ) )
				return true;
		}
	}

	/** Check for constants */
	if ( isset( $plugins['constants'] ) ) {
		foreach ( $plugins['constants'] as $name ) {
			if ( defined( $name ) )
				return true;
		}
	}

	/** No class, function or constant found to exist */
	return false;
}

// Set read more link for recent post element
function recent_post_excerpt_more($more) {

	global $custom_excerpt, $post;
    
   		if ($custom_excerpt == 'recent') {
    		$linktext = 'Continue Reading';
    	}
    	
	return '&hellip;
			</p>
			<div class="more-link">
				<span class="continue-arrow"><img src="'. get_template_directory_uri() .'/core/lib/images/continue.png"></span><a href="'. get_permalink($post->ID) . '">  '.$linktext.'</a>
			</div>';
}

// Set read more link for featured post element
function featured_post_excerpt_more($more) {
	global $post;
	return '&hellip;</p></span><a href="'. get_permalink($post->ID) . '">Read More...</a>';
}

// Set length of the excerpt
function featured_post_length( $length ) {
	return 70;
}

// For magazine wide post
function magazine_post_wide( $length ) {
	return 130;
}

// more text for search results excerpt
function cyberchimps_search_excerpt_more( $more ){
	global $options, $post;
	if( $options['search_post_read_more'] != '' ){
		$more = '<p><a href="'. get_permalink($post->ID) . '">'.$options['search_post_read_more'].'</a></p>';
		return $more;
	}
	else {
		$more = '<p><a href="'. get_permalink($post->ID) . '">Read More...</a></p>';
		return $more;
	}
}

// excerpt length for search results
function cyberchimps_search_excerpt_length( $length ){
	global $options, $post;
	if( $options['search_post_excerpt_length'] != '' ) {
		$length = $options['search_post_excerpt_length'];
		return $length;
	}
	else {
		$length = 55;
		return $length;
	}
}

//For blog posts
function cyberchimps_blog_excerpt_more( $more ){
	global $options, $post;
	if( $options['blog_read_more_text'] != '' ){
		$more = '<p><a href="'. get_permalink($post->ID) . '">'.$options['blog_read_more_text'].'</a></p>';
		return $more;
	}
	else {
		$more = '<p><a href="'. get_permalink($post->ID) . '">Read More...</a></p>';
		return $more;
	}
}
if( isset( $options['post_excerpts'] ) ){
	add_filter( 'excerpt_more', 'cyberchimps_blog_excerpt_more', 999 );
}

function cyberchimps_blog_excerpt_length( $length ) {
	global $options, $post;
	if( $options['blog_excerpt_length'] != '' ) {
		$length = $options['blog_excerpt_length'];
		return $length;
	}
	else {
		$length = 55;
		return $length;
	}
}
if( isset( $options['post_excerpts'] ) ){
	add_filter( 'excerpt_length', 'cyberchimps_blog_excerpt_length', 999 );
}

/*	gets post views */
function getPostViews($postID){ 
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

/*	Sets post views	*/
function setPostViews($postID) { 
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/* To correct issue: adjacent_posts_rel_link_wp_head causes meta to be updated multiple times */
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
?>