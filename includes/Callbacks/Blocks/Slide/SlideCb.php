<?php
namespace BUGTB\Callbacks\Blocks\Slide;

/**
 * Class SlideCb
 *
 * @package BUGTB\Callbacks\Blocks\Button
 */
class SlideCb {

	/**
	 * Render output
	 *
	 * @param array  $attributes Attributes.
	 * @param string $content Content.
	 *
	 * @return string
	 */
	public function render_output( array $attributes = [], $content = '' ) {

		$content = isset( $attributes['content'] ) ? $attributes['content'] : '';
		return '<div class="swiper-slide">' . esc_html( $content ) . '</div>';

		ob_start();

		$bg_style = isset( $attributes['imgURL'] ) ? "style='background-image: url({$attributes['imgURL']})'" : '';

		?>

<div class="wp-block-bugtb-banner" <?php echo $bg_style; //phpcs:ignore ?>>
  <?php echo $content; //phpcs:ignore ?>
</div>
		<?php

		return ob_get_clean();
	} //phpcs:ignore
}
