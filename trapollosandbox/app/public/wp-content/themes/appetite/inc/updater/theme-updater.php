<?php
/**
 * Theme Updater.
 */

$support = get_theme_support( 'themes-harbor-edd-license' );

if ( ! empty( $support[0] ) && isset( $support[0]['theme-slug'] ) && isset( $support[0]['download-id'] ) ) {
    $theme_slug = $support[0]['theme-slug'];
    $download_id = $support[0]['download-id'];
} else {
    return;
}

// Includes the files needed for the theme updater
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => wp_get_theme( $theme_slug )->get( 'AuthorURI' ), // Site where EDD is hosted
		'item_name' => wp_get_theme( $theme_slug )->get( 'Name' ), // Name of theme
		'theme_slug' => wp_get_theme( $theme_slug )->get( 'TextDomain' ), // Theme slug
		'version' => wp_get_theme( $theme_slug )->get( 'Version' ), // The current version of this theme
		'author' => wp_get_theme( $theme_slug )->get( 'Author' ), // The author of this theme
		'download_id' => intval( $download_id ), // Optional, used for generating a license renewal link
		'renew_url' => '', // Optional, allows for a custom license renewal link
        'beta' => false, // Optional, set to true to opt into beta versions
	),

    $strings = array(
        'status' => array(
            'error' => esc_html__( 'Error', 'appetite' ),
        ),
        'notice' => array(
            'is_latest_verion' => esc_html( 'You have the latest version', 'appetite' ),
            'is_outdated_verion' => esc_html( 'You have an outdated version', 'appetite' ),
            'update_available' => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'appetite' ),
            'new_version_available' => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a>. Note, the theme must be <a href="%5$s">activated with a valid theme license key</a> in order to receive updates.', 'appetite' ),
            'expires_%s' => esc_html__( 'It expires on %s.', 'appetite' ),
            '%1$s_%2$_sites' => esc_html__( 'You have %1$s / %2$s sites activated.', 'appetite' ),
            'license_keys_dont_match' => esc_html__( 'License keys do not match.', 'appetite' ),
            'site_is_inactive' => esc_html__( 'Your license is not active for this URL.', 'appetite' ),
            'license_is_disabled' => esc_html__( 'Your license key is disabled.', 'appetite' ),
            'license_is_inactive' => esc_html__( 'Your license key is inactive.', 'appetite' ),
            'license_is_active' => esc_html__( 'Your license key is active.', 'appetite' ),
            'license_is_revoked' => esc_html__( 'Your license key has been disabled.', 'appetite' ),
            'license_is_invalid' => esc_html__( 'Invalid license.', 'appetite' ),
            'status_unknown' => esc_html__( 'License status is unknown.', 'appetite' ),
            'license_status_unknown' => esc_html__( 'License status is unknown.', 'appetite' ),
            'update_notice' => esc_html__( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'appetite' ),
            'license_key_expired_%s' => esc_html__( 'Your license key expired on %s.', 'appetite' ),
            'license_key_expired' => esc_html__( 'Your license key has expired.', 'appetite' ),
            'license_expires_never' => esc_html__( 'Lifetime License.', 'appetite' ),
            'feed_error' => esc_html__( 'This documentation file feed seems to be temporarily down. You can always view it on Themes Harbor in the meantime.', 'appetite' ),
            'latest_updates_error' => esc_html__( 'There seems to be a temporary problem retrieving the latest updates for this theme.', 'appetite' ),
            'unlimited' => esc_html__( 'unlimited', 'appetite' ),
            'error_occurred' => esc_html__( 'An error occurred, please try again.', 'appetite' ),
            'no_activations_left' => esc_html__( 'Your license key has reached its activation limit.', 'appetite' ),
            'item_name_mismatch_%s' => esc_html__( 'This appears to be an invalid license key for %s.', 'appetite' ),
        ),
        'action' => array(
            'locate_license' => esc_html__( 'Locate a license key', 'appetite' ),
            'activate_license' => esc_html__( 'Activate license key', 'appetite' ),
            'save_license' => esc_html__( 'Save license key', 'appetite' ),
            'deactivate_license' => esc_html__( 'Deactivate license key', 'appetite' ),
            'dismiss_notice' => esc_html__( 'Dismiss this notice', 'appetite' ),
            'renew_license' => esc_html__( 'Renew?', 'appetite' ),
            'open_documentation' => esc_html__( 'Open documentation', 'appetite' ),
            'open_changelogs' => esc_html__( 'Open changelogs', 'appetite' ),
            'ask_question' => esc_html__( 'Ask a question', 'appetite' ),
            'read_support_policy' => esc_html__( 'Read support policy', 'appetite' ),
            'view_update_guide' => esc_html__( 'View update guide', 'appetite' ),
        ),
        'label' => array(
            'license_key_activation' => esc_html__( 'License key activation', 'appetite' ),
            'theme_info' => esc_html__( 'Theme Info', 'appetite' ),
            'theme_author' => esc_html__( 'Created by: %s', 'appetite' ),
            'theme_version' => esc_html__( 'Version: %s', 'appetite' ),
            'documentation' => esc_html__( 'Documentation', 'appetite' ),
            'changelog' => esc_html__( 'Changelog', 'appetite' ),
            'enter_key' => esc_html__( 'Enter your theme license key and save it.', 'appetite' ),
            'license_key' => esc_html__( 'License key', 'appetite' ),
            'here_to_help' => esc_html__( 'We are here to help!', 'appetite' ),
        ),
        'text' => array(
            'documentation' => esc_html__( 'Our efforts go into making installation as easy as possible for you. Click the button below to open a step by step guide on how to set up your current theme.', 'appetite' ),

            'changelog' => esc_html__( 'Our themes are compatible with the latest WordPress version and we perform tests and updates on a regular basis to keep them safe and stable. Click the button below to see changelogs.', 'appetite' ),

            'help' => esc_html__( 'Still cannot find your answer in documentation? Our support team is always available to answer any questions you may have.', 'appetite' ),

            'theme_update_notice' => esc_html__( 'Your site is running an outdated version of the theme. Updating your WordPress site is essential to maintaining uptime, enabling new features, preventing security vulnerabilities and fixing performance issues.', 'appetite' ),
        ),
    )
);
