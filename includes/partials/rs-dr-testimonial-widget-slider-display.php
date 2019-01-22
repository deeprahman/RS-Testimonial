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

    $output .= <<<EOL
        <div class="next_button" style="display: inline-block;"></div>
        <div class="prev_button"></div>
      
EOL;

    echo $output . "</div>" . $after_widget;
    // Get the buffered output and clean the buffer


} else {

    echo "No Testimonial Has been published";
}