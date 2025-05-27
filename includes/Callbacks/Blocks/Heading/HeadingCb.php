<?php
namespace BUGTB\Callbacks\Blocks\Heading;

/**
 * Class HeadingCb
 *
 * @package BUGTB
 */
class HeadingCb {

	/**
     * Get the tag by size
     *
     * @param string $class_name Class name.
     *
     * @return string
     */
	private function get_the_tag_by_size( $class_name = '' ) {

		switch ( $class_name ) {
			case 'large':
				return 'h1';
			case 'medium':
				return 'h2';
			case 'small':
				return 'h3';

			default:
			    return 'h1';
		}

	}
	/**
     * Render output
     *
     * @param array $attributes Attributes.
     *
     * @return string
     */
	public function render_output( $attributes = [] ) {

		$tag   = $this->get_the_tag_by_size( $attributes['size'] );
		$size  = $attributes['size'] ?? 'large';
		$text  = $attributes['text'] ?? '';
		$color = $attributes['color'] ?? '';

		return "<{$tag} class='headline headline--{$size} headline--{$color}'>{$text}</{$tag}>";
	}
}
