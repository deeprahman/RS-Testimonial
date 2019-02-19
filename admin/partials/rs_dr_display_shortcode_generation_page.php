<?php
// Argument for WP_Query
$args = [];
$args['post_type'] = 'rs_dr_testimonial';
$count = 0;
$testimonial = new WP_Query($args);
if ($testimonial->have_posts()) {
    while ($testimonial->have_posts()) {
        $testimonial->the_post();
        $id = get_the_ID();
        $titles[$id] = get_the_title();
    }
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
     style="border: 3px double darkslategrey; height: 300px;width:80%; margin: 10px;font-size: 2em;padding: 10px;"></div>
<br><br>

<!--HTML For random testimonial-->
<div id="rs-dr-t-random" style="display: none;">

    <div class="jQuery_accordion">

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
        <h3><?= esc_html__('Filter Testimonial') ?></h3>
        <div>
            <p>Count</p>
            <input type="number" id="rs-dr-t-cycle-count" name="count">
        </div>
        <h3><?= esc_html__('Fields To Display') ?></h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-image"
                       name="image"><?= esc_html__('Show Featured Image', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-excerpt"
                       name="excerpt"><?= esc_html__('Show Testimonial Excerpt') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-title"
                       name="title"><?= esc_html__('Show Testimonial Title', 'rs-dr-testimonial') ?>
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
    <div>
        <p><?= esc_html__('Select a testimonial', 'rs-dr-testimonial') ?></p>
        <div>
            <select id="rs-dr-t-single-post" name="id_post">
                <?php foreach ($titles as $key => $value): ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <br><br>
    <div class="jQuery_accordion">

        <h3><?= esc_html__("Fields to Display", 'rs-dr-testimonial') ?></h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-image"
                       name="image"><?= esc_html__('Show Featured Image', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-excerpt"
                       name="excerpt"><?= esc_html__('Show Testimonial Excerpt', 'rs-dr-testimonial') ?>
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-title"
                       name="title"><?= esc_html__('Show Testimonial Title', 'rs-dr-testimonial') ?>
            </div>
        </div>
    </div>
    <div>
        <br>
        <button class="rs-dr-t-button" id="button-single">Insert</button>
    </div>
</div>