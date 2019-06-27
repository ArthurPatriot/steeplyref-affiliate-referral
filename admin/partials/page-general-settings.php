<?php
/**
 * General Settings Page Content
 *
 * @link       https://allsteeply.com
 * @since      1.0.1
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/admin/partials
 */
?>

<?php
global $wpdb;

/**
 * Table ST_REFERRALS Exist check
 */
$table_referrals = ST_REFERRALS;
if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_referrals'" ) == $table_referrals ) {
	$table_referrals_class = 'st-line-success';
	$table_referrals_text  = 'TABLE ' . ST_REFERRALS . ' EXISTS';
} else {
	$table_referrals_class = 'st-line-danger';
	$table_referrals_text  = 'TABLE ' . ST_REFERRALS . ' NOT EXISTS';
}

/**
 * Session Start Check
 */
if ( session_id() ) {
	$check_ses_class = 'st-line-success';
	$check_ses_text  = 'PHP SESSION OK';
} else {
	$check_ses_class = 'st-line-danger';
	$check_ses_text  = 'PHP SESSION ERROR';
}

/**
 *
 */
if ( phpversion() > 5.5 ) {
	$check_php_class = 'st-line-success';
	$check_php_text  = 'PHP ' . phpversion() . ' ACTUAL';
} else {
	$check_php_class = 'st-line-danger';
	$check_php_text  = 'PHP ' . phpversion() . ' OUTDATED';
}

global $wp_version;
if ( $wp_version > 5.0 ) {
	$check_wp_class = 'st-line-success';
	$check_wp_text  = 'WORDPRESS VERSION ' . $wp_version . ' ACTUAL';
} else {
	$check_wp_class = 'st-line-danger';
	$check_wp_text  = 'WORDPRESS VERSION ' . $wp_version . ' OUTDATED';
}

?>

<div class="wrap">

	<h1><?php _e('SteeplyRef - General Settings', 'steeply-ref'); ?></h1>

    <div class="st-flex">

        <div class="st-flex-content">

            <div>
                <h2>Settings</h2>
            </div>

            <div class="st-widget">
                <form action="options.php" method="POST">
		            <?php
		            settings_fields( 'st-general-settings-section' );
		            do_settings_sections( 'steeply-ref-general-settings' );
		            submit_button();
		            ?>
                </form>
            </div>

        </div>


        <div class="st-flex-content">

            <div>
                <h2>Status Console</h2>
            </div>

            <div class="st-widget <?= $check_ses_class; ?>">
                <p class="st-widget__title" style="margin-bottom: 0"><?= $check_ses_text; ?></p>
            </div>

            <div class="st-widget <?= $table_referrals_class; ?>">
                <p class="st-widget__title" style="margin-bottom: 0"><?= $table_referrals_text; ?></p>
            </div>

            <div class="st-widget <?= $check_php_class; ?>">
                <p class="st-widget__title" style="margin-bottom: 0"><?= $check_php_text; ?></p>
            </div>

            <div class="st-widget <?= $check_wp_class; ?>">
                <p class="st-widget__title" style="margin-bottom: 0"><?= $check_wp_text; ?></p>
            </div>

        </div>

		<?php require_once plugin_dir_path(__FILE__).'part-flex-sidebar.php';?>

    </div>

	<div class="clear"></div>

</div>