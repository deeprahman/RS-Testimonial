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


<h2>Shortcode Generation Page</h2>
<label for="testimonial">Select a testimonial
    <select id="testimonial">
        <option value="">Select Shortcode</option>
        <option value="random">Random Testimonial</option>
        <option value="cycle">Cycle Testimonial</option>
        <option value="single">Single Testimonial</option>
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

        <h3>Fields to Display</h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-image" name="image"> Show Featured Image
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-excerpt" name="excerpt"> Show Testimonial Excerpt
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-rand-title" name="title"> Show Testimonial Title
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
        <h3>Filter Testimonial</h3>
        <div>
            <p>Count</p>
            <input type="number" id="rs-dr-t-cycle-count" name="count">
        </div>
        <h3>Fields To Display</h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-image" name="image"> Show Featured Image
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-excerpt" name="excerpt"> Show Testimonial Excerpt
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-cycle-title" name="title"> Show Testimonial Title
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
        <p>Select a testimonial</p>
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

        <h3>Fields to Display</h3>
        <div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-image" name="image"> Show Featured Image
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-excerpt" name="excerpt"> Show Testimonial Excerpt
            </div>
            <div>
                <input type="checkbox" id="rs-dr-t-single-title" name="title"> Show Testimonial Title
            </div>
        </div>
    </div>
    <div>
        <br>
        <button class="rs-dr-t-button" id="button-single">Insert</button>
    </div>
</div>