<?php
namespace BwlPetitionsManager\Base;

/**
 * Class for plugin custom theme.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class CustomTheme extends BaseController {

  	/**
     * Register methods
     */
	public function register() {
		add_action( 'wp_head', [ $this, 'get_custom_theme' ] );
	}

	/**
	 * Get the custom theme.
	 */
	public function get_custom_theme() {
		// Get option panel settings.

		$petitions_options = get_option( 'petitions_options' );
		$custom_theme      = '<style type="text/css">';

		// PETITION INTRO BLOCK

		$bptm_intro_bg               = '#000000';
		$bptm_intro_bg_img           = '';
		$bptm_intro_bg_size          = '';
		$bptm_intro_bg_repeat        = '';
		$bptm_intro_color_mix_status = 1;
		$bptm_intro_bg_opacity       = '0.6';

		$custom_theme .= '.petition-intro-block{';

		if ( isset( $petitions_options['bptm_intro_bg'] ) && $petitions_options['bptm_intro_bg'] != '' ) {

				$bptm_intro_bg = $petitions_options['bptm_intro_bg'];
				$custom_theme .= 'background-color: ' . $bptm_intro_bg . ';';
		}

		if ( isset( $petitions_options['bptm_intro_bg_img']['src'] ) && $petitions_options['bptm_intro_bg_img']['src'] != '' ) {

				$bptm_intro_bg_img = $petitions_options['bptm_intro_bg_img']['src'];
				$custom_theme     .= 'background-image: url(' . $bptm_intro_bg_img . ');';

				// Size condition check.

				$bptm_intro_bg_size = ( isset( $petitions_options['bptm_intro_bg_size'] ) && $petitions_options['bptm_intro_bg_size'] != '' ) ? $petitions_options['bptm_intro_bg_size'] : $bptm_intro_bg_repeat;

			if ( $bptm_intro_bg_size != '' ) {

					$custom_theme .= 'background-size: ' . $bptm_intro_bg_size . ';';
			}

				// Repeat condition check.

				$bptm_intro_bg_repeat = ( isset( $petitions_options['bptm_intro_bg_repeat'] ) && $petitions_options['bptm_intro_bg_repeat'] != '' ) ? $petitions_options['bptm_intro_bg_repeat'] : $bptm_intro_bg_repeat;

			if ( $bptm_intro_bg_repeat != '' ) {

					$custom_theme .= 'background-repeat: ' . $bptm_intro_bg_repeat . ';';
			}
		}

		$custom_theme .= '}';

		// Color Overlay Mixing Section.

		if ( isset( $petitions_options['bptm_intro_color_mix_status'] ) && $petitions_options['bptm_intro_color_mix_status'] != 1 ) {

				$bptm_intro_color_mix_status = 0;
		}

		if ( $bptm_intro_color_mix_status == 1 ) {

				$bptm_intro_rgb = HexToRGB( $bptm_intro_bg );

				$bptm_intro_bg_opacity = ( isset( $petitions_options['bptm_intro_bg_opacity'] ) && $petitions_options['bptm_intro_bg_opacity'] != '' ) ? $petitions_options['bptm_intro_bg_opacity'] : $bptm_intro_bg_opacity;

				$custom_theme .= '.petition-intro-block:before{';

				$custom_theme .= 'background: rgba(' . $bptm_intro_rgb['r'] . ',' . $bptm_intro_rgb['g'] . ',' . $bptm_intro_rgb['b'] . ',' . $bptm_intro_bg_opacity . ');';

				$custom_theme .= '}';
		}

		// ABOUT INTRO BLOCK

		$bptm_about_bg               = '#000000';
		$bptm_about_bg_img           = '';
		$bptm_about_bg_size          = '';
		$bptm_about_bg_repeat        = '';
		$bptm_about_color_mix_status = 1;
		$bptm_about_bg_opacity       = '0.1';

		// issue in conditional fields.

		$custom_theme .= '.petition-about-block{';

		if ( isset( $petitions_options['bptm_about_bg'] ) && $petitions_options['bptm_about_bg'] != '' ) {

				$bptm_about_bg = $petitions_options['bptm_about_bg'];

				$custom_theme .= 'background-color: ' . $bptm_about_bg . ';';
		}

		if ( isset( $petitions_options['bptm_about_bg_img']['src'] ) && $petitions_options['bptm_about_bg_img']['src'] != '' ) {

				$bptm_about_bg_img = $petitions_options['bptm_about_bg_img']['src'];
				$custom_theme     .= 'background-image: url(' . $bptm_about_bg_img . ');';

				// Size condition check.

				$bptm_about_bg_size = ( isset( $petitions_options['bptm_about_bg_size'] ) && $petitions_options['bptm_about_bg_size'] != '' ) ? $petitions_options['bptm_about_bg_size'] : $bptm_about_bg_repeat;

			if ( $bptm_about_bg_size != '' ) {

					$custom_theme .= 'background-size: ' . $bptm_about_bg_size . ';';
			}

				// Repeat condition check.

				$bptm_about_bg_repeat = ( isset( $petitions_options['bptm_about_bg_repeat'] ) && $petitions_options['bptm_about_bg_repeat'] != '' ) ? $petitions_options['bptm_about_bg_repeat'] : $bptm_about_bg_repeat;

			if ( $bptm_about_bg_repeat != '' ) {

					$custom_theme .= 'background-repeat: ' . $bptm_about_bg_repeat . ';';
			}
		}

		$custom_theme .= '}';

		// Color Overlay Mixing Section.

		if ( isset( $petitions_options['bptm_about_color_mix_status'] ) && $petitions_options['bptm_about_color_mix_status'] != 1 ) {

				$bptm_about_color_mix_status = 0;
		}

		if ( $bptm_about_color_mix_status == 1 ) {

				$bptm_about_rgb        = HexToRGB( $bptm_about_bg );
				$bptm_about_bg_opacity = ( isset( $petitions_options['bptm_about_bg_opacity'] ) && $petitions_options['bptm_about_bg_opacity'] != '' ) ? $petitions_options['bptm_about_bg_opacity'] : $bptm_about_bg_opacity;
				$custom_theme         .= '.petition-about-block:before{';

				$custom_theme .= 'background: rgba(' . $bptm_about_rgb['r'] . ',' . $bptm_about_rgb['g'] . ',' . $bptm_about_rgb['b'] . ',' . $bptm_about_bg_opacity . ');';

				$custom_theme .= '}';
		}

		/*------------------------------ START PETITION SEND TO BLOCK  ---------------------------------*/

		$bptm_send_to_bg               = '#EEEEEE';
		$bptm_send_to_bg_img           = '';
		$bptm_send_to_bg_size          = '';
		$bptm_send_to_bg_repeat        = '';
		$bptm_send_to_color_mix_status = 1;
		$bptm_send_to_bg_opacity       = '1.0';

		// issue in conditional fields.

		$custom_theme .= '.petition-send-to-block{';

		if ( isset( $petitions_options['bptm_send_to_bg'] ) && $petitions_options['bptm_send_to_bg'] != '' ) {

				$bptm_send_to_bg = $petitions_options['bptm_send_to_bg'];

				$custom_theme .= 'background-color: ' . $bptm_send_to_bg . ';';
		}

		if ( isset( $petitions_options['bptm_send_to_bg_img']['src'] ) && $petitions_options['bptm_send_to_bg_img']['src'] != '' ) {

				$bptm_send_to_bg_img = $petitions_options['bptm_send_to_bg_img']['src'];
				$custom_theme       .= 'background-image: url(' . $bptm_send_to_bg_img . ');';

				// Size condition check.

				$bptm_send_to_bg_size = ( isset( $petitions_options['bptm_send_to_bg_size'] ) && $petitions_options['bptm_send_to_bg_size'] != '' ) ? $petitions_options['bptm_send_to_bg_size'] : $bptm_send_to_bg_repeat;

			if ( $bptm_send_to_bg_size != '' ) {

					$custom_theme .= 'background-size: ' . $bptm_send_to_bg_size . ';';
			}

				// Repeat condition check.

				$bptm_send_to_bg_repeat = ( isset( $petitions_options['bptm_send_to_bg_repeat'] ) && $petitions_options['bptm_send_to_bg_repeat'] != '' ) ? $petitions_options['bptm_send_to_bg_repeat'] : $bptm_send_to_bg_repeat;

			if ( $bptm_send_to_bg_repeat != '' ) {

					$custom_theme .= 'background-repeat: ' . $bptm_send_to_bg_repeat . ';';
			}
		}

		$custom_theme .= '}';

		// Color Overlay Mixing Section.

		if ( isset( $petitions_options['bptm_send_to_color_mix_status'] ) && $petitions_options['bptm_send_to_color_mix_status'] != 1 ) {

				$bptm_send_to_color_mix_status = 0;
		}

		if ( $bptm_send_to_color_mix_status == 1 ) {

				$bptm_send_to_rgb = HexToRGB( $bptm_send_to_bg );

				$bptm_send_to_bg_opacity = ( isset( $petitions_options['bptm_send_to_bg_opacity'] ) && $petitions_options['bptm_send_to_bg_opacity'] != '' ) ? $petitions_options['bptm_send_to_bg_opacity'] : $bptm_send_to_bg_opacity;

				$custom_theme .= '.petition-send-to-block:before{';

				$custom_theme .= 'background: rgba(' . $bptm_send_to_rgb['r'] . ',' . $bptm_send_to_rgb['g'] . ',' . $bptm_send_to_rgb['b'] . ',' . $bptm_send_to_bg_opacity . ');';

				$custom_theme .= '}';
		}

		/*------------------------------ START PETITION LETTER BLOCK  ---------------------------------*/

		$bptm_letter_bg               = '#FAFAFA';
		$bptm_letter_bg_img           = '';
		$bptm_letter_bg_size          = '';
		$bptm_letter_bg_repeat        = '';
		$bptm_letter_color_mix_status = 1;
		$bptm_letter_bg_opacity       = '1.0';

		// Issue in conditional fields.

		$custom_theme .= '.petition-letter-block{';

		if ( isset( $petitions_options['bptm_letter_bg'] ) && $petitions_options['bptm_letter_bg'] != '' ) {

				$bptm_letter_bg = $petitions_options['bptm_letter_bg'];

				$custom_theme .= 'background-color: ' . $bptm_letter_bg . ';';
		}

		if ( isset( $petitions_options['bptm_letter_bg_img']['src'] ) && $petitions_options['bptm_letter_bg_img']['src'] != '' ) {

				$bptm_letter_bg_img = $petitions_options['bptm_letter_bg_img']['src'];

				$custom_theme .= 'background-image: url(' . $bptm_letter_bg_img . ');';

				// Size condition check.

				$bptm_letter_bg_size = ( isset( $petitions_options['bptm_letter_bg_size'] ) && $petitions_options['bptm_letter_bg_size'] != '' ) ? $petitions_options['bptm_letter_bg_size'] : $bptm_letter_bg_repeat;

			if ( $bptm_letter_bg_size != '' ) {

					$custom_theme .= 'background-size: ' . $bptm_letter_bg_size . ';';
			}

				// Repeat condition check.

				$bptm_letter_bg_repeat = ( isset( $petitions_options['bptm_letter_bg_repeat'] ) && $petitions_options['bptm_letter_bg_repeat'] != '' ) ? $petitions_options['bptm_letter_bg_repeat'] : $bptm_letter_bg_repeat;

			if ( $bptm_letter_bg_repeat != '' ) {

					$custom_theme .= 'background-repeat: ' . $bptm_letter_bg_repeat . ';';
			}
		}

		$custom_theme .= '}';

		// Color Overlay Mixing Section.

		if ( isset( $petitions_options['bptm_letter_color_mix_status'] ) && $petitions_options['bptm_letter_color_mix_status'] != 1 ) {

				$bptm_letter_color_mix_status = 0;
		}

		if ( $bptm_letter_color_mix_status == 1 ) {

				$bptm_letter_rgb = HexToRGB( $bptm_letter_bg );

				$bptm_letter_bg_opacity = ( isset( $petitions_options['bptm_letter_bg_opacity'] ) && $petitions_options['bptm_letter_bg_opacity'] != '' ) ? $petitions_options['bptm_letter_bg_opacity'] : $bptm_letter_bg_opacity;

				$custom_theme .= '.petition-letter-block:before{';

				$custom_theme .= 'background: rgba(' . $bptm_letter_rgb['r'] . ',' . $bptm_letter_rgb['g'] . ',' . $bptm_letter_rgb['b'] . ',' . $bptm_letter_bg_opacity . ');';

				$custom_theme .= '}';
		}

		/*------------------------------ START PETITION SIGN & RESULT BLOCK  ---------------------------------*/

		$bptm_sign_bg               = '##FFFFFF';
		$bptm_sign_bg_img           = '';
		$bptm_sign_bg_size          = '';
		$bptm_sign_bg_repeat        = '';
		$bptm_sign_color_mix_status = 1;
		$bptm_sign_bg_opacity       = '1.0';

		$bptm_form_bg           = '#EAEBEF';
		$bptm_form_border_color = '#FAFAFA';
		$bptm_form_margin       = '0';
		$bptm_form_padding      = '32px 32px 0 32px';

		$custom_theme .= '.petition-form-wrapper{';

		if ( isset( $petitions_options['bptm_form_bg'] ) && $petitions_options['bptm_form_bg'] != '' ) {

				$bptm_form_bg = $petitions_options['bptm_form_bg'];

				$custom_theme .= "background-color:{$bptm_form_bg};";
		}

		if ( isset( $petitions_options['bptm_form_border_color'] ) && $petitions_options['bptm_form_border_color'] != '' ) {

				$bptm_form_border_color = $petitions_options['bptm_form_border_color'];

				$custom_theme .= "border-color:{$bptm_form_border_color};";
		}

		if ( isset( $petitions_options['bptm_form_padding'] ) && $petitions_options['bptm_form_padding'] != '' ) {

				$bptm_form_padding = $petitions_options['bptm_form_padding'];

				$custom_theme .= "padding:{$bptm_form_padding};";
		}

		if ( isset( $petitions_options['bptm_form_margin'] ) && $petitions_options['bptm_form_margin'] != '' ) {

				$bptm_form_margin = $petitions_options['bptm_form_margin'];

				$custom_theme .= 'margin: ' . $bptm_form_margin . ';';
		}

		$custom_theme .= '}';

		$custom_theme .= '.petition-result-block{';

		if ( isset( $petitions_options['bptm_sign_bg'] ) && $petitions_options['bptm_sign_bg'] != '' ) {

				$bptm_sign_bg = $petitions_options['bptm_sign_bg'];

				$custom_theme .= 'background-color: ' . $bptm_sign_bg . ';';
		}

		if ( isset( $petitions_options['bptm_sign_bg_img']['src'] ) && $petitions_options['bptm_sign_bg_img']['src'] != '' ) {

				$bptm_sign_bg_img = $petitions_options['bptm_sign_bg_img']['src'];

				$custom_theme .= 'background-image: url(' . $bptm_sign_bg_img . ');';

				// Size condition check.

				$bptm_sign_bg_size = ( isset( $petitions_options['bptm_sign_bg_size'] ) && $petitions_options['bptm_sign_bg_size'] != '' ) ? $petitions_options['bptm_sign_bg_size'] : $bptm_sign_bg_repeat;

			if ( $bptm_sign_bg_size != '' ) {

					$custom_theme .= 'background-size: ' . $bptm_sign_bg_size . ';';
			}

				// Repeat condition check.

				$bptm_sign_bg_repeat = ( isset( $petitions_options['bptm_sign_bg_repeat'] ) && $petitions_options['bptm_sign_bg_repeat'] != '' ) ? $petitions_options['bptm_sign_bg_repeat'] : $bptm_sign_bg_repeat;

			if ( $bptm_sign_bg_repeat != '' ) {

					$custom_theme .= 'background-repeat: ' . $bptm_sign_bg_repeat . ';';
			}
		}

		$custom_theme .= '}';

		// Color Overlay Mixing Section.

		if ( isset( $petitions_options['bptm_sign_color_mix_status'] ) && $petitions_options['bptm_sign_color_mix_status'] != 1 ) {

				$bptm_sign_color_mix_status = 0;
		}

		if ( $bptm_sign_color_mix_status == 1 ) {

				$bptm_sign_rgb = HexToRGB( $bptm_sign_bg );

				$bptm_sign_bg_opacity = ( isset( $petitions_options['bptm_sign_bg_opacity'] ) && $petitions_options['bptm_sign_bg_opacity'] != '' ) ? $petitions_options['bptm_sign_bg_opacity'] : $bptm_sign_bg_opacity;

				$custom_theme .= '.petition-result-block:before{';

				$custom_theme .= 'background: rgba(' . $bptm_sign_rgb['r'] . ',' . $bptm_sign_rgb['g'] . ',' . $bptm_sign_rgb['b'] . ',' . $bptm_sign_bg_opacity . ');';

				$custom_theme .= '}';
		}

		// START PETITION SHARE BLOCK

		$bptm_share_bg               = '#000000';
		$bptm_share_bg_img           = '';
		$bptm_share_bg_size          = '';
		$bptm_share_bg_repeat        = '';
		$bptm_share_color_mix_status = 1;
		$bptm_share_bg_opacity       = '0.6';

		$custom_theme .= '.petition-share-block{';

		if ( isset( $petitions_options['bptm_share_bg'] ) && $petitions_options['bptm_share_bg'] != '' ) {

				$bptm_share_bg = $petitions_options['bptm_share_bg'];

				$custom_theme .= 'background-color: ' . $bptm_share_bg . ';';
		}

		if ( isset( $petitions_options['bptm_share_bg_img']['src'] ) && $petitions_options['bptm_share_bg_img']['src'] != '' ) {

				$bptm_share_bg_img = $petitions_options['bptm_share_bg_img']['src'];

				$custom_theme .= 'background-image: url(' . $bptm_share_bg_img . ');';

				// Size condition check.

				$bptm_share_bg_size = ( isset( $petitions_options['bptm_share_bg_size'] ) && $petitions_options['bptm_share_bg_size'] != '' ) ? $petitions_options['bptm_share_bg_size'] : $bptm_share_bg_repeat;

			if ( $bptm_share_bg_size != '' ) {

					$custom_theme .= 'background-size: ' . $bptm_share_bg_size . ';';
			}

				// Repeat condition check.

				$bptm_share_bg_repeat = ( isset( $petitions_options['bptm_share_bg_repeat'] ) && $petitions_options['bptm_share_bg_repeat'] != '' ) ? $petitions_options['bptm_share_bg_repeat'] : $bptm_share_bg_repeat;

			if ( $bptm_share_bg_repeat != '' ) {

					$custom_theme .= 'background-repeat: ' . $bptm_share_bg_repeat . ';';
			}
		}

		$custom_theme .= '}';

		// Color Overlay Mixing Section.

		if ( isset( $petitions_options['bptm_share_color_mix_status'] ) && $petitions_options['bptm_share_color_mix_status'] != 1 ) {

				$bptm_share_color_mix_status = 0;
		}

		if ( $bptm_share_color_mix_status == 1 ) {

				$bptm_share_rgb = HexToRGB( $bptm_share_bg );

				$bptm_share_bg_opacity = ( isset( $petitions_options['bptm_share_bg_opacity'] ) && $petitions_options['bptm_share_bg_opacity'] != '' ) ? $petitions_options['bptm_share_bg_opacity'] : $bptm_share_bg_opacity;

				$custom_theme .= '.petition-share-block:before{';

				$custom_theme .= 'background: rgba(' . $bptm_share_rgb['r'] . ',' . $bptm_share_rgb['g'] . ',' . $bptm_share_rgb['b'] . ',' . $bptm_share_bg_opacity . ');';

				$custom_theme .= '}';
		}

		// Adding Custom Padding On Template Content & Widget Layout.

		$custom_theme .= '@media only screen and (min-width: 0px) and (max-width: 479px) {';

		$custom_theme .= '}';

		$custom_theme .= '@media only screen and (min-width: 480px) and (max-width: 1000px) {';

		$custom_theme .= '}';

		// Custom CSS

		$bptm_custom_css = '';

		if ( isset( $petitions_options['bptm_custom_css'] ) && $petitions_options['bptm_custom_css'] != '' ) {

				$bptm_custom_css = $petitions_options['bptm_custom_css'];
		}

		$custom_theme .= $bptm_custom_css;

		$custom_theme .= '</style>';

		echo $custom_theme;
	}
}
