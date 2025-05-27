<?php
namespace BUGTB\Callbacks\Blocks\Button;

/**
 * Class ButtonCb
 *
 * @package BUGTB
 */
class ButtonCb {

	/**
	 * Render output
	 *
	 * @param array $attributes Attributes.
	 *
	 * @return string
	 */
	public function render_output( $attributes = [] ) {

		if ( empty( $attributes['text'] ) ) {
			return '';
		}

		$data = $this->get_the_link_data( $attributes['text'] );

			$tag    = $data['tag'];
			$href   = $data['href'] ?? '#';
			$text   = $data['text'] ?? $attributes['text'];
			$target = isset( $data['target'] ) ? "target='{$data['target']}'" : '';
			$rel    = isset( $data['rel'] ) ? "rel='{$data['rel']}'" : '';

			$color = $attributes['color'] ?? 'blue';
			$size  = $attributes['size'] ?? 'medium';

		return "<{$tag} href='{$href}' class='bugtb-button bugtb-button--{$color} bugtb-button--{$size}' {$target} {$rel}>{$text}</{$tag}>"; //phpcs:ignore

	}

	/**
	 * Get the link data
	 *
	 * @param string $link_data Link data.
	 *
	 * @return array
	 */
	private function get_the_link_data( $link_data = '' ) {
		$extracted_data = [
			'tag' => 'a',
		];

		if ( empty( $link_data ) ) {
			return $extracted_data;
		}

		$html = $link_data;

		$pattern = '/<a\s+([^>]+)>(.*?)<\/a>/i';
		preg_match( $pattern, $html, $matches );

		if ( $matches ) {
			$attributes_str = $matches[1]; // All attributes as string
			$text           = $matches[2];           // Anchor text

			// Extract individual attributes
			preg_match( '/href="([^"]+)"/i', $attributes_str, $href_match );

			$href   = $href_match[1] ?? '';
			$target = $href_match[1] ?? '';
			$rel    = $href_match[1] ?? '';

			$extracted_data = array_merge($extracted_data, [
				'href'   => $href,
				'text'   => $text,
				'target' => $target,
				'rel'    => $rel,
			]);

		}
		return $extracted_data;

	}
}
