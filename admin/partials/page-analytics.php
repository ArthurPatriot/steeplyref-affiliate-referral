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
<div class="wrap">

	<h1><?php _e('SteeplyRef - Analytics', 'steeply-ref'); ?></h1>

    <div class="st-flex">

        <div class="st-flex-content">

            <div>
                <h2>Top Referrals</h2>
            </div>

            <div class="st-widget">
                <ol class="st-rounded-list">
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                    <li><span>Some Name</span></li>
                </ol>
            </div>

        </div>


        <div class="st-flex-content">

            <div>
                <h2>Register Analytics</h2>
            </div>

            <div class="st-widget">
                <canvas id="stRegisterStat" width="200px" height="165px"></canvas>
            </div>

        </div>

        <?php require_once plugin_dir_path(__FILE__).'part-flex-sidebar.php';?>

    </div>

    <h2>Last Activity</h2>

    <div style="overflow-x:auto;">
        <table class="st-table">
            <tr>
                <th>ID</th>
                <th>User Email</th>
                <th>Referrer ID</th>
                <th>Referrer Email</th>
                <th>Date</th>
            </tr>
            <tr>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
            </tr>
            <tr>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
            </tr>
            <tr>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
                <td>Some</td>
            </tr>
        </table>
    </div>

	<div class="clear"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>

    <script>
        var ctx = document.getElementById('stRegisterStat').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: ['Register without referrals', 'Register with referral'],
                datasets: [{
                    label: 'Register Analytics',
                    backgroundColor: ['#2980b9', '#2ecc71'],
                    data: [567, 923]
                }]
            },

            // Configuration options go here
            options: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        });
    </script>

</div>