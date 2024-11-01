<h1><?php _e('Parser comments with tripadvisor','WPPTC'); ?></h1>
<?php settings_errors();?>
<form action="options.php" method="post" id="login_form">
    <?php
    settings_fields('homepage-option-group');
    do_settings_sections('parser-theme-settings');
    submit_button(__('Retrieve comments','WPPTC'));
    ?>
    <p><?php _e('Copy this short code paste into the editor field - ', 'WPPTC'); ?> <code>[hireukraine_shortCodeParser]</code></p>
    <img src="<?php echo WPPTC_ASSETS_ADMIN_IMAGES_URL; ?>spinner.gif" class="gif-preload" style="display: block; visibility: hidden;">

    <h3 class="gif-preload" style="visibility: hidden;"><?php _e('Please wait while comments are uploaded','WPPTC'); ?></h3>
</form>
