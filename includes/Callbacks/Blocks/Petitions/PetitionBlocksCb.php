<?php
namespace BUGTB\Callbacks\Blocks\Petitions;

use BUGTB\Helpers\PluginConstants;

/**
 * Class PetitionBlocksCb
 *
 * @package BUGTB
 */
class PetitionBlocksCb {

	/**
	 * Attributes
	 *
	 * @var array
	 */
	private $attributes = [];

	/**
	 * Render output
	 *
	 * @param array $attributes Attributes.
	 *
	 * @return string
	 */
	public function render_output( $attributes = [] ) {

		if ( empty( $attributes ) ) {
			return '';
		}

		$this->attributes = $attributes;

		extract( $attributes ); //phpcs:ignore

		if ( isset( $order ) ) {
			return $this->render_category_layout();
		} elseif ( isset( $type ) && ! empty( $type ) ) {
			return $this->render_petition_shortcode_layout();
		} else {
			return '';
		}

	}

	/**
	 * Render category layout
	 *
	 * @return string
	 */
	private function render_category_layout() {
		extract( $this->attributes ); //phpcs:ignore

		$tax_string = '';

		if ( isset( $categories ) && ! empty( $categories ) ) {

			foreach ( $categories as $category ) {
				$cat_array[] = $category['id'];
			}

			$tax_string = sprintf( ' category=%s', implode( ',', $cat_array ) );

		}

		$tax_string .= sprintf( ' limit=%d', $numberOfPosts ?: 5 );
		$tax_string .= sprintf( ' order=%s', $order ?: 'ASC' );
		$tax_string .= sprintf( ' orderby=%s', $orderBy ?: 'ID' );

		return do_shortcode( "[petitions {$tax_string} /]" );
	}

	/**
	 * Render petition shortcode layout
	 *
	 * @return string
	 */
	private function render_petition_shortcode_layout() {
		extract( $this->attributes ); //phpcs:ignore

		if ( in_array( $type, PluginConstants::$gt_blocks,true ) ) {
			$shortcode = str_replace( '-', '_', "petition_$type" );
			return do_shortcode( "[{$shortcode} id='{$petitionId}' /]" );
		} else {
				return '<p>Set valid block type!</p>';
		}
	}
}