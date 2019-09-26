<?php
/**
 * Template for displaying the theme update notice in the license page.
 */

?>

<div class="th-card has-padding th-notice alert th-d-flex">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2.829l9.172 9.171-9.172 9.171-9.172-9.171 9.172-9.171zm0-2.829l-12 12 12 12 12-12-12-12zm-1 7h2v6h-2v-6zm1 10.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/></svg>

    <p class="th-mar-t-b-0"><?php echo $this->strings['text']['theme_update_notice']; // WPCS: XSS OK. ?></p>

    <p class="th-mar-t-b-0"><a href="https://themesharbor.com/documentation/update-a-wordpress-theme/" target="_blank" class="button button-secondary"><?php echo $this->strings['action']['view_update_guide']; // WPCS: XSS OK. ?></a></p>
</div><!-- .th-card -->
