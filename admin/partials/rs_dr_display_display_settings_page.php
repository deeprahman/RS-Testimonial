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
//Get the active tab, default is excerpt-tab
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'excerpt-tab';
?>
<!--Code for Wordpress HTML form-->
<div id="icon-theme" class="icon32"></div>
<h2>Display Settings</h2>
<!--Create Tabs-->
<h2 class="nav-tab-wrapper">
    <a href="<?= $excerpt_tab ?>" class="nav-tab <?= $active_tab === 'excerpt-tab' ? 'nav-tab-active' : '' ?>">Excerpt
        Option</a>
    <a href="<?= $date_tab ?>" class="nav-tab <?= $active_tab === 'date-tab' ? 'nav-tab-active' : '' ?>">Date
        Options</a>
    <a href="<?= $image_tab ?>" class="nav-tab <?= $active_tab === 'image-tab' ? 'nav-tab-active' : '' ?>">Image
        Options</a>
</h2>
<!--HTML Form-->
<div class="form">
    <form action="options.php" method="POST">

    </form>
</div>