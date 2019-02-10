<h2>The Themes Settings Page</h2>
<?php
//Get the options form the database
$options = get_option('rs_dr_theme_options');
$theme_val = intval(isset($options['theme_value']) ? $options['theme_value'] : 1);
// Display the save-success message
if (isset($_GET['message']) && $_GET['message'] === '1') {
    ?>
    <div id="message" class="update fade">
        <p>
            <strong>Settings Saved</strong>
        </p>
    </div>
    <?php
}
?>
<form action="admin-post.php" method="post">
    <!--    The hidden action field for admin_post hook suffix-->
    <input type="hidden" name="action" value="save_theme_option">
    <!--    Create a wordpress nonce for added security-->
    <?php wp_nonce_field('save_theme_option', 'the_theme_nonce') ?>
    <!--    Select-option field for selection different theme styles-->
    <label for="rs-dr-t-themes" style="font-weight: bold">Select Themes</label>
    <select name="theme_value" id="rs-dr-t-themes">
        <option value="1" <?php selected($theme_val, 1) ?>>Standard Theme - Default Style</option>
        <option value="2" <?php selected($theme_val, 2) ?>>Standard Theme - Dark Style</option>
        <option value="3" <?php selected($theme_val, 3) ?>>Standard Theme - Light Style</option>
        <option value="4" <?php selected($theme_val, 4) ?>>Standard Theme - No Style</option>
    </select>
    <!--    The submit button-->
    <div style="margin: 1.5em 0em 0em 19.6em;">
        <input type="submit" value="Submit" class="button-primary">
    </div>
</form>

<!--Preview the selected theme-->
<div style="margin: 3em 0em; font-size:1.5em; font-weight: bold;">
    Preview the Selected theme
</div>
<div id="my-style"></div>
<div style="height:22em;width:60em; border: 1px solid silver;background: white;padding: 3em;">

    <div class="rs-dr-container">
        <img src="<?= PLUGIN_URL . 'includes/asset/mystery-person-clipart-1.jpg' ?>" alt="Image" id="image"
             style="height: 150px; width: 150px;">
        <p id="rs-dr-title">The Title</p>
        <p id="rs-dr-content" class="custom-css-excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi
            omnis vero ad eum corporis hic commodi adipisci, maiores error. Modi suscipit iste molestias quos officia
            accusantium praesentium illo. Impedit minus soluta possimus sed adipisci corporis laborum rerum. Odio
            laboriosam qui, ipsam alias id assumenda optio repellendus, modi est harum expedita.
            <span>
            <a href="#">Read More...</a>
        </span>
        </p>
        <span class="rs-dr-ci">Client's Name: Deep Rahman</span>
        <span class="rs-dr-ci">Client's Email: dp.rahman@gmail.com</span>
        <span class="rs-dr-ci">Client's Position: In Home</span>
        <span class="rs-dr-ci">Client's Location: My Location</span>
        <span class="rs-dr-ci">Rating: 5/5</span>
        <span class="rs-dr-ci">Date: 02/10/2019</span>
    </div>

</div>
