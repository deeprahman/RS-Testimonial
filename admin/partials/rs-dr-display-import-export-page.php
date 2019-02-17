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

        <?php switch ($active_tab): ?>
<?php case 'export-tab': ?>
                <form action="admin-post.php" method="post">
                    <!--    The hidden action field for admin_post hook suffix-->
                    <input type="hidden" name="action" value="export-testimonial">
                    <!--    Create a wordpress nonce for added security-->
                    <?php wp_nonce_field('export-testimonial', 'the-export-nonce') ?>
                    <br>
                    <label for="rs-dr-export"><strong>Click here to Export all testimonial post in to a CSV
                            file</strong></label><br><br>
                    <input class="button button-primary" type="submit" name="export_btn" value="file-export">
                </form>
                <?php break; ?>
            <?php case 'import-tab': ?>
                <div>
                    <?php if (isset($_GET['invalid_type'])): ?>
                        <strong style="color: red">Invalid Mime Type</strong><br><br>
                    <?php endif; ?>
                    <?php if (isset($_GET['size_exceed'])): ?>
                        <strong style="color: red;">File should not exceed <?= $_GET['size_exceed'] ?> bytes</strong>
                        <br><br>
                    <?php endif; ?>

                    <?php if (isset($_GET['msg'])): ?>
                        <strong style="color: green;">File Successfully Imported </strong><br><br>
                    <?php endif; ?>
                </div>
                <form action="admin-post.php" method="post" enctype="multipart/form-data">
                    <!--    The hidden action field for admin_post hook suffix-->
                    <input type="hidden" name="action" value="import-testimonial">
                    <!--    Create a wordpress nonce for added security-->
                    <?php wp_nonce_field('import-testimonial', 'the-import-nonce') ?>
                    <label for="rs-dr-import"><strong>Upload a CSV file</strong></label><br>
                    <input type="file" name="testimonials"><br><br>
                    <input class="button button-primary" type="submit" name="import_btn" value="submit">
                </form>
                <?php break; ?>
            <?php endswitch; ?>
    </form>
</div>
