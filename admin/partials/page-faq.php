<?php
/**
 * FAQ Page Content
 *
 * @link       https://allsteeply.com
 * @since      1.0.1
 *
 * @package    Steeply_Ref
 * @subpackage Steeply_Ref/admin/partials
 */
?>
<div class="wrap">

    <h1><?php _e( 'SteeplyRef - FAQ', 'steeplyref-affiliate-referral' ); ?></h1>

    <div class="st-flex">

        <div class="st-flex-content">

            <div>
                <h2>User Guide</h2>
            </div>

            <div class="st-widget st-blue">
                <p class="st-widget__title">Referral Link Shortcode</p>
                <input readonly type="text" class="st-widget__shortcode" value="[st_ref_link]">
            </div>

            <div class="st-widget st-blue">
                <p class="st-widget__title">Referral Count Shortcode</p>
                <input readonly type="text" class="st-widget__shortcode" value="[st_ref_count]">
            </div>

            <div class="st-widget st-blue">
                <p class="st-widget__title">Referrer Top List</p>
                <p class="st-widget__text">Shortcode has optional attribute 'top', on default = 3.</p>
                <input readonly type="text" class="st-widget__shortcode" value="[st_ref_top_list top='10']">
            </div>

        </div>


        <div class="st-flex-content">

            <div>
                <h2>Developer Guide</h2>
            </div>

            <div class="st-widget st-info">
                <p class="st-widget__title">Example Referral Link</p>
                <input readonly type="text" class="st-widget__shortcode" value="<?= home_url(); ?>/?st_ref=[user_id]">
            </div>

        </div>

	    <?php require_once plugin_dir_path(__FILE__).'part-flex-sidebar.php';?>

    </div>

    <h2>FAQ</h2>

    <div class="st-flex">

        <div class="st-flex-content st-faq">

            <div class="st-widget">
                <p class="st-widget__faq-title"><span class="dashicons dashicons-format-status"></span> HOW?</p>
                <p class="st-widget__faq-text"><span class="dashicons dashicons-yes-alt"></span> HOW!</p>
            </div>

        </div>


        <div class="st-flex-content st-faq">

            <div class="st-widget">
                <p class="st-widget__faq-title"><span class="dashicons dashicons-format-status"></span> HOW?</p>
                <p class="st-widget__faq-text"><span class="dashicons dashicons-yes-alt"></span> HOW!</p>
            </div>

        </div>

    </div>

	<div class="clear"></div>

</div>