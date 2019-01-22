<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/public
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Shortcode extends Rs_Dr_Testimonial_Public
{


    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;


//	Add shortcode
    public function register_shortcodes()
    {
        add_shortcode('rs_dr_testimonial', [$this, 'rs_dr_display_testmonial_shortcode']);
    }

//    Displaying content of the shortcode
    public function rs_dr_display_testmonial_shortcode($atts)
    {
        // cache checkbox is set and transient is set
        if (($option = get_option('rs_dr_cache_options')) && $output_short = get_transient('rs_dr_t_shorcode')) {
            return $output_short;
        }


        $args = [];
        $args['post_type'] = 'rs_dr_testimonial';
        $args['posts_per_page'] = -1;
        /*
         * To show slider shortcode: [rs_dr_testimonial slide='1']
         * To show slider with specified maximum number of post: [rs_dr_testimonial slide='1' max='4']
         * to show slider with defined order: [rs_dr_testimonial slide='1' max='4' ord='ASC']
         * To show a random testimonial: [rs_dr_testimonial rand='1']
         * To show a testimonial with defined by post id: [rs_dr_testimonial id='5']
         * To show the lists of the testimonial: [rs_dr_testimonial]
         */


        if (isset($atts['slide']) && $atts['slide'] == 1) { //If slide is set then checks for max and order attributes, and ratify the $args array accordingly
            $slide = 1;
            if (isset($atts['max'])) {
                $args['posts_per_page'] = $atts['max'];
            }
            if (isset($atts['odr'])) {
                $args['order'] = $atts['odr'];
            }
        } elseif (isset($atts['id'])) { //If id of the testimonial is set, ratify the $args array accordingly
            $args['p'] = $atts['id'];
        } elseif (isset($atts['rand'])) { // If rand(for showing a random testimonial) is set, ratify the $args array accordingly
            $args['orderby'] = 'rand';
            $args['posts_per_page'] = 1;

        }

        $testimonial = new WP_Query($args);

        if ($testimonial->have_posts()) {

            if (isset($slide)) {

                $output = '<div class="slider_one_big_picture">';
            } else {
                $output = '';
            }

            while($testimonial->have_posts()){
                $testimonial->the_post();
                $post_id = $testimonial->post->ID;
                $client_name = get_post_meta($post_id, 'rs_dr_testimonial_client_name', true);
                $client_email = get_post_meta($post_id, 'rs_dr_testimonial_email', true);
                $client_position = get_post_meta($post_id, 'rs_dr_testimonial_position', true);
                $client_location = get_post_meta($post_id, 'rs_dr_testimonial_location', true);
                $client_rating = get_post_meta($post_id, 'rs_dr_testimonial_rating', true);


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
            if (isset($slide)) {

                $output .= <<<EOL
        <div class="next_button" style="display: inline-block;"></div>
        <div class="prev_button"></div>
      </div>
EOL;
            }
            // Check if cache option is set

            if ($option = get_option('rs_dr_cache_options')) {
                // Set Transients
                set_transient('rs_dr_t_shorcode', $output);
            }
            return $output;
        }else{
            return 'No Testimonial Found';
        }
    }

}