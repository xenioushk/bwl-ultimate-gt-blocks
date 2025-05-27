<?php

namespace BwlPetitionsManager\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
use BwlPetitionsManager\Callbacks\FrontendAjaxHandlers\SaveSignCb;

/**
 * Class for frontend ajax handlers.
 *
 * @package BwlPetitionsManager
 * @since: 1.1.0
 * @author: Mahbub Alam Khan
 */
class FrontendAjaxHandlers {

	/**
	 * Instance of the ajax handlers API.
	 *
	 * @var object $ajax_handlers_api AjaxHandlersApi.
	 */
	public $ajax_handlers_api;

	/**
	 * Instance of the SaveSignCb.
	 *
	 * @var object $save_sign_cb SaveSignCb.
	 */
	public $save_sign_cb;

	/**
	 * Register frontend ajax handlers.
	 */
	public function register() {

		$this->ajax_handlers_api = new AjaxHandlersApi();

		// Initalize Callbacks.
		$this->save_sign_cb = new SaveSignCb();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$requests = [

			[
				'tag'      => 'bwl_petitions_save_post_data',
				'callback' => [ $this->save_sign_cb, 'save_data' ],
			],

		];

		$this->ajax_handlers_api->add_ajax_handlers( $requests )->register();
	}
}
