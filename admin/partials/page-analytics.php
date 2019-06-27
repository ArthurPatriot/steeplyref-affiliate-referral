<?php
/**
 * Analytics Page Content
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

$table_referrals = ST_REFERRALS;
$table_users     = $wpdb->prefix . 'users';
$check_top_ref   = $wpdb->get_results( "SELECT DISTINCT ref_user_id, COUNT(id) AS count FROM $table_referrals ORDER BY count DESC LIMIT 10" );

$last_activity = $wpdb->get_results( "SELECT * FROM $table_referrals ORDER BY id LIMIT 10" );

$count_users_with = $wpdb->get_var( "SELECT COUNT(id) as count FROM $table_referrals WHERE date >= DATE_SUB(curdate(), interval 1 month)" );
$count_users_all  = $wpdb->get_var( "SELECT COUNT(id) as count FROM $table_users WHERE user_registered >= DATE_SUB(curdate(), interval 1 month)" );

if ( $count_users_with != null and $count_users_all != null ) {
	$count_users_without = $count_users_all - $count_users_with;
} else {
	$count_users_with    = 0;
	$count_users_without = 0;
}

?>
<div class="wrap">

	<h1><?php _e('SteeplyRef - Analytics', 'steeply-ref'); ?></h1>

    <div class="st-flex">

        <div class="st-flex-content">

            <div>
                <h2>Top 10 Referrer</h2>
            </div>

            <div class="st-widget">
	            <?php if ( $check_top_ref != null and $check_top_ref[0]->ref_user_id != 0 ) { ?>
                    <ol class="st-rounded-list">
			            <?php foreach ( $check_top_ref as $top_ref ) { ?>
                            <li>
                                <span><?= get_userdata( $top_ref->ref_user_id )->user_email; ?> - <?= $top_ref->count; ?> referrals</span>
                            </li>
			            <?php } ?>
                    </ol>
	            <?php } else { ?>
                    <p class="st-widget__title" style="margin-bottom: 0;">No one has registered yet.</p>
	            <?php } ?>
            </div>

        </div>


        <div class="st-flex-content">

            <div>
                <h2>Register Analytics</h2>
            </div>

            <div class="st-widget">
	            <?php if ( $count_users_with > 0 and $count_users_without > 0 ) { ?>
                    <canvas id="stRegisterStat" width="200px" height="165px"></canvas>
	            <?php } else { ?>
                    <p class="st-widget__title" style="margin-bottom: 0;">Not enough information to analyze.</p>
	            <?php } ?>
            </div>

        </div>

        <?php require_once plugin_dir_path(__FILE__).'part-flex-sidebar.php';?>

    </div>

    <h2>Last Activity</h2>

    <div style="overflow-x:auto; overflow-y: hidden;">
        <table class="st-table">
            <tr>
                <th>User ID</th>
                <th>User Email</th>
                <th>Referrer ID</th>
                <th>Referrer Email</th>
                <th>Date</th>
            </tr>
	        <?php if ( $last_activity != null and ! empty( $last_activity ) ) {
		        foreach ( $last_activity as $activity ) { ?>
                    <tr>
                        <td><?= $activity->user_id; ?></td>
                        <td><?= get_userdata( $activity->user_id )->user_email; ?></td>
                        <td><?= $activity->ref_user_id; ?></td>
                        <td><?= get_userdata( $activity->ref_user_id )->user_email; ?></td>
                        <td><?= $activity->date; ?></td>
                    </tr>
		        <?php }
	        } else { ?>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
	        <?php } ?>
        </table>
    </div>

	<div class="clear"></div>

	<?php if ( $count_users_with > 0 and $count_users_without > 0 ) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

        <script>
            var ctx = document.getElementById('stRegisterStat').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Register without referrals', 'Register with referral'],
                    datasets: [{
                        label: 'Register Analytics',
                        backgroundColor: ['#2980b9', '#2ecc71'],
                        data: [<?= $count_users_without; ?>,<?= $count_users_with; ?>]
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            });
        </script>
	<?php } ?>

</div>