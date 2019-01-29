<?php

//        Initiate WP_Query
$testimonial = new WP_Query($query_args);

if ($testimonial->have_posts()) {


    $output = '';
    echo $before_widget;
    echo $before_title;
    echo apply_filters('widget_title', $title);
    echo $after_title;

    echo "<div class=\"slider_one_big_picture\">";

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

        $length = get_option('rs_dr_testimonial_options');
        $length = $length['length_excerpt'];

        $wpblog_fetrdimg = wp_get_attachment_url(get_post_thumbnail_id($post_id));

        $title = get_the_title();

        if (has_excerpt()) {
            $excerpt = wp_trim_excerpt();
        } else {
            $length = get_option('rs_dr_testimonial_options');
            $length = $length['length_excerpt'];

            $excerpt = wp_trim_words(get_the_content(), $length);
        }

        $permalink = get_the_permalink();

        $output .= <<<EOL
                <div>
                <img id="image" src="{$wpblog_fetrdimg}" alt="image">
    <p id="rs-dr-title">{$title}</p>
    <p id="rs-dr-content" class="custom-css-excerpt">{$excerpt}<span><a href="{$permalink}"> &nbsp;Read More...</a></p>
    <span class="rs-dr-ci">Client's Name: {$client_name}</span>
    <span class="rs-dr-ci">Client's Email: {$client_email}</span>
    <span class="rs-dr-ci">Client's Position: {$client_position}</span>
    <span class="rs-dr-ci">Client's Location: {$client_location}</span>
    <span class="rs-dr-ci">Rating: {$client_rating}</span>
</div>
     
    
EOL;
    }
    // JSON-LD option is on
    if (isset($options['output_review_markup'])) {
        $json_ld = <<<JSON

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

JSON;
        // Put JSON-LD inside of script tag
        $html_comment = "<!--JSON-LD for search engine readability-->";
        $output .= $html_comment . "<script type='application/ld+json'>{$json_ld}</script>";
    }

    $output .= <<<EOL
        <div class="next_button" style="display: inline-block;"></div>
        <div class="prev_button"></div>
      
EOL;

    echo $output . "</div>" . $after_widget;
    // Get the buffered output and clean the buffer


} else {

    echo "No Testimonial Has been published";
}