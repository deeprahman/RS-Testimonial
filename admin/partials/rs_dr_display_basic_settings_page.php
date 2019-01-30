<?php
$basic_tab = add_query_arg(
    ['page' => 'rs-dr-testimonial-basic-settings-page', 'tab' => 'basic-tab'],
    admin_url('admin.php')
);

$review_tab = add_query_arg(
    ['page' => 'rs-dr-testimonial-basic-settings-page', 'tab' => 'review-tab'],
    admin_url('admin.php')
);

$cache_tab = add_query_arg(
    ['page' => 'rs-dr-testimonial-basic-settings-page', 'tab' => 'cache-tab'],
    admin_url('admin.php')
);
?>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2>RS Testimonial- Settings</h2>


    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'basic-tab'; // Default tab is the basic-settings tab
    ?>
    <h2 class="nav-tab-wrapper">

        <a href="<?= $basic_tab ?>" class="nav-tab <?= $active_tab === 'basic-tab' ? 'nav-tab-active' : '' ?>">Basic
            Options</a>
        <a href="<?= $review_tab ?>" class="nav-tab <?= $active_tab === 'review-tab' ? 'nav-tab-active' : '' ?>">Review
            Options</a>
        <a href="<?= $cache_tab ?>" class="nav-tab <?= $active_tab === 'cache-tab' ? 'nav-tab-active' : '' ?>">Cache
            Options</a>

    </h2>
    <div class="from">
        <form method="post" action="options.php">
            <?php
            switch ($active_tab) {
                case 'review-tab':
                    settings_fields('rs_dr_testimonial_reviewed_settings');
                    do_settings_sections('rs-dr-testimonial-reviewed-option-page');
                    submit_button();
                    break;

                case 'cache-tab':
                    settings_fields('rs_dr_testimonial_cache_settings');
                    do_settings_sections('rs-dr-testimonial-cache-option-page');
                    submit_button();
                    break;

                default:
                    settings_fields('rs_dr_testimonial_basic_settings');
                    do_settings_sections('rs-dr-testimonial-basic-option-page');
                    submit_button();
                    break;
            }

            ?>
        </form>
    </div>
</div>
