<?php
global $current_user, $wpdb;

defined('ABSPATH') || exit;

$dismissed = get_option('newsletter_dismissed', []);

$user_count = Newsletter::instance()->get_user_count();

$is_administrator = current_user_can('administrator');

function newsletter_print_entries($group) {
    $entries = apply_filters('newsletter_menu_' . $group, []);
    if (!$entries) {
        return;
    }

    foreach ($entries as &$entry) {
        echo '<li><a href="', esc_attr($entry['url']), '">', $entry['label'], '</a></li>';
    }
}

$system_warnings = NewsletterSystemAdmin::instance()->get_warnings_count();
?>

<div id="tnp-menu">
    <ul>
        <li>
            <a href="?page=newsletter_main_index"><img src="<?php echo plugins_url('newsletter'); ?>/admin/images/logo.png" class="tnp-header-logo" style="vertical-align: bottom;"></a>

        </li>
        <li><a href="#"><i class="fas fa-users"></i> <?php _e('Subscribers', 'newsletter') ?></a>
            <ul>
                <li>
                    <a href="?page=newsletter_users_index"><?php _e('All subscribers', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_profile_index"><?php _e('Profile page', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_unsubscription_index"><?php _e('Unsubscription', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('subscribers') ?>

                <li>
                    <a href="?page=newsletter_users_statistics"><?php _e('Statistics', 'newsletter') ?></a>
                </li>

                <?php if (!class_exists('NewsletterImport')) { ?>
                    <li>
                        <a href="?page=newsletter_users_import"><?php _e('Import', 'newsletter') ?></a>
                    </li>
                <?php } ?>

                <li>
                    <a href="?page=newsletter_users_export"><?php _e('Export', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_users_massive"><?php _e('Maintenance', 'newsletter') ?></a>
                </li>


            </ul>
        </li>
        <li><a href="#"><i class="fas fa-list"></i> <?php _e('Subscription', 'newsletter') ?></a>
            <ul>

                <li>
                    <a href="?page=newsletter_subscription_options"><?php _e('Settings', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_sources"><?php _e('Forms', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_lists"><?php _e('Lists', 'newsletter') ?></a>
                </li>
                <li>
                    <a href="?page=newsletter_subscription_customfields"><?php _e('Custom fields', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_antispam"><?php _e('Antispam', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_unsubscription_index"><?php _e('Unsubscription', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('subscription') ?>
            </ul>
        </li>

        <li>
            <a href="#"><i class="fas fa-newspaper"></i> <?php _e('Newsletters', 'newsletter') ?></a>
            <ul>
                <li>
                    <a href="?page=newsletter_emails_index"><?php _e('All newsletters', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_emails_composer"><?php _e('Create newsletter', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_emails_presets"><?php _e('Templates', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="<?php echo NewsletterStatisticsAdmin::instance()->get_index_url() ?>"><?php _e('Statistics', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('newsletters') ?>
            </ul>
        </li>

        <li>
            <a href="#"><i class="fas fa-cog"></i> <?php _e('Settings', 'newsletter') ?></a>
            <ul>
                <?php if ($is_administrator) { ?>
                    <li>
                        <a href="?page=newsletter_main_main"><?php _e('General Settings', 'newsletter') ?></a>
                    </li>
                <?php } ?>

                <li>
                    <a href="?page=newsletter_main_info"><?php _e('Company Info', 'newsletter') ?></a>
                </li>

                <li>
                    <a href="?page=newsletter_subscription_template"><?php _e('Messages Template', 'newsletter') ?></a>
                </li>

                <?php newsletter_print_entries('settings') ?>
            </ul>
        </li>

        <?php if ($is_administrator) { ?>
            <li>
                <a href="#">
                    <?php if ($system_warnings['total']) { ?>
                        <i class="fas fa-exclamation-triangle" style="color: red;"></i>
                    <?php } else { ?>
                        <i class="fas fa-thermometer"></i>
                    <?php } ?>
                    <?php esc_html_e('Help', 'newsletter') ?>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo esc_attr(admin_url('site-health.php')) ?>"><?php esc_html_e('WP Site Health') ?></a>
                    </li>
                    <li>
                        <a href="?page=newsletter_system_status"><?php esc_html_e('System', 'newsletter') ?>
                            <?php if ($system_warnings['status']) { ?>
                                <i class="fas fa-exclamation-triangle tnp-menu-warning" style="color: red;"></i>
                            <?php } ?>
                        </a>
                    </li>

                    <li><a href="?page=newsletter_system_delivery"><?php esc_html_e('Delivery', 'newsletter') ?></a></li>

                    <?php if (class_exists('NewsletterExtensions')) { ?>
                        <li>
                            <a href="?page=newsletter_extensions_support"><?php esc_html_e('Support', 'newsletter') ?></a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="?page=newsletter_system_support"><?php esc_html_e('Support', 'newsletter') ?></a>
                        </li>
                    <?php } ?>

                        <li><a href="?page=newsletter_system_logs"><?php esc_html_e('Logs', 'newsletter') ?></a></li>
                    <li>
                        <a href="https://www.thenewsletterplugin.com/documentation/developers/backup-recovery/" target="_blank"><?php _e('Backup', 'newsletter') ?></a>
                    </li>
                </ul>
            </li>
        <?php } ?>

        <?php
        $license_data = Newsletter::instance()->get_license_data();
        $premium_url = 'https://www.thenewsletterplugin.com/premium?utm_source=header&utm_medium=link&utm_campaign=plugin&utm_content=' . urlencode($_GET['page']);
        ?>

        <?php if (empty($license_data)) { ?>

            <li class="tnp-licence-button"><a href="<?php echo $premium_url ?>" target="_blank">
                    <i class="fas fa-trophy"></i> <?php _e('Get Professional Addons', 'newsletter') ?></a>
            </li>

        <?php } elseif (is_wp_error($license_data)) { ?>

            <li class="tnp-licence-button-red">
                <a href="?page=newsletter_main_main"><i class="fas fa-hand-paper" style="color: white"></i> <?php _e('Unable to check', 'newsletter') ?></a>
            </li>

        <?php } elseif ($license_data->expire == 0) { ?>

            <li class="tnp-licence-button">
                <a href="<?php echo $premium_url ?>" target="_blank"><i class="fas fa-trophy"></i> <?php _e('Get Professional Addons', 'newsletter') ?></a>
            </li>

        <?php } elseif ($license_data->expire < time()) { ?>

            <li class="tnp-licence-button-red">
                <a href="?page=newsletter_main_main"><i class="fas fa-hand-paper" style="color: white"></i> <?php _e('License expired', 'newsletter') ?></a>
            </li>

        <?php } elseif ($license_data->expire >= time()) { ?>

            <?php $p = class_exists('NewsletterExtensions') ? 'newsletter_extensions_index' : 'newsletter_main_extensions'; ?>
            <li class="tnp-licence-button">
                <a href="?page=<?php echo $p ?>"><i class="fas fa-check-square"></i> <?php _e('License active', 'newsletter') ?></a>
            </li>

        <?php } ?>
    </ul>
</div>

<?php
$news = NewsletterMainAdmin::instance()->get_news();
?>

<?php foreach ($news as $n) { ?>
    <div class="tnp-news">
        <a href="<?php echo esc_attr(($_SERVER['REQUEST_URI'] . '&news=' . urlencode($n['id']))) ?>" class="tnp-news-dismiss">&times;</a>
        <div class="tnp-news-message"><?php echo esc_html($n['message']) ?></div>
        <div class="tnp-news-cta">
            <a class="tnp-news-link" href="<?php echo esc_attr($n['url']) ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($n['label']) ?></a>
        </div>
    </div>
    <?php break; ?>
<?php } ?>

<?php
if (!empty(NewsletterMainAdmin::instance()->get_option('page'))) {
    $tnp_page_id = NewsletterMainAdmin::instance()->get_option('page');
    if (get_post_status($tnp_page_id) !== 'publish') {
        echo '<div class="tnp-notice tnp-notice-warning">The Newsletter public page is not published. <a href="', esc_attr(admin_url('post.php')) . '?post=', esc_attr($tnp_page_id), '&action=edit"><strong>Edit the page</strong></a> or <a href="admin.php?page=newsletter_main_main"><strong>review the main settings</strong></a>.</div>';
    } else if (NEWSLETTER_PAGE_WARNING) {
        $content = get_post_field('post_content', $tnp_page_id);
        // With and without attributes
        if (strpos($content, '[newsletter]') === false && strpos($content, '[newsletter ') === false) {
            ?>
            <div class="tnp-notice tnp-notice-warning">
                The Newsletter public page does not contain the <code>[newsletter]</code> shortcode.
                <a href="<?php echo esc_attr(admin_url('post.php')) ?>?post=<?php echo esc_attr($tnp_page_id) ?>&action=edit"><strong>Edit the page</strong></a>.
                <br>
            </div>
            <?php
        }
    }
} else {
    /*
      <div class="tnp-notice">
      <a href="<?php echo esc_attr($_SERVER['REQUEST_URI']) . '&noheader=1&dismiss=newsletter-page' ?>" class="tnp-dismiss">&times;</a>

      You should create a blog page to show the subscription form and the subscription messages. Go to the
      <a href="?page=newsletter_main_main">general settings panel</a> to configure it.

      </div>
     */
}
?>

<?php if (isset($_GET['debug']) || !isset($dismissed['rate']) && $user_count > 300) { ?>
    <div class="tnp-notice">
        <a href="<?php echo esc_attr($_SERVER['REQUEST_URI']) . '&noheader=1&dismiss=rate' ?>" class="tnp-dismiss">&times;</a>

        We never asked before and we're curious: <a href="http://wordpress.org/plugins/newsletter/" target="_blank">would you rate this plugin</a>?
        (few seconds required - account on WordPress.org required, every blog owner should have one...). <strong>Really appreciated, The Newsletter Team</strong>.

    </div>
<?php } ?>

<?php if (isset($_GET['debug']) || !isset($dismissed['newsletter-subscribe']) && get_option('newsletter_install_time') && get_option('newsletter_install_time') < time() - 86400 * 15) { ?>
    <div class="tnp-notice">
        <a href="<?php echo esc_attr($_SERVER['REQUEST_URI']) . '&noheader=1&dismiss=newsletter-subscribe' ?>" class="tnp-dismiss">&times;</a>
        Subscribe to our news, promotions and getting started lessons!
        Proceeding you agree to the <a href="https://www.thenewsletterplugin.com/privacy" target="_blank">privacy policy</a>.
        <br><br>
        <form action="https://www.thenewsletterplugin.com/?na=s" target="_blank" method="post">
            <input type="hidden" value="plugin-header" name="nr">
            <input type="hidden" value="3" name="nl[]">
            <input type="hidden" value="1" name="nl[]">
            <input type="hidden" value="double" name="optin">
            <input type="email" name="ne" value="<?php echo esc_attr('') ?>">
            <input type="submit" class="button-primary" value="<?php esc_attr_e('Subscribe', 'newsletter') ?>">
        </form>
    </div>
<?php } ?>

<?php
if (!defined('NEWSLETTER_CRON_WARNINGS') || NEWSLETTER_CRON_WARNINGS) {
    $x = NewsletterSystemAdmin::instance()->get_job_status();
    if ($x !== NewsletterSystemAdmin::JOB_OK) {
        echo '<div class="tnp-notice tnp-notice-warning">There are issues with the delivery engine. Please <a href="?page=newsletter_system_scheduler">check them here</a>.</div>';
    }
}
?>

<?php
if ($_GET['page'] !== 'newsletter_emails_edit') {

    $last_failed_newsletters = Newsletter::instance()->get_emails_by_status(TNP_Email::STATUS_ERROR);
    if (false && $last_failed_newsletters) {
        $c = new NewsletterControls();
        foreach ($last_failed_newsletters as $n) {
            echo '<div class="tnp-notice tnp-notice-warning">';
            printf(__('Newsletter "%s" stopped by fatal error.', 'newsletter'), esc_html($n->subject));
            echo '&nbsp;';

            $c->btn_link('?page=newsletter_emails_edit&id=' . $n->id, __('Check', 'newsletter'));
            echo '</div>';
        }
    }
}
?>

<?php
if (!Newsletter::instance()->get_newsletter_page()) {
    echo '<div class="tnp-notice tnp-notice-warning">The unstyled page option will be removed shortly. Please select a dedicated page on <a href="?page=newsletter_main_main">main settings</a>.</div>';
}
?>




