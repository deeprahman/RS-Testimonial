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
    <h2><?= esc_html__('Import and Export Testimonial', 'rs-dr-testimonial') ?></h2>
    <h2 class="nav-tab-wrapper">
        <a href="<?= $export ?>"
           class="nav-tab <?= $active_tab === 'export-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Excerpt
            Option', 'rs-dr-testimonial') ?></a>
        <a href="<?= $import ?>"
           class="nav-tab <?= $active_tab === 'import-tab' ? 'nav-tab-active' : '' ?>"><?= esc_html__('Import
            Options', 'rs-dr-testimonial') ?></a>
    </h2>

        <?php switch ($active_tab): ?>
<?php case 'export-tab': ?>
                <?php if (isset($_GET['msg']) && $_GET['msg'] === '0'): ?>
                    <strong style="color: orange;"><?= esc_html__('No Post available', 'rs-dr-testimonial') ?></strong>
                    <br><br>
                <?php endif; ?>
                <form action="admin-post.php" method="post">
                    <!--    The hidden action field for admin_post hook suffix-->
                    <input type="hidden" name="action" value="export-testimonial">
                    <!--    Create a wordpress nonce for added security-->
                    <?php wp_nonce_field('export-testimonial', 'the-export-nonce') ?>
                    <br>
                    <label for="rs-dr-export"><strong><?= esc_html__('Click here to Export all testimonial post in to a CSV', 'rs-dr-testimonial') ?>
                            file</strong></label><br><br>
                    <input class="button button-primary" type="submit" name="export_btn" value="file-export">
                </form>
                <?php break; ?>
            <?php case 'import-tab': ?>
                <div>
                    <?php if (isset($_GET['invalid_type'])): ?>
                        <strong style="color: red"><?= esc_html__('Invalid Mime Type', 'rs-dr-testimonial') ?></strong>
                        <br><br>
                    <?php endif; ?>
                    <?php if (isset($_GET['size_exceed'])): ?>
                        <strong style="color: red;"><?= esc_html__('File should not exceed', 'rs-dr-testimonial') ?> <?= $_GET['size_exceed'] ?>
                            bytes</strong>
                        <br><br>
                    <?php endif; ?>

                    <?php if (isset($_GET['msg']) && $_GET['msg'] === '1'): ?>
                        <strong style="color: green;"><?= esc_html__('File Successfully Imported', 'rs-dr-testimonial') ?> </strong>
                        <br><br>
                    <?php endif; ?>

                    <?php if (isset($_GET['msg']) && $_GET['msg'] === '0'): ?>
                        <strong style="color: red;"><?= esc_html__('File Import Unsuccessful', 'rs-dr-testimonial') ?> </strong>
                        <br><br>
                    <?php endif; ?>
                </div>
                <form action="admin-post.php" method="post" enctype="multipart/form-data">
                    <!--    The hidden action field for admin_post hook suffix-->
                    <input type="hidden" name="action" value="import-testimonial">
                    <!--    Create a wordpress nonce for added security-->
                    <?php wp_nonce_field('import-testimonial', 'the-import-nonce') ?>
                    <label for="rs-dr-import"><strong><?= esc_html__('Upload a CSV file', 'rs-dr-testimonial') ?></strong></label><br>
                    <input type="file" name="testimonials"><br><br>
                    <input class="button button-primary" type="submit" name="import_btn" value="submit">
                </form>
                <?php break; ?>
            <?php endswitch; ?>

</div>
