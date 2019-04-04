<?php
/**
 * Title: Header Hooks
 *
 * Description: Defines actions/hooks for header content.
 *
 * Please do not edit this file. This file is part of the Cyber Chimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category Cyber Chimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

function cyberchimps_header_section_order() {
	// get the defaults from the themes function file and turn the key into the value in a new array to mirror what happens within the theme when their are options saved in the database
	$defaults = array();
	$default  = apply_filters( 'header_drag_and_drop_default', array( 'cyberchimps_header_content' => __( 'Logo + Icons', 'cyberchimps_core' ) ) );
	foreach ( $default as $key => $val ) {
		$defaults[] = $key;
	}
	// call the database results and if they don't exist then call the defaults from above
	$header_section = cyberchimps_get_option( 'header_section_order', $defaults );
	$header_section = ( $header_section == '' ) ? $defaults : $header_section;

	if ( is_array( $header_section ) ) {
		foreach ( $header_section as $func ) {
			do_action( $func );
		}
	}
}

add_action( 'cyberchimps_header', 'cyberchimps_header_section_order' );

// Logo/Icons header element.
function cyberchimps_logo_icons() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php
			if ( function_exists( 'cyberchimps_header_logo' ) ) {
				cyberchimps_header_logo();
			}
			?>
		</div>

		<div id="register" class="span5">
			<?php
			if ( function_exists( 'cyberchimps_header_social_icons' ) ) {
				cyberchimps_header_social_icons();
			}
			?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_header_content', 'cyberchimps_logo_icons' );

// Logo/Search header element.
function cyberchimps_logo_searchform() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php
			if ( function_exists( 'cyberchimps_header_logo' ) ) {
				cyberchimps_header_logo();
			}
			?>
		</div>

		<div id="search" class="span5">
			<?php
			get_search_form( true );
			?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_logo_search', 'cyberchimps_logo_searchform' );

// Description/Icons header element.
function cyberchimps_description_icons() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<div id="register" class="span5">
			<?php
			if ( function_exists( 'cyberchimps_header_social_icons' ) ) {
				cyberchimps_header_social_icons();
			}
			?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_description_icons', 'cyberchimps_description_icons' );

// Logo and Contact
function cyberchimps_sitename_contact() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php
			if ( function_exists( 'cyberchimps_header_logo' ) ) {
				cyberchimps_header_logo();
			}
			?>
		</div>

		<div id="register" class="span5">
			<?php
			if ( function_exists( 'cyberchimps_contact_info' ) ) {
				echo cyberchimps_contact_info();
			}
			?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_sitename_contact', 'cyberchimps_sitename_contact' );

// Logo and Description
function cyberchimps_logo_description() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php
			if ( function_exists( 'cyberchimps_header_logo' ) ) {
				cyberchimps_header_logo();
			}
			?>
		</div>

		<div id="description" class="span5">
			<?php
			if ( function_exists( 'cyberchimps_description' ) ) {
				echo cyberchimps_description();
			}
			?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_logo_description', 'cyberchimps_logo_description' );

// Defines action for header elelment "Logo"
function cyberchimps_logo() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php
			if ( function_exists( 'cyberchimps_header_logo' ) ) {
				cyberchimps_header_logo();
			}
			?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_logo', 'cyberchimps_logo' );

// Header left content (sitename or logo)
function cyberchimps_header_logo() {

	$url = ( cyberchimps_get_option( 'custom_logo_url' ) == '1' ) ? cyberchimps_get_option( 'custom_logo_url_link' ) : esc_url( home_url() );
	if ( cyberchimps_get_option( 'custom_logo' ) == '1' ) {
		$logo = cyberchimps_get_option( 'custom_logo_uploader' );
		?>
		<div id="logo">
			<a href="<?php echo $url; ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img src="<?php echo stripslashes( $logo ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
		</div>
		<?php
	} else {
		if ( function_exists( 'cyberchimps_header_site_title' ) ) {
			cyberchimps_header_site_title();
		}
	}
}

function cyberchimps_header_site_title() {
	?>
	<div class="hgroup">
		<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
	</div>
	<?php
}

/**
 * Social icons positioned in header and some theme's footer
 *
 * The key of the $social variable has to match the font icon you want to use. If that differs from the name you want displayed set the title key
 * e.g. $social['twitterbird']['title'] = 'twitter';
 *
 * styling is located in /lib/css/core.css
 * icon fonts are from http://drinchev.github.io/monosocialiconsfont/
 */
