<?php

namespace BwlPetitionsManager\Base;

/**
 * Class for plucin frontend inline js.
 *
 * @package BwlPetitionsManager
 * @since: 1.1.0
 * @auther: Mahbub Alam Khan
 */
class FrontendInlineJs {


	/**
	 * Register the methods.
	 */
	public function register() {
		add_action( 'wp_head', [ $this, 'set_inline_js' ] );
	}

	/**
	 * Set the inline js.
	 */
	public function set_inline_js() {
		ob_start();
		?>
<script type="text/javascript" id="bptm-inline-js">
var ajaxurl = "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>";

var bptm_validate_msg =
    "<?php echo apply_filters( 'bptm_sign_err_msg', esc_html__( 'One or more fields have an error.', 'bwl_ptmn' ) ); ?>",
    bwl_petitions_add_msg =
    "<?php echo apply_filters( 'bptm_sign_thanks_msg', esc_html__( 'Thanks for your sign!', 'bwl_ptmn' ) ); ?>",
    bwl_petitions_fail_msg = "<?php esc_html_e( 'Unable to collect your sign. Please try again.', 'bwl_ptmn' ); ?>",
    bwl_petition_wait_msg = "<?php esc_html_e( 'Please Wait....', 'bwl_ptmn' ); ?>";
</script>

		<?php
		echo ob_get_clean();
	}
}
