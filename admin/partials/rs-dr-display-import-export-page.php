<?php
$export = add_query_arg(
    array('page' => 'rs-dr-testimonial-import-export-page', 'tab' => 'export-tab'),
    admin_url('admin.php')
);
$import = add_query_arg(
    array('page' => 'rs-dr-testimonial-import-export-page', 'tab' => 'import-tab'),
    admin_url('admin.php')
);

//Get the active tab, default is excerpt-tab
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'export-tab';
?>

<div class="wrap">
    <div id="icon-theme" class="icon32"></div>
    <h2>Import and Export Testimonial</h2>
    <h2 class="nav-tab-wrapper">
        <a href="<?= $export ?>" class="nav-tab <?= $active_tab === 'export-tab' ? 'nav-tab-active' : '' ?>">Excerpt
            Option</a>
        <a href="<?= $import ?>" class="nav-tab <?= $active_tab === 'import-tab' ? 'nav-tab-active' : '' ?>">Import
            Options</a>
    </h2>
    <form action="admin-post.php" method="post">
        <?php switch ($active_tab): ?>
<?php case 'export-tab': ?>
                <br>
                <label for="rs-dr-export"><strong>Click here to Export all testimonial post in to a CSV
                        file</strong></label><br><br>
                <input class="button button-primary" type="button" name="export" value="file-export">
                <?php break; ?>
            <?php case 'import-tab': ?>
                <label for="rs-dr-import"><strong>Upload a CSV file</strong></label><br>
                <input type="file" name="testimonials"><br><br>
                <input class="button button-primary" type="submit" name="submit" value="submit">
                <?php break; ?>
            <?php endswitch; ?>
    </form>
</div>
