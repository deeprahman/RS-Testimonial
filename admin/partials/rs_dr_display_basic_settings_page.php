<?php ?>
<div id="rs-dp-main-settings" class="wrap">
    <h2>RS Testimonial - Main Settings</h2>
    <form action="options.php" method="post" name="rs_dr_testimonial_settings">
        <?php settings_fields('rs_dr_testimonial_settings') ?>
        <?php do_settings_sections('rs-dr-testimonial-section') ?>
        <?php submit_button()?>
    </form>
</div>
<?php
