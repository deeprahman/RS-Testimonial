<?php

//        Initiate WP_Query
$testimonial = new WP_Query($query_args);
if ($testimonial->have_posts()) {
    //fetch the settings of Show More Testimonial Link form database
    $link_option = get_option('rs_dr_link_options');
    $link_check = isset($link_option['show_the_link']) ? $link_option['show_the_link'] : null;
    $link_text = !empty($link_option['link_text']) ? $link_option['link_text'] : 'View More Testimonials';
    $link_address = !empty($link_option['link_address']) ? $link_option['link_address'] : '#';

    $output = '';
    echo $before_widget;
    echo $before_title;
    echo apply_filters('widget_title', $title);
    echo $after_title;

    while ($testimonial->have_posts()) {
        $testimonial->the_post();
        $post_id = $testimonial->post->ID;
        $client_name = get_post_meta($post_id, 'rs_dr_testimonial_client_name', true);
        $client_email = get_post_meta($post_id, 'rs_dr_testimonial_email', true);
        $client_position = get_post_meta($post_id, 'rs_dr_testimonial_position', true);
        $client_location = get_post_meta($post_id, 'rs_dr_testimonial_location', true);
        $client_rating = get_post_meta($post_id, 'rs_dr_testimonial_rating', true);
        //Get Global Review if Global Review is set
        if (isset($options['use_global_item_reviewed'])) {
            if (empty($client_location)) {
                $client_location = $options['global_item_reviewed'];
            }
        }
        $wpblog_fetrdimg = wp_get_attachment_url(get_post_thumbnail_id($post_id));
        $title = get_the_title();
        if (has_excerpt()) {
            $excerpt = wp_trim_excerpt(); //It uses the 'excerpt_length' filter hook
        } else {
            $length = get_option('rs_dr_excerpt_options');
            $length = $length['display_excerpt_char'];
            $excerpt = wp_trim_words(get_the_content(), $length);
        }
        //Strip HTML tags from the excerpt
        if ($strip_tags = get_option('rs_dr_basic_settings_options') && !isset($strip_tags['allow_html_tags'])) {
            $excerpt = strip_tags($excerpt);
        }


        $permalink = get_the_permalink();
        //Get the date format from the database
        $date_format = get_option('rs_dr_date_options');
        $date_format = $date_format['display_date_format'];
        //Get the post date
        $date = get_the_date($date_format, $post_id);
        $output .= <<<EOL
<div>               
EOL;

        {//Begin Display Testimonial image section
            //Fetch the value of image indicator from database
            $img_ind = get_option('rs_dr_image_options');
            if (($gravatar = get_avatar_url($client_email)) && isset($img_ind['use_gravaters']) && empty($wpblog_fetrdimg)) { //If email address has a gravatar, and no image uploaded
                $image_testimonial = <<<EOL
<img id="image" src="{$gravatar}" alt="image-fall">
EOL;
            } else { //No gravater found block
                if (isset($img_ind['show_testimonial_image'])) {
                    //No image uploaded
                    if (empty($wpblog_fetrdimg) || !isset($wpblog_fetrdimg)) {
                        // Get the value of the fallback image from the database
                        $fallback_img = $img_ind['fallback_image'];
                        //Switch for fallback image
                        switch ($fallback_img) {
                            case 1:
                                {
                                    $mystery_image_path = PLUGIN_URL . '/public/asset/mystery-person-clipart-1.jpg';
                                    $image_testimonial = <<<EOL
<img id="image" src="{$mystery_image_path}" alt="image-fall">
EOL;
                                    break;
                                }
                            case 2:
                                {
                                    $image_testimonial = '';
                                }
                        }
                    } else {
                        $image_testimonial = <<<EOL
<img id="image" src="{$wpblog_fetrdimg}" alt="image">
EOL;
                    }
                } else {
                    $image_testimonial = '';
                }
            }
        }//End Display Testimonial image section

        if ($show_image) {

            $output = $output . $image_testimonial;
        }
        ?>
        <?php
        // Start the buffer
        ob_start()
        ?>
        <div class="rs-dr-container">
            <?php if ($show_rating == 1): ?>
                <span class="rs-dr-ci">Rating: <?= $client_rating ?></span>
            <?php endif; ?>
            <?php if ($show_title): ?>
                <p id="rs-dr-title"><?= $title ?></p>
            <?php endif; ?>
            <?php if (isset($show_excerpt)): ?>
                <p id="rs-dr-content" class="custom-css-excerpt"><?= $excerpt ?><span><a href="<?= $permalink ?>"> &nbsp;Read More...</a>
                </p>
            <?php endif; ?>

            <span class="rs-dr-ci">Client's Name: <?= $client_name ?></span>

            <span class="rs-dr-ci">Client's Email: <?= $client_email ?></span>

            <span class="rs-dr-ci">Client's Position: <?= $client_position ?></span>
            <?php if ($show_review): ?>
                <span class="rs-dr-ci">Client's Location: <?= $client_location ?></span>
            <?php endif; ?>
            <?php if ($show_rating == 2): ?>
                <span class="rs-dr-ci">Rating: <?= $client_rating ?></span>
            <?php endif; ?>
            <?php if ($show_date): ?>
                <span class="rs-dr-ci">Date: <?= $date ?></span>
            <?php endif; ?>
            <?php if ($link_check && $show_more_link): ?>
                <span class="rs-dr-ci">Click <a href="<?= $link_address ?>"><?= $link_text ?></a></span>
            <?php endif; ?>
        </div>

        <?php
        //get the buffered contented and clean the buffer
        $output .= ob_get_clean();


        if (isset($options['output_review_markup'])) { // JSON-LD option is on
            $output .= <<<JSON
            <!--JSON-LD for search engine readability-->
<script type='application/ld+json'>
    {
        "@context":"http://schema.org",
        "@type":"Review",
        "itemReviewed":{"name": "{$client_location}"},
        "reviewRating":{
            "@type":"Rating",
            "ratingValue":"{$client_rating}"
        },
        "name":"{$title}",
        "author":{
        "@type":"person",
        "name":"{$client_name}"
        },
        "reviewBody":"{$excerpt}"
    }
</script>
JSON;
        }
        $output .= "</div>";
    }

    echo $output . $after_widget;
    // Get the buffered output and clean the buffer
} else {
    echo "No Testimonial Has been published";
}