<?php
namespace BUGTB\Callbacks\Blocks\Banner;

/**
 * Class BannerCb
 *
 * @package BUGTB\Callbacks\Blocks\Button
 */
class BannerCb {

	/**
	 * Render output
	 *
	 * @param array  $attributes Attributes.
	 * @param string $content Content.
	 *
	 * @return string
	 */
	public function render_output( array $attributes = [], $content = '' ) {

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
