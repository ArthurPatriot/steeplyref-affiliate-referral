<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://allsteeply.com
 * @since      1.0.0
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/public
 * @author     Artur Khylskyi <arthur.patriot@gmail.com>
 */
class Steeply_Ref_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/steeply-ref-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/steeply-ref-public.js', array( 'jquery' ), $this->version, false );

	}

	public function catch_dashboard_page( $template ) {

		global $post;

		if ( $post->ID == get_option( 'st_settings_pg_dashboard' ) ) {

			return plugin_dir_path( __FILE__ ) . 'partials/page-dashboard.php';

		}

		return $template;

	}

	public function shortcode_referral_link() {

		$user_id = get_current_user_id();

		if ( ! $user_id ) {
			return '';
		}

		$ref_link = home_url() . '/?st_ref=' . $user_id;

		return $ref_link;

	}

	public function shortcode_referral_count() {
		global $wpdb;

		$user_id = get_current_user_id();

		if ( ! $user_id ) {
			return '0';
		}

		$table_name = ST_REFERRALS;
		$check      = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name WHERE ref_user_id = $user_id" );

		if ( $check == null or empty( $check ) ) {
			return '0';
		}

		return $check;

	}

	public function shortcode_referral_top_list( $atts ) {
		global $wpdb;

		$atts = shortcode_atts( array(
			'top'    => 3,
			'render' => true
		), $atts );

		$table_name = ST_REFERRALS;
		$limit      = $atts['top'];

		$check = $wpdb->get_results( "SELECT DISTINCT ref_user_id, COUNT(id) AS count FROM $table_name GROUP BY ref_user_id ORDER BY count DESC LIMIT $limit" );

		if ( $check == null or $check[0]->ref_user_id == null ) {
			return '';
		}

		if ( ! $atts['render'] ) {
			return $check;
		}

		ob_start(); ?>
        <ol class="st-top-list">
			<?php foreach ( $check as $item ) { ?>
                <li><?= get_userdata( $item->ref_user_id )->display_name; ?> - <?= $item->count; ?></li>
			<?php } ?>
        </ol>
		<?php return ob_get_clean();

	}

}
