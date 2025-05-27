<?php
namespace BwlPetitionsManager\Base;

use BwlPetitionsManager\Traits\SignCountTrait;

/**
 * Class for plucin Petitions Default Sign Count.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PetitionsDefaultSignCount {

	use SignCountTrait;

	/**
	 * Register the methods.
	 */
	public function register() { // phpcs:ignore
		add_action( 'admin_init', [ $this, 'initialize' ] );
	}

	/**
	 * Initialize the plugin.
	 */
	public function initialize() {
		add_action( 'save_post_petitions', [ $this, 'set_default_sign_count' ] );
	}

	/**
	 * Set default sign count.
	 *
	 * @param int $post_id Post ID.
	 */
	public function set_default_sign_count( $post_id ) {

		if ( $this->get_the_sign_target_count( $post_id ) === 0 ) {
				update_post_meta( $post_id, BPTM_META_USER_SIGN_TARGET, BPTM_DEFAULT_SIGN_TARGET );
		}
	}
}
