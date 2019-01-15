<?php ?>
    <div id="rs-dp-main-settings" class="wrap">
        <h2>RS Testimonial - Basic Settings</h2>
        <form action="options.php" method="post">
            <?php settings_fields('rs_dr_testimonial_basic_settings') ?>
            <?php do_settings_sections('rs-dr-testimonial-settings') ?>
            <?php submit_button() ?>
        </form>
    </div>
<?php
