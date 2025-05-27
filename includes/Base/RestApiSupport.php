<?php
namespace BUGTB\Base;

use BUGTB\Helpers\PluginConstants;

/**
 * Class RestApiSupport
 *
 * @since: 1.0.0
 * @package BUGTB
 */
class RestApiSupport {

    /**
	 * Register
	 */
	public function register() {
		$this->Initialize();
	}

    /**
	 * Initialize
	 */
	public function initialize() {
        add_action( 'rest_api_init', [ $this, 'register_petitions_api' ] );
        add_action( 'rest_api_init', [ $this, 'register_meta_fields' ] );
        // $this->register_petitions_meta();
	}

    /**
     * Register Petitions Meta.
     */
	public function register_petitions_meta() {

    }

    /**
     * Register Poll API.
     */
    public function register_petitions_api() {
        $rules = [
			'methods'             => \WP_REST_Server::READABLE,
			'callback'            => [ $this, 'get_the_response' ],
			'permission_callback' => '__return_true',
        ];

        // API PATH.
        // https://youdomain.com/wp-json/bwl-poll/v1/polls
        // https://youdomain.com/wp-json/bwl-poll/v1/polls?pollId=<ANY_NUMBER>
        register_rest_route( 'bptm/v1', 'petitions', $rules );

    }

    /**
     * Register Meta Fields.
     */
    public function register_meta_fields() {

        // register_rest_field('petitions', 'sign_count', [
        // 'get_callback' => function ( $post_arr ) {
        // return get_post_meta( $post_arr['id'], '_cmb_bptm_sign_lists', true );
        // },
        // 'schema' => [
        // 'description' => 'Sign Count',
        // 'type'        => 'integer', // Adjust if needed
        // 'context'     => [ 'view' ],
        // ],
        // ]);

        $prefix = '_cmb_bptm_';

        register_post_meta('petitions', "{$prefix}sign_lists", [
            'type'         => 'integer',
            'single'       => true,
            'show_in_rest' => true,
		]);
        register_post_meta('petitions', "{$prefix}about_title", [
            'type'         => 'string',
            'single'       => true,
            'show_in_rest' => true,
		]);
    }

    /**
     * Get Poll HTML Output.
     *
     * @param array $data Poll ID.
     * @return string
     */
    public function get_the_response( $data = [] ) {

        $petitionId = $data['petitionId'] ?? -1;

        if ( intval( $petitionId ) === 0 ) {
            return '<p>Petition Id is required!</p>';
        }

        $type = $data['type'] ?: '';

        if ( in_array( $type, PluginConstants::$gt_blocks,true ) ) {

            $shortcode = str_replace( '-', '_', "petition_$type" );

            return do_shortcode( "[{$shortcode} id='{$petitionId}' /]" );
        } else {
            return "<p>Invalid Type {$type}!</p>";
        }
    }
}
