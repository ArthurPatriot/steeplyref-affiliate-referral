<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://allsteeply.com
 * @since      1.0.0
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/includes
 * @author     Artur Khylskyi <arthur.patriot@gmail.com>
 */
class Steeply_Ref_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'steeplyref-affiliate-referral',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
