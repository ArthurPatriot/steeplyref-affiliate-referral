<?php

/**
 * Fired during plugin activation
 *
 * @link       https://allsteeply.com
 * @since      1.0.0
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/includes
 * @author     Artur Khylskyi <arthur.patriot@gmail.com>
 */
class Steeply_Ref_Activator {

	/**
	 * Create Plugins Tables
	 *
	 * Long Description.
	 *
	 * @since    1.0.3
	 */
	public static function activate() {
		global $wpdb;

		$table_name = $wpdb->prefix.'st_refferals';

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {

			$create_query = "CREATE TABLE " . $table_name . " (
	                    id mediumint(7) NOT NULL AUTO_INCREMENT,
	                    user_id mediumint(7) NOT NULL,
	                    ref_user_id mediumint(7) NOT NULL,
	                    lvl tinyint(1) DEFAULT 1 NOT NULL,
	                    PRIMARY KEY  id (id),
	                    UNIQUE KEY id (id)
	                    );";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			dbDelta($create_query);

		}

	}

}
