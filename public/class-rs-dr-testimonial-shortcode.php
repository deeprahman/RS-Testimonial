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


        $args = [];
        $args['post_type'] = 'rs_dr_testimonial';




        $testimonial = new WP_Query($args);

        if ($testimonial->have_posts()) {
            $output = '<div class="slider_one_big_picture">';
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
            $output .= <<<EOL
        <div class="next_button" style="display: inline-block;"></div>
        <div class="prev_button"></div>
      
EOL;

            return $output . "</div>";
        }else{

            return 'No Testimonial Found';
        }
    }

}
