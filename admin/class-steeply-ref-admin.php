<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://allsteeply.com
 * @since      1.0.0
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/admin
 * @author     Artur Khylskyi <arthur.patriot@gmail.com>
 */
class Steeply_Ref_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Steeply_Ref_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Steeply_Ref_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/steeply-ref-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Steeply_Ref_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Steeply_Ref_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/steeply-ref-admin.js', array( 'jquery' ), $this->version, false );

	}

	static function render_page_general_settings() {
		require_once plugin_dir_path(__FILE__) . 'partials/page-general-settings.php';
	}

	static function render_page_analytics() {
		require_once plugin_dir_path(__FILE__) . 'partials/page-analytics.php';
	}

	static function render_page_faq() {
		require_once plugin_dir_path(__FILE__) . 'partials/page-faq.php';
	}

	public function add_plugin_pages() {

		add_menu_page( 'SteeplyRef - General Settings', 'SteeplyRef', 'manage_options', 'steeply-ref-general-settings', array( $this, 'render_page_general_settings' ), 'dashicons-image-filter', 25.3 );

		add_submenu_page( 'steeply-ref-general-settings', 'SteeplyRef - General Settings', 'General Settings', 'manage_options', 'steeply-ref-general-settings' );

		add_submenu_page( 'steeply-ref-general-settings', 'SteeplyRef - Analytics', 'Analytics', 'manage_options', 'steeply-ref-analytics', array( $this, 'render_page_analytics' ) );

		add_submenu_page( 'steeply-ref-general-settings', 'SteeplyRef - FAQ', 'FAQ', 'manage_options', 'steeply-ref-faq', array( $this, 'render_page_faq' ) );

	}

	static function render_dashboard_widget() {
		require_once plugin_dir_path(__FILE__) . 'partials/dashboard-widget.php';
	}

	public function add_plugin_dashboard_widget() {

		wp_add_dashboard_widget( 'steeply-ref-dash', 'SteeplyRef - Brief Summary', array( $this, 'render_dashboard_widget' ) );

	}

	public function check_is_referral_link() {
		if (isset($_GET['sp_ref']) and !empty($_GET['sp_ref'])) {
			$_SESSION['ref_user_id'] = htmlspecialchars(settype($_GET['sp_ref'], 'int'));
		}
	}
	
	public function registered_is_referral( $user_id ) {

		if (isset($_SESSION['ref_user_id']) and !empty($_SESSION['ref_user_id'])) {
			global $wpdb;

			$ref_user_id = $_SESSION['ref_user_id'];

			if (get_user_by('ID', $ref_user_id) == false) { return; }

			$table_name = $wpdb->prefix.'st_referrals';

			$insert_data = array(
				'user_id' => $user_id,
				'ref_user_id' => $ref_user_id,
			);

			$wpdb->insert($table_name, $insert_data);

		}

	}

}
