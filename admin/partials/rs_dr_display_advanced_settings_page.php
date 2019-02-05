<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <div class="form">
        <form action="options.php" method="POST">
            <?php
            settings_fields('rs_dr_t_shortcode_group');
            do_settings_sections('rs-dr-t-shortcode-settings-page');
            submit_button();
            ?>
        </form>
    </div>
</div>