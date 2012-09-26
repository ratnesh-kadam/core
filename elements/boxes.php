<?php
/**
 * Title: Boxes Element
 *
 * FIXME: Displays custom post type Boxes
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

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

add_action( 'boxes', 'boxes_render_display' );

// Define content for boxes
function boxes_render_display() {
	
	// Intialize box counter
	$box_counter = 1;
	
	// Custom box query
	$boxes = new WP_Query( array( 'post_type'  => 'boxes', 'orderby' => 'post_date', 'order' => 'desc' ) );
?>
	<div id="widget-boxes-container" class="row-fluid">
		<div class="boxes">
		<?php	
		if ($boxes -> have_posts()) {
			while ($boxes -> have_posts()) {
				$boxes -> the_post();
				
				$post_id = get_the_id();
				
				// Break after desired number of boxes displayed
				if( $box_counter > 3 )
					break;
				
				// Get the image of the box
				$box_image = get_post_meta($post_id, 'cyberchimps_box_image' , true);
				
				// Get the text of the box
				$box_text = get_post_meta($post_id, 'cyberchimps_box_text' , true);
		?>	
				<div id="box<?php echo $box_counter?>" class="box span4">
					<a href="<?php echo get_permalink(); ?>">
						<img class="box-image" src="<?php echo $box_image; ?>" />
					</a>
					<h2 class="box-widget-title"><?php the_title(); ?></h2>
					<p><?php echo $box_text; ?></p>
				</div><!--end box1-->
		<?php   
			$box_counter++;
			}
		}
		?>
		</div><!-- end boxes -->
	</div><!-- end row-fluid -->
<?php		
} 
?>