function cyberchimps_header_social_icons() {

	// get the design of the icons to apply the right class
	$design = cyberchimps_get_option( 'theme_backgrounds', 'default' );

	// create array of social icons to loop through to check if they are set and add title key to
	// social networks with names different to key
	$social['twitterbird']['set']   = cyberchimps_get_option( 'social_twitter', 'checked' );
	$social['twitterbird']['title'] = 'twitter';
	$social['twitterbird']['url']   = cyberchimps_get_option( 'twitter_url' );
	$social['facebook']['set']      = cyberchimps_get_option( 'social_facebook', 'checked' );
	$social['facebook']['url']      = cyberchimps_get_option( 'facebook_url' );
	$social['googleplus']['set']    = cyberchimps_get_option( 'social_google', 'checked' );
	$social['googleplus']['url']    = cyberchimps_get_option( 'google_url' );
	$social['flickr']['set']        = cyberchimps_get_option( 'social_flickr' );
	$social['flickr']['url']        = cyberchimps_get_option( 'flickr_url' );
	$social['pinterest']['set']     = cyberchimps_get_option( 'social_pinterest' );
	$social['pinterest']['url']     = cyberchimps_get_option( 'pinterest_url' );
	$social['linkedin']['set']      = cyberchimps_get_option( 'social_linkedin' );
	$social['linkedin']['url']      = cyberchimps_get_option( 'linkedin_url' );
	$social['youtube']['set']       = cyberchimps_get_option( 'social_youtube' );
	$social['youtube']['url']       = cyberchimps_get_option( 'youtube_url' );
	$social['map']['set']           = cyberchimps_get_option( 'social_googlemaps' );
	$social['map']['title']         = 'google maps';
	$social['map']['url']           = cyberchimps_get_option( 'googlemaps_url' );
	$social['email']['set']         = cyberchimps_get_option( 'social_email' );
	$social['email']['url']         = 'mailto:' . cyberchimps_get_option( 'email_url' );
	$social['rss']['set']           = cyberchimps_get_option( 'social_rss' );
	$social['rss']['url']           = cyberchimps_get_option( 'rss_url' );
	$social['instagram']['set']     = cyberchimps_get_option( 'social_instagram' );
	$social['instagram']['url']     = cyberchimps_get_option( 'instagram_url' );
	$social['snapchat']['set']      = cyberchimps_get_option( 'social_snapchat' );
	$social['snapchat']['url']      = cyberchimps_get_option( 'snapchat_url' );

	$output = '';

	// get the blog title to add to link title
	$link_title = get_bloginfo( 'title' );

	// Loop through the $social variable
	foreach ( $social as $key => $value ) {

		// Check that the social icon has been set
		if ( ! empty( $value['set'] ) ) {

			// check if title is set and use it otherwise use key as title
			$title = ( isset( $social[ $key ]['title'] ) ) ? $social[ $key ]['title'] : $key;

			// Create the output
			$output .= '<a href="' . esc_url( $social[ $key ]['url'] ) . '"' . ( 'email' != $key ? ' target="_blank"' : '' )
				. ' title="' . esc_attr( $link_title . ' ' . ucwords( $title ) ) . '" class="symbol ' . $key . '"></a>';
		}
	}

	// Echo to the page
	?>
	<div id="social">
		<div class="<?php echo $design; ?>-icons">
			<?php echo $output; ?>
		</div>
	</div>

	<?php
}

// Custom HTML header element.
function cyberchimps_custom_header_element_content() {
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php echo stripslashes( cyberchimps_get_option( 'custom_header_element' ) ); ?>
		</div>
	</header>
	<?php
}

// Sitename/Register
function cyberchimps_logo_register_content() {
	// global $current_user; Commented By Swapnil as global $current_user is no longer being use
	?>
	<header id="cc-header" class="row-fluid">
		<div class="span7">
			<?php
			if ( function_exists( 'cyberchimps_header_logo' ) ) {
				cyberchimps_header_logo();
			}
			?>
		</div>

		<div id="register" class="span5">
			<div class="register">
				<?php if ( ! is_user_logged_in() ) : ?>
					<?php wp_loginout(); ?> <?php wp_meta(); ?> | <?php wp_register( '', '', true ); ?>
				<?php else : ?>
					Welcome back <strong>
					<?php
					// global $current_user;
						$current_user = wp_get_current_user();
						echo( $current_user->user_login );
					?>
						</strong> | <?php wp_loginout(); ?>
				<?php endif; ?>
			</div>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_sitename_register', 'cyberchimps_logo_register_content' );

// Full-Width Logo
function cyberchimps_banner_content() {

	// Getting banner options
	$banner  = cyberchimps_get_option( 'header_banner_image' );
	$default = get_template_directory_uri() . apply_filters( 'cyberchimps_banner_img', '/cyberchimps/lib/images/banner.jpg' );
	$url     = cyberchimps_get_option( 'header_banner_url' );

	// To fetch the alt text of image using the image src
	$image_id = cyberchimps_get_attachment_id_from_url( cyberchimps_get_option( 'header_banner_image' ) );
	$alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

	?>
	<header id="cc-header" class="row-fluid">
		<div id="banner">
			<?php if ( $banner != '' ) : ?>
				<a href="<?php echo $url; ?>"><img src="<?php echo $banner; ?>" alt="<?php echo $alt_text; ?>"></a>
			<?php endif; ?>
			<?php if ( $banner == '' ) : ?>
				<a href="<?php echo $url; ?>"><img src="<?php echo $default; ?>" alt="logo"></a>
			<?php endif; ?>
		</div>
	</header>
	<?php
}

add_action( 'cyberchimps_banner', 'cyberchimps_banner_content' );

// contact info
function cyberchimps_contact_info() {
	$contact = apply_filters( 'cyberchimps_header_contact', cyberchimps_get_option( 'contact_details' ) );
	?>

	<div class="contact_details">
		<?php echo $contact; ?>
	</div>
	<?php
}

// description
function cyberchimps_description() {
	$description = get_bloginfo( 'description' );
	?>
	<div class="blog-description">
		<p><?php echo $description; ?></p>
	</div>
	<?php
}

// Function to fetch the alt text of image using url
function cyberchimps_get_attachment_id_from_url( $attachment_url = '' ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url ) {
		return;
	}

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

?>
