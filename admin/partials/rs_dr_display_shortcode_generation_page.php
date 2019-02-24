<?php
// Argument for WP_Query

$args = [];
$args['post_type'] = 'rs_dr_testimonial';
$args['posts_per_page'] = -1;
$count = 0;
$testimonial = new WP_Query($args);
if ($testimonial->have_posts()) {
    while ($testimonial->have_posts()) {
        $testimonial->the_post();
        $id = get_the_ID();
        $titles[$id] = get_the_title();
    }
}
wp_reset_postdata();
/**
 * Function for creating Category Dropdown
 *
 * @param string $id HTML field id
 * @param string $name HTML field name
 * @return string   wordpress generated HTML select input field for POST category
 */
function cat_dropdown(string $id, string $name)
{
    $args = [
        'id' => $id,
        'name' => $name,
        'taxonomy' => 'rs_dr_testimonial_type',
        'selected' => 0,
        'echo' => 0,
        'hide_empty' => 1
    ];
    return wp_dropdown_categories($args);
}
?>

<h2><?= esc_html__('Shortcode Generation Page', 'rs-dr-testimonial') ?></h2>
<label for="testimonial"><?= esc_html__('Select a testimonial', 'rs-dr-testimonial') ?>
    <select id="testimonial">
        <option value=""><?= esc_html__('Select Shortcode', 'rs-dr-testimonial') ?></option>
        <option value="random"><?= esc_html__('Random Testimonial', 'rs-dr-testimonial') ?></option>
        <option value="cycle"><?= esc_html__('Cycle Testimonial', 'rs-dr-testimonial') ?></option>
        <option value="single"><?= esc_html__('Single Testimonial', 'rs-dr-testimonial') ?></option>
    </select>
</label>
<?php add_thickbox() ?>
<br><br>
<div id="shortcode"
     style="border: 3px double darkslategrey; height: 300px;width:80%; margin: 10px;font-size: 1.3em;padding: 10px;"></div>
<br><br>

<!--HTML For random testimonial-->
<div id="rs-dr-t-random" style="display: none;">

    <div class="jQuery_accordion">
        <h3><?= esc_html__('Filter Testimonial') ?></h3>
        <div>
            <p>Count</p>
            <input type="number" id="rs-dr-t-rand-count" name="count">
            <p>Category</p>
            <?= cat_dropdown('rs-dr-t-rand-cat', 'cat') ?>
        </div>
        <h3><?= esc_html__('Fields to Display', 'rs-dr-testimonial') ?></h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-image"
                       name="image"> <?= esc_html__('Show Featured Image', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-excerpt"
                       name="excerpt"><?= esc_html__('Show Testimonial Excerpt', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-title"
                       name="title"><?= esc_html__('Show Testimonial Title', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-name"
                       name="name"><?= esc_html__('Show Client\'s name', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-email"
                       name="email"><?= esc_html__('Show Client\'s Email', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-location"
                       name="location"><?= esc_html__('Show Client\'s Location', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-position"
                       name="position"><?= esc_html__('Show Client\'s Position', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-review"
                       name="review"><?= esc_html__('Show Client\'s Review', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-rate"
                       name="rating"><?= esc_html__('Show Rate', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-date"
                       name="date"><?= esc_html__('Show Date', 'rs-dr-testimonial') ?>
            </div>
        </div>
    </div>
    <div>
        <br>
        <button class="rs-dr-t-button" id="button-random">Insert</button>
    </div>
</div>

<!--HTML For cycle-->
<div id="rs-dr-t-cycle" style="display: none;">

    <div class="jQuery_accordion">
        <h3><?= esc_html__('Filter Testimonial', 'rs-dr-testimonial') ?></h3>
        <div>
            <p>Count</p>
            <input type="number" id="rs-dr-t-cycle-count" name="count">
            <p>Category</p>
            <?= cat_dropdown('rs-dr-t-cycle-cat', 'cat') ?>
            <p><?= esc_html__('Order By', 'rs-dr-testimonial') ?></p>
            <select name="orderby" id="rs-dr-t-cycle-orderby">
                <option value="rand"><?= esc_html__('Random', 'rs-dr-testimonial') ?></option>
                <option value="ID"><?= esc_html__('ID', 'rs-dr-testimonial') ?></option>
                <option value="author"><?= esc_html__('Author', 'rs-dr-testimonial') ?></option>
                <option value="title"><?= esc_html__('Title', 'rs-dr-testimonial') ?></option>
                <option value="modified"><?= esc_html__('Modified', 'rs-dr-testimonial') ?></option>
                <option value="parent"><?= esc_html__('Parent', 'rs-dr-testimonial') ?></option>
            </select>
            <p><?= esc_html__('Sorting', 'rs-dr-testimonial') ?></p>
            <select name="odr" id="rs-dr-t-cycle-order">
                <option value="ASC"><?= esc_html__('Ascending Order', 'rs-dr-testimonial') ?></option>
                <option value="DESC"><?= esc_html__('Descending Order', 'rs-dr-testimonial') ?></option>

            </select>
        </div>
        <h3><?= esc_html__('Fields To Display') ?></h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-image"
                       name="image"> <?= esc_html__('Show Featured Image', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-excerpt"
                       name="excerpt"><?= esc_html__('Show Testimonial Excerpt', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-title"
                       name="title"><?= esc_html__('Show Testimonial Title', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-name"
                       name="name"><?= esc_html__('Show Client\'s name', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-email"
                       name="email"><?= esc_html__('Show Client\'s Email', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-location"
                       name="location"><?= esc_html__('Show Client\'s Location', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-position"
                       name="position"><?= esc_html__('Show Client\'s Position', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-review"
                       name="review"><?= esc_html__('Show Client\'s Review', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-rate"
                       name="rating"><?= esc_html__('Show Rate', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-date"
                       name="date"><?= esc_html__('Show Date', 'rs-dr-testimonial') ?>
            </div>
        </div>
    </div>
    <div>
        <br>
        <button class="rs-dr-t-button" id="button-cycle">Insert</button>
    </div>
</div>
<!--HTML for single-->
<div id="rs-dr-t-single" style="display: none;">

    <div class="jQuery_accordion">
        <h3><?= esc_html__('Filter Testimonial') ?></h3>
        <div>
            <p><?= esc_html__('Select a testimonial', 'rs-dr-testimonial') ?></p>
            <select id="rs-dr-t-single-post" name="id_post">
                <?php foreach ($titles as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <h3><?= esc_html__("Fields to Display", 'rs-dr-testimonial') ?></h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-image"
                       name="image"> <?= esc_html__('Show Featured Image', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-excerpt"
                       name="excerpt"><?= esc_html__('Show Testimonial Excerpt', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-title"
                       name="title"><?= esc_html__('Show Testimonial Title', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-name"
                       name="name"><?= esc_html__('Show Client\'s name', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-email"
                       name="email"><?= esc_html__('Show Client\'s Email', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-location"
                       name="location"><?= esc_html__('Show Client\'s Location', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-position"
                       name="position"><?= esc_html__('Show Client\'s Position', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-review"
                       name="review"><?= esc_html__('Show Client\'s Review', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-rate"
                       name="rating"><?= esc_html__('Show Rate', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-date"
                       name="date"><?= esc_html__('Show Date', 'rs-dr-testimonial') ?>
            </div>
        </div>
    </div>
    <div>
        <br>
        <button class="rs-dr-t-button" id="button-single">Insert</button>
    </div>
</div>