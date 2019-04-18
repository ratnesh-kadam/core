<?php
/**
 * Title: Footer Hooks
 *
 * Description: Defines actions/hooks for footer content.
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

/**
 * Adds the CyberChimps credit.
 *
 * @since 1.0
 */
function cyberchimps_footer_credit() {
	?>
	<div class="container-full-width" id="after_footer">
		<div class="container">
			<div class="container-fluid">
				<footer class="site-footer row-fluid">
					<div class="span6">
						<div id="credit">
							<?php if ( '1' === cyberchimps_get_option( 'footer_cyberchimps_link', 1 ) ) : ?>
								<a href="http://cyberchimps.com/" target="_blank" title="Premium WordPress Themes By CyberChimps">
								<?php if ( 'free' === cyberchimps_theme_check() ) { ?>
									<h4 class="cc-credit-text">CyberChimps WordPress Themes</h4></a>

								<?php } else { ?>
									<img width="150px" height="auto" class="cc-credit-logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/cyberchimps/lib/images/logo_cc.png" alt="Premium WordPress Themes By CyberChimps"/>
								</a>
								<!--  <div class="market" style="line-height:2.3"><a href="http://neilpatel.com/" rel="noindex, nofollow">Marketed  By Neil Patel</a></div>-->
								<?php } ?>

							<?php endif; ?>

						</div>
					</div>
					<!-- Adds the afterfooter copyright area -->
					<div class="span6">
						<?php $copyright = ( cyberchimps_get_option( 'footer_copyright_text' ) ) ? cyberchimps_get_option( 'footer_copyright_text' ) : 'CyberChimps &#169;' . date( 'Y' ); ?>
						<div id="copyright">
							<?php echo wp_kses_post( $copyright ); ?>
						</div>
					</div>
				</footer>
				<!-- row-fluid -->
			</div>
			<!-- .container-fluid-->
		</div>
		<!-- .container -->
	</div>    <!-- #after_footer -->
	<?php
}

add_action( 'cyberchimps_footer', 'cyberchimps_footer_credit' );

/**
 * Start new row of footer widgets with a new row-fluid div so that it keeps the fluid layout.
 *
 * @param  [type] $params [description].
 * @return [type]         [description]
 */
function cyberchimps_footer_widgets( $params ) {

	// Checked if it's footer widgets.
	if ( 'Footer Widgets' === $params[0]['name'] ) {

		// Declare a widget counter globally so that we can increase it in each iteration.
		global $footer_widget_counter;
		$footer_widget_counter++;

		// If it's 5(or multiple of 5)th widget then we need to close the current row-fluid div and start a new one.
		if ( 0 === $footer_widget_counter % 5 ) {
			echo '</div> <div class="row-fluid">';
		}
	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'cyberchimps_footer_widgets' );
