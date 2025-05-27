<?php

/**
 * @package BwlPetitionsManager
 */

namespace BwlPetitionsManager\Base;

class AdminHelpers {


	/**
	 * @return [array]
	 */
	public static function localizeData() {

		/*
		* Example of accessing the data from JavaScript:
		* BafAdminData.baf_text_loading
		*/

		$localizeData = [
			'ajaxurl'              => esc_url( admin_url( 'admin-ajax.php' ) ),
			'baf_text_loading'     => esc_attr__( 'Loading .....', 'bwl_ptmn' ),
			'baf_pvc_required_msg' => esc_attr__( 'Purchase code is required!', 'bwl_ptmn' ),
			'baf_pvc_success_msg'  => esc_attr__( 'Purchase code verified. Reloading window in 3 seconds.', 'bwl_ptmn' ),
			'baf_pvc_failed_msg'   => esc_attr__( 'Unable to verify purchase code. Please try again or contact support team.', 'bwl_ptmn' ),
			'baf_pvc_remove_msg'   => esc_attr__( 'Are you sure to remove the license info?', 'bwl_ptmn' ),
			'baf_pvc_removed_msg'  => esc_attr__( 'Purchase code removed. Reloading window in 3 seconds.', 'bwl_ptmn' ),
			'product_id'           => BWL_BAF_CC_ID,
			'installation'         => get_option( BWL_BAF_INSTALLATION_TAG ),
			'baf_dir'              => BWL_BAFM_PLUGIN_DIR, // for tinymce editor.
			'baf_text_saving'      => esc_attr__( 'Saving', 'bwl_ptmn' ), // sort faq.
			'baf_text_saved'       => esc_attr__( 'Saved', 'bwl_ptmn' ), // sort faq.
		];
		return $localizeData;
	}

	public static function bafSetYoutubeLink( $link = '', $link_title = 'video tutorial' ) {

		if ( empty( $link ) ) { return '';
		}

		return '<a href="' . esc_url( $link ) . '" title="' . $link_title . '" class="bwl_youtube_link" target="_blank"><span class="dashicons dashicons-youtube"></span></a>';
	}
}
