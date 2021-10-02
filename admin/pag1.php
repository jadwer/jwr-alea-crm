<?php esc_html_e( 'Admin Page Test', 'textdomain' ); ?>
<?php

echo '<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">'.
        settings_fields('wporg_options').
        do_settings_sections('wporg').
        submit_button(__('Save Settings', 'textdomain'))
    .'</form>
</div>
';