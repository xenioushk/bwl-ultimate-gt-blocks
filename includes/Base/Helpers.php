<?php
namespace BwlPetitionsManager\Base;

use BwlPetitionsManager\Base\BaseController;


/**
 * Class to setup the plugin required services.
 *
 * @package BwlPetitionsManager
 */
class Helpers extends BaseController {


	const BPTM_USER_SIGN_SUBJECT_TPL = 'Thank you for signing this petition!';
	const BPTM_USER_SIGN_HEADER_TPL  = 'Petition Signed';

	public static function get_bptm_user_sign_tpl_text() {

		$bptm_user_sign_tpl_text = '<p>Hello {bptm_user_name},
<br>
Thank you for signing this petition! We have added your name to this petition. Sharing this petition with friends will help us make a bigger impact.<br>
Have a wonderful day!</p>';

		return $bptm_user_sign_tpl_text;
	}

	public static function getDefaultSignFormShortcode() {
		$shortcode = '[bpsff ft="input" fn="bpt_user_name" fp="Name" fr=1/]
[bpsff ft="input" fn="bpt_user_email" fp="Email" fr=1/]
[bpsff ft="input" rs=0 cc="1" fn="bpt_user_address" fp="Address" fr=1 sts="0"/]
[bpsff ft="country" fp="Country" sts="0" fr=1/]
[bpsff ft="captcha" fn="captcha" fr=1 sts="0"/]
[bpsff ft="textarea" rs=0 cc="1" fn="bpt_user_msg" fp="Message" sts="0"/]';

		return $shortcode;
	}

	public static function pluginVersionManager() {

		$installedVersion = get_option( 'bptm_plugin_version' );

		if ( empty( $installedVersion ) || ( $installedVersion != BPTM_PLUGIN_VERSION ) ) {
			update_option( 'bptm_plugin_version', BPTM_PLUGIN_VERSION );
		}

		return BPTM_PLUGIN_VERSION;
	}


	public static function getApiUrlStatus() {
		$headers = @get_headers( self::getApiUrl() );

		if (
		( $headers && strpos( $headers[0], '200' ) != false ) ||
		( $headers && strpos( $headers[8], 'BxWxL AxPxI' ) != false )
		) {
			return true; // URL is live
		} else {
			return false; // URL is not live
		}
	}

	public static function getApiUrl() {
		$baseUrl = get_home_url();
		if ( strpos( $baseUrl, 'localhost/dev.plugin/bkbm' ) != false ) {
			return 'http://localhost/bwl_api/';
		} elseif ( strpos( $baseUrl, 'staging.bluewindlab.com' ) != false ) {
			return 'https://staging.bluewindlab.com/bwl_api/';
		} else {
			return 'https://api.bluewindlab.net/';
		}
	}
}
