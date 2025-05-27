<?php
namespace BUGTB\Base;

// use BUGTB\Controllers\DataBase\PetitionTables;
/**
 * Class for plucin activation.
 *
 * @since: 1.1.0
 * @package BUGTB
 */
class Activate {

	/**
	 *  Instance of the WPDB.
	 *
	 * @var object $wpdb
	 */
	private $wpdb;

	/**
	 * Constructor for the class.
	 *
	 * @param object $wpdb  Instance of the WPDB.
	 */
	public function __construct( $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
	 * Activate the plugin.
	 */
	public function activate() { // phpcs:ignore
		flush_rewrite_rules();
		set_transient( 'bugtb_activation_redirect', true, 5 );
	}

	/**
	 * Create database tables.
	 */
	public function create_db_tables() {

		// $petition_tables = new PetitionTables( $this->wpdb );
		// $petition_tables->register();
	}
}
