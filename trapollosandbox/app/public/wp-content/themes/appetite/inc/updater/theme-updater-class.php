<?php
/**
 * Theme updater class.
 */

class EDD_Theme_Updater {

	private $remote_api_url;
	private $request_data;
	private $response_key;
	private $theme_slug;
	private $license_key;
	private $license_status;
	private $version;
	private $author;
	protected $strings = null;


	/**
	 * Initiate the Theme updater
	 *
	 * @param array $args    Array of arguments from the theme requesting an update check
	 * @param array $strings Strings for the update process
	 */
	function __construct( $args = array(), $strings = array() ) {

		$defaults = array(
			'remote_api_url' => '',
			'request_data' => array(),
			'theme_slug' => get_template(), // use get_stylesheet() for child theme updates
			'item_name' => '',
			'license_status' => '',
			'license' => '',
			'version' => '',
			'author' => '',
			'beta' => false,
		);

		$args = wp_parse_args( $args, $defaults );

		$this->license = $args['license'];
		$this->license_status = $args['license_status'];
		$this->item_name = $args['item_name'];
		$this->version = $args['version'];
		$this->theme_slug = sanitize_key( $args['theme_slug'] );
		$this->author = $args['author'];
		$this->beta = $args['beta'];
		$this->remote_api_url = $args['remote_api_url'];
		$this->response_key = $this->theme_slug . '-' . $this->beta . '-update-response';
		$this->strings = $strings;

		add_filter( 'site_transient_update_themes',        array( $this, 'theme_update_transient' ) );
		add_filter( 'delete_site_transient_update_themes', array( $this, 'delete_theme_update_transient' ) );
		add_action( 'load-update-core.php',                array( $this, 'delete_theme_update_transient' ) );
		add_action( 'load-themes.php',                     array( $this, 'delete_theme_update_transient' ) );
		add_action( 'load-themes.php',                     array( $this, 'load_themes_screen' ) );
	}

	/**
	 * Show the update notification when neecessary
	 *
	 * @return void
	 */
	function load_themes_screen() {
		add_thickbox();
		add_action( 'admin_notices', array( $this, 'update_nag' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'update_scripts' ) );
	}

	/**
	 * Display the update notifications
	 *
	 * @return void
	 */
	function update_nag() {

		$strings = $this->strings;
		$theme = wp_get_theme( $this->theme_slug );
		$api_response = get_transient( $this->response_key );

		if ( false === $api_response ) {
			return;
		}

		$update_url = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $this->theme_slug ), 'upgrade-theme_' . $this->theme_slug );
		$update_onclick = ' onclick="if ( confirm(\'' . esc_js( $strings['notice']['update_notice'] ) . '\') ) {return true;}return false;"';

		if ( version_compare( $this->version, $api_response->new_version, '<' ) ) {

			// Holds ID of the div conatiner with a changelog information.
			$changelog_container_id = $this->theme_slug . '_changelog';

			if ( 'valid' === $this->license_status ) {
				$update_nag = sprintf(
					$strings['notice']['update_available'],
					$theme->get( 'Name' ),
					$api_response->new_version,
					'#TB_inline?width=640&amp;inlineId=' . $changelog_container_id,
					$theme->get( 'Name' ),
					$update_url,
					$update_onclick
				);
			} else {
				$update_nag = sprintf(
					$strings['notice']['new_version_available'],
					$theme->get( 'Name' ),
					$api_response->new_version,
					'#TB_inline?width=640&amp;inlineId=' . $changelog_container_id,
					$theme->get( 'Name' ),
					admin_url( 'themes.php?page=' . $this->theme_slug . '-license' )
				);
			}

			echo '<div id="update-nag" class="th-update-nag">' . $update_nag . '</div>';

			printf( '<div id="%1$s" style="display:none;"><div class="inner">%2$s</div></div>', $changelog_container_id, $api_response->sections['changelog'] );
		}
	}

	/**
	 * Load custom styles and scripts when a new update is availible.
	 *
	 * @return void
	 */
	function update_scripts() {
		wp_enqueue_style( 'themesharbor-update-style', get_template_directory_uri() . '/inc/updater/assets/th-theme-update.css', false, '1.0.0' );

		wp_add_inline_script( 'jquery-core',
			'jQuery(document).ready(function(){
				jQuery( "#update-nag.th-update-nag" ).on( "click", "a.thickbox", function() {
			        jQuery( "body" ).addClass( "themesharbor-update" );
			    });
			});'
		);
	}

	/**
	 * Update the theme update transient with the response from the version check
	 *
	 * @param  array $value   The default update values.
	 * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
	 *                        the request fails returns false.
	 */
	function theme_update_transient( $value ) {
		$update_data = $this->check_for_update();
		if ( $update_data ) {
			$value->response[ $this->theme_slug ] = $update_data;
		}
		return $value;
	}

	/**
	 * Remove the update data for the theme
	 *
	 * @return void
	 */
	function delete_theme_update_transient() {
		delete_transient( $this->response_key );
	}

	/**
	 * Call the EDD SL API (using the URL in the construct) to get the latest version information
	 *
	 * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
	 *                        the request fails returns false.
	 */
	function check_for_update() {

		$update_data = get_transient( $this->response_key );

		if ( false === $update_data ) {
			$failed = false;

			$api_params = array(
				'edd_action' => 'get_version',
				'license'    => $this->license,
				'name'       => $this->item_name,
				'slug'       => $this->theme_slug,
				'version'    => $this->version,
				'author'     => $this->author,
				'beta'       => $this->beta
			);

			$response = wp_remote_post( $this->remote_api_url, array( 'timeout' => 15, 'body' => $api_params ) );

			// Make sure the response was successful
			if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
				$failed = true;
			}

			$update_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! is_object( $update_data ) ) {
				$failed = true;
			}

			// If the response failed, try again in 30 minutes
			if ( $failed ) {
				$data = new stdClass;
				$data->new_version = $this->version;
				set_transient( $this->response_key, $data, strtotime( '+30 minutes', current_time( 'timestamp' ) ) );
				return false;
			}

			// If the status is 'ok', return the update arguments
			if ( ! $failed ) {
				$update_data->sections = maybe_unserialize( $update_data->sections );
				set_transient( $this->response_key, $update_data, strtotime( '+12 hours', current_time( 'timestamp' ) ) );
			}
		}

		if ( version_compare( $this->version, $update_data->new_version, '>=' ) ) {
			return false;
		}

		if ( 'valid' !== $this->license_status ) {
			return false;
		}

		return (array) $update_data;
	}

}
