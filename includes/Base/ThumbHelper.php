<?php
namespace BwlPetitionsManager\Base;

/**
 * Class for plucin thumbnail helper.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class ThumbHelper {

	/**
     * Register the thumbnail helper.
     */
	public function register() {
		add_action( 'init', [ $this, 'add_image_sizes' ] );
	}

	/**
     * Add image sizes.
     */
	public function add_image_sizes() {
		add_image_size( 'petition_box_thumb', 360, 255 );
		add_image_size( 'petition_list_thumb', 140, 90 );
	}
}
