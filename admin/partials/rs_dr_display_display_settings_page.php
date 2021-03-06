<?php
//Hyperlinks + query strings for  tabs
$excerpt_tab = add_query_arg(
    array('page' => 'rs-dr-testimonial-display-settings-page', 'tab' => 'excerpt-tab'),
    admin_url('admin.php')
);
$date_tab = add_query_arg(
    array('page' => 'rs-dr-testimonial-display-settings-page', 'tab' => 'date-tab'),
    admin_url('admin.php')
);
$image_tab = add_query_arg(
    array('page' => 'rs-dr-testimonial-display-settings-page', 'tab' => 'image-tab'),
    admin_url('admin.php')
);
$width_tab = add_query_arg(
    array('page' => 'rs-dr-testimonial-display-settings-page', 'tab' => 'width-tab'),
    admin_url('admin.php')
);
$link_tab = add_query_arg(
    array('page' => 'rs-dr-testimonial-display-settings-page', 'tab' => 'link-tab'),
    admin_url('admin.php')
);
$single_tab = add_query_arg(
    array('page' => 'rs-dr-testimonial-display-settings-page', 'tab' => 'single-tab'),
    admin_url('admin.php')
);
//Get the active tab, default is excerpt-tab
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'excerpt-tab';
?>
<div class="wrap">

    <!--Code for Wordpress HTML form-->
    <div id="icon-theme" class="icon32"></div>
    <h2><?= esc_html__('Display Settings', 'rs-dr-testimonial') ?></h2>
    <!--Create Tabs-->
    <h2 class="nav-tab-wrapper">
        <a href="<?= $excerpt_tab ?>"
           class="nav-tab <?= $active_tab === 'excerpt-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Excerpt Option', 'rs-dr-testimonial') ?>
        </a>
        <a href="<?= $date_tab ?>"
           class="nav-tab <?= $active_tab === 'date-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Date Options', 'rs-dr-testimonial') ?>
        </a>
        <a href="<?= $image_tab ?>"
           class="nav-tab <?= $active_tab === 'image-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Image Options') ?></a>
        <a href="<?= $width_tab ?>"
           class="nav-tab <?= $active_tab === 'width-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Width Options') ?></a>
        <a href="<?= $link_tab ?>"
           class="nav-tab <?= $active_tab === 'link-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Link Options') ?></a>
        <a href="<?= $single_tab ?>"
           class="nav-tab <?= $active_tab === 'single-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Single View Options') ?></a>
    </h2>
    <!--HTML Form-->
    <div class="form">
        <form action="options.php" method="POST">
            <?php
            switch ($active_tab) {
                case 'excerpt-tab':
                    settings_fields('rs_dr_t_excerpt_group');
                    do_settings_sections('rs-dr-t-excerpt-section-page');
                    break;
                case 'date-tab':
                    {
                        settings_fields('rs_dr_t_date_group');
                        do_settings_sections('rs-dr-t-date-section-page');
                        break;
                    }
                case 'image-tab':
                    {
                        settings_fields('rs_dr_t_image_group');
                        do_settings_sections('rs-dr-t-image-section-page');
                        break;
                    }
                case 'width-tab':
                    {
                        settings_fields('rs_dr_t_width_group');
                        do_settings_sections('rs-dr-t-width-section-page');
                        break;
                    }
                case 'link-tab':
                    {
                        settings_fields('rs_dr_t_link_group');
                        do_settings_sections('rs-dr-t-link-section-page');
                        break;
                    }
                case 'single-tab':
                    {
                        settings_fields('rs_dr_t_single_group');
                        do_settings_sections('rs-dr-t-single-section-page');
                        break;
                    }
            }
            submit_button();
            ?>
        </form>
    </div>
</div>
