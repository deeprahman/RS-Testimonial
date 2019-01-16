<?php ?>
    <div id="rs-dp-main-settings" class="wrap">
        <h2>RS Testimonial - Main Settings</h2>
        <form action="options.php" method="post">
            <?php settings_fields('rs_dr_testimonial_display_settings_group') ?>
            <?php do_settings_sections('rs-dr-testimonial-display-settings-page') ?>
            <?php submit_button() ?>
        </form>
    </div>
<?php