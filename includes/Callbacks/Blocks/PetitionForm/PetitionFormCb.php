<?php
namespace BUGTB\Callbacks\Blocks\PetitionForm;

/**
 * Class PetitionFormCb
 *
 * @package BUGTB
 */
class PetitionFormCb {

	/**
	 * Render output
	 *
	 * @param array $attributes Attributes.
	 *
	 * @return string
	 */
	public function render_output( $attributes = [] ) {
		extract( $attributes ); //phpcs:ignore
		return do_shortcode( "[petition_about id='{$petitionId}' /]" ); //phpcs:ignore
	}
}