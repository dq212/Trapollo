<?php
/**
 * Template for displaying the license page in the admin panel.
 */

?>

<div class="wrap"></div>

<div class="th-container">
    <div class="th-card th-header has-padding">
        <div class="th-row">
            <div class="th-col th-thumb">
                 <img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>">
            </div><!-- .th-col -->

            <div class="th-col th-theme-info">
                <h2 class="th-theme-title th-mar-t-0 th-mar-b-10"><?php echo esc_html( $theme['Name'] ); ?></h2>
                <p class="th-mar-t-b-0 secondary-color"><?php printf( $strings['label']['theme_author'], '<a href="'. esc_url( $theme['AuthorURI'] ) .'" target="_blank">' . $theme['Author'] . '</a>' ); ?></p>
            </div><!-- .th-col -->

            <div class="th-col th-theme-v">
                <p class="th-mar-t-0 th-mar-b-10 secondary-color"><?php printf( $strings['label']['theme_version'], '<strong>' . $theme['Version'] . '</strong>' ); ?></p>

                <?php $this->show_theme_version_notice(); ?>
            </div><!-- .th-col -->
        </div><!-- .th-row -->
    </div><!-- .th-card -->

    <?php do_action( 'thti-after-header' ); ?>

    <div class="th-card th-license-card">
        <div class="th-card-header th-d-flex">
            <h3 class="th-header-label th-mar-t-b-0 wp-clearfix"><?php echo $strings['label']['license_key_activation']; // WPCS: XSS OK. ?></h3>

            <a href="https://themesharbor.com/documentation/locating-license-key/" target="_blank"><?php echo $strings['action']['locate_license']; // WPCS: XSS OK. ?></a>
        </div><!-- .th-card-header -->

        <form class="th-row th-card-body th-license-form" method="post" action="options.php">
            <?php settings_fields( $this->theme_slug . '-license' ); ?>

            <div class="th-col th-form-left">
                <p class="th-mar-t-b-0">
                    <input id="<?php echo $this->theme_slug; ?>_license_key" name="<?php echo $this->theme_slug; ?>_license_key" type="text" class="regular-text license-key-input" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php echo esc_attr( $strings['label']['license_key'] ); ?>"/>
                </p>

                <?php if ( 'valid' !== $status ) : ?>
                    <p class="th-mar-b-0 th-mar-t-20">
                        <input type="submit" class="button-primary" name="submit" value="<?php echo esc_attr( $strings['action']['save_license'] ); ?>"/>
                    </p>
                <?php endif; ?>
            </div><!-- .th-col -->

            <div class="th-col secondary-color th-form-right">
                <p class="th-mar-t-0 th-mar-b-20"><?php echo $message; ?></p>

                <?php if ( $license ) : ?>

                    <?php if ( 'valid' === $status ) : ?>
                        <input type="submit" class="button-primary" name="<?php echo $this->theme_slug; ?>_license_deactivate" value="<?php echo esc_attr( $strings['action']['deactivate_license'] ); ?>"/>
                    <?php else : ?>
                        <input type="submit" class="button-secondary" name="<?php echo $this->theme_slug; ?>_license_activate" value="<?php echo esc_attr( $strings['action']['activate_license'] ); ?>"/>
                    <?php endif; ?>

                <?php endif; ?>
            </div><!-- .th-col -->

            <?php wp_nonce_field( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' ); ?>
        </form><!-- .enter-license -->
    </div><!-- .th-card -->

    <div class="th-row">
        <div class="th-col th-documentation">
            <div class="th-card">
                <div class="th-card-header">
                    <h3 class="th-header-label th-mar-t-b-0"><?php echo $strings['label']['documentation']; // WPCS: XSS OK. ?></h3>
                </div><!-- .th-card-header -->

                <div class="th-card-body">
                    <p class="th-mar-t-0 th-mar-b-20"><?php echo $strings['text']['documentation']; // WPCS: XSS OK. ?></p>
                    <p class="th-mar-t-b-0"><a href="<?php echo $documentation_link; ?>" target="_blank" class="button button-secondary"><?php echo $strings['action']['open_documentation']; // WPCS: XSS OK. ?></a></p>
                </div><!-- .th-card-body -->
            </div><!-- .th-card -->
        </div><!-- .th-col -->

        <div class="th-col th-changelog">
            <div class="th-card">
                <div class="th-card-header">
                    <h3 class="th-header-label th-mar-t-b-0"><?php echo $strings['label']['changelog']; // WPCS: XSS OK. ?></h3>
                </div><!-- .th-card-header -->

                <div class="th-card-body">
                    <p class="th-mar-t-0 th-mar-b-20"><?php echo $strings['text']['changelog']; // WPCS: XSS OK. ?></p>
                    <p class="th-mar-t-b-0"><a href="https://themesharbor.com/changelogs/" target="_blank" class="button button-secondary"><?php echo $strings['action']['open_changelogs']; // WPCS: XSS OK. ?></a></p>
                </div><!-- .th-card-body -->
            </div><!-- .th-card -->
        </div><!-- .th-col -->
    </div><!-- .th-row -->

    <div class="th-card th-support has-padding th-mar-b-0">
        <h3 class="th-mar-t-0 th-mar-b-10"><?php echo $strings['label']['here_to_help']; // WPCS: XSS OK. ?></h3>
        <p class="th-mar-t-0 th-mar-b-20">
            <?php echo $strings['text']['help']; // WPCS: XSS OK. ?>
        </p>
        <p class="th-mar-t-b-0">
            <a href="https://themesharbor.com/contacts/" target="_blank" class="button button-primary"><?php echo $strings['action']['ask_question']; // WPCS: XSS OK. ?></a>
            <a href="https://themesharbor.com/support-policy/" target="_blank" class="button button-secondary"><?php echo $strings['action']['read_support_policy']; // WPCS: XSS OK. ?></a>
        </p>
    </div><!-- .th-card -->
</div><!-- .th-container -->
