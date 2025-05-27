<?php
namespace BUGTB\Callbacks\Blocks\SlideShow;

/**
 * Class SlideShowCb
 *
 * @package BUGTB\Callbacks\Blocks\Button
 */
class SlideShowCb {

	/**
	 * Render output
	 *
	 * @param array  $attributes Attributes.
	 * @param string $content Content.
	 *
	 * @return string
	 */
	public function render_output( array $attributes = [], $content = '' ) {

		return '<div class="swiper-container"><div class="swiper-wrapper">' . $content . '</div><div class="swiper-pagination"></div></div>';

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
