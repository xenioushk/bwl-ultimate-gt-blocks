<?php
namespace BwlPetitionsManager\Base;

use Xenioushk\BwlPluginApi\Api\AjaxHandlers\AjaxHandlersApi;
use BwlPetitionsManager\Callbacks\AdminAjaxHandlers\SignDataCb;
use BwlPetitionsManager\Callbacks\AdminAjaxHandlers\DeleteSignCb;
use BwlPetitionsManager\Callbacks\AdminAjaxHandlers\ExternalForm\CreatePetitionCb;
use BwlPetitionsManager\Callbacks\AdminAjaxHandlers\ExternalForm\CheckUserEmail;
/**
 * Class for admin ajax handlers.
 *
 * @package BwlPetitionsManager
 */
class AdminAjaxHandlers {
	/**
	 * Ajax handlers api.
	 *
	 * @var object $ajax_handlers_api
	 */
	public $ajax_handlers_api;
	/**
	 * Sign data callback.
	 *
	 * @var object $sign_data_cb
	 */
	public $sign_data_cb;
	/**
	 * Delete sign callback.
	 *
	 * @var object $delete_sign_cb
	 */
	public $delete_sign_cb;


	/**
	 * Create petition callback.
	 *
	 * @var object $create_petition_cb
	 */
	private $create_petition_cb;


	/**
	 * Check user email callback.
	 *
	 * @var object $check_user_email_cb
	 */
	private $check_user_email_cb;

	/**
	 * Register admin ajax handlers.
	 */
	public function register() {

		$this->ajax_handlers_api   = new AjaxHandlersApi();
		$this->sign_data_cb        = new SignDataCb();
		$this->delete_sign_cb      = new DeleteSignCb();
		$this->create_petition_cb  = new CreatePetitionCb();
		$this->check_user_email_cb = new CheckUserEmail();

		// Do not change the tag.
		// If do so, you need to change in js file too.
		$requests = [
			[
				'tag'      => 'bptm_sign_stats',
				'callback' => [ $this->sign_data_cb, 'get_sign_data' ],
			],
			[
				'tag'      => 'bptm_delete_sign_data',
				'callback' => [ $this->delete_sign_cb, 'delete_sign_data' ],
			],
			[
				'tag'      => 'bptm_external_petition',
				'callback' => [ $this->create_petition_cb, 'save' ],
			],
			[
				'tag'      => 'bptm_check_user_email',
				'callback' => [ $this->check_user_email_cb, 'get_the_status' ],
			],

		];

		$this->ajax_handlers_api->add_ajax_handlers( $requests )->register();
	}
}
