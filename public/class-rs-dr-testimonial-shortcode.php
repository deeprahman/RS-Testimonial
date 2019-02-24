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
        // Retrieve the value of shortcode option form the database
        $shortcode = get_option('rs_dr_shortcode_options')['rs_dr_t_shortcode'];
        add_shortcode($shortcode, [$this, 'display_testmonial_shortcode']);
    }

    /**
     *
     * To show slider shortcode: [rs_dr_testimonial slide='1']
     * To show slider with specified maximum number of post: [rs_dr_testimonial slide='1' max='4']
     * to show slider with defined order: [rs_dr_testimonial slide='1' max='4' ord='ASC']
     * To show a random testimonial: [rs_dr_testimonial rand='1']
     * To show a testimonial with defined by post id: [rs_dr_testimonial id='5']
     * To show the lists of the testimonial: [rs_dr_testimonial]
     *
     * @param $atts
     * @return mixed|string
     */
    public function display_testmonial_shortcode($atts)
    {
        if ((isset(get_option('rs_dr_cache_options')['use_caching'])) && $output_short = get_transient('rs_dr_cache_store_shortcode')) {
            return $output_short;
        }

        //Fetch and store the output review option value form the data base
        $output_review = get_option('rs_dr_review_settings_options');
        $output_review = isset($output_review['output_review_markup']) ? $output_review['output_review_markup'] : null;

        // Evaluates to true iff all display fields are not set
        $eval_displays_ettings = !isset($atts['image']) && !isset($atts['title']) && !isset($atts['excerpt']) && !isset($atts['name']) && !isset($atts['email']) && !isset($atts['position']) && !isset($atts['location']) && !isset($atts['rating']) && !isset($atts['date']);
        if ($eval_displays_ettings) {

            $atts['image'] = '1';
            $atts['title'] = '1';
            $atts['excerpt'] = '1';
            $atts['name'] = '1';
            $atts['email'] = '1';
            $atts['position'] = '1';
            $atts['location'] = '1';
            $atts['rating'] = '1';
            $atts['date'] = '1';

        }

        // Get the arguments for WP_Query
        $args = $this->arguments($atts);


        if (isset($atts['type']) && $atts['type'] == "cycle") {
            $cycle = 1;

        }


        $testimonial = new WP_Query($args);

        if ($testimonial->have_posts()) {
            $output = '';
            while ($testimonial->have_posts()) {
                $testimonial->the_post();
                $post_id = $testimonial->post->ID;
                $img_url = wp_get_attachment_url(get_post_thumbnail_id($post_id));

                $testim['name'] = get_post_meta($post_id, 'rs_dr_testimonial_client_name', true);
                $testim['email'] = get_post_meta($post_id, 'rs_dr_testimonial_email', true);
                $testim['position'] = get_post_meta($post_id, 'rs_dr_testimonial_position', true);
                $testim['location'] = get_post_meta($post_id, 'rs_dr_testimonial_location', true);
                $testim['rating'] = get_post_meta($post_id, 'rs_dr_testimonial_rating', true);
                $testim['img'] = $this->get_image_url($img_url, $testim['email']);
                $testim['title'] = get_the_title();
                //Extract date format from database
                $dt_format = get_option('rs_dr_date_options');
                $dt_format = isset($dt_format) ? $dt_format['display_date_format'] : "F j, Y";
                // The Date of the post
                $testim['date'] = get_the_date($dt_format, $post_id);
                //If the post has excerpt, print it
                if (has_excerpt()) {
                    $testim['excerpt'] = wp_trim_excerpt();
                } else { //Make an excerpt from the content
                    $length = get_option('rs_dr_testimonial_options');
                    $length = $length['length_excerpt'];
                    $testim['excerpt'] = wp_trim_words(get_the_content(), $length);
                }// End if/else
                $testim['permalink'] = get_the_permalink();


                //Stores posts in string
                if (isset($atts['type']) && ($atts['type'] === 'cycle' || $atts['type'] === 'rand' || $atts['type'] === 'single')) {
                    $output .= $this->common_features($atts, $testim, $output_review);
                }//end if

            }// End while
            //When pagination, function returns here
            wp_reset_postdata();
            if (isset($cycle)) {
                $head = '<div class="slider_one_big_picture">';
                $button = <<<EOL
        <div class="next_button" style="display: inline-block;"></div>
        <div class="prev_button"></div>
      </div>
EOL;
                $output = $head . $output . $button;
            }


            // Check if cache option is set
            $option = get_option('rs_dr_cache_options');
            if (isset($option['use_caching'])) {
                // Set Transients
                set_transient('rs_dr_cache_store_shortcode', $output, $option['cache_time']);
            }
            return $output;
        } else {
            return 'No Testimonial Found';
        }
    }

    /**
     * This method takes array of shortcode attributes, processes those data and returns an array of arguments for WP_Query
     *
     * @param array $atts
     * @return array
     */
    private function arguments(array $atts): array
    {
        // Default arguments
        $args = [];
        $args['post_type'] = 'rs_dr_testimonial';
        $args['posts_per_page'] = -1;

        if (isset($atts['type'])) {
            switch ($atts['type']) {
                //When type is rand
                case 'rand':
                    {
                        $extracted_args = $this->common_args($atts);
                        $args = wp_parse_args($extracted_args, $args);
                        break;
                    }
                case 'cycle':
                    {
                        $extracted_args = $this->common_args($atts);
                        $args = wp_parse_args($extracted_args, $args);
                        break;
                    }
                case 'single':
                    {
                        if (isset($atts['id'])) {
                            $args['p'] = $atts['id'];
                        }
                        $args['posts_per_page'] = 1;
                        break;
                    }

            }
        }

        return $args;
    }

    /**
     * This method handles displaying the following common features
     * Image, Title, Excerpt, Name, Email, Position, Location, Rating, Date
     *
     * @param   array $testim Values of different testimonial parameters
     * @param array $atts
     * @return string
     */
    private function common_features(array $atts, array $testim, $output_review): string
    {
        //The testimonial div begins
        $output = "<div class='rs-dr-container'>";
        if (isset($atts['image'])) {
            $output .= "<img id=\"image\" src=\"{$testim['img']}\" alt=\"image\">";
        }
        if (isset($atts['title'])) {
            $output .= "<p id=\"rs-dr-title\">{$testim['title']}</p>";
        }
        if (isset($atts['excerpt'])) {
            $output .= "<p id=\"rs-dr-content\" class=\"custom-css-excerpt\">{$testim['excerpt']}<span><a href=\"{$testim['permalink']}\"> &nbsp;Read More...</a></span></p>";
        }
        if (isset($atts['name'])) {
            $output .= "<span class=\"rs-dr-ci\">Client's Name: {$testim['name']}</span>";
        }
        if (isset($atts['email'])) {
            $output .= "<span class=\"rs-dr-ci\">Client's Email: {$testim['email']}</span>";
        }
        if (isset($atts['position'])) {
            $output .= "<span class=\"rs-dr-ci\">Client's Position: {$testim['position']}</span>";
        }
        if (isset($atts['location'])) {
            $output .= "<span class=\"rs-dr-ci\">Client's Location: {$testim['location']}</span>";
        }
        if (isset($atts['date'])) {
            $output .= "<span class=\"rs-dr-ci\">Date: {$testim['date']}</span>";
        }
        if (isset($atts['rating'])) {
            $output .= "<span class=\"rs-dr-ci\">Rating: {$testim['rating']}</span>";
        }
        {

            if (isset($output_review)) { // JSON-LD option is on
                $output .= <<<JSON
            <!--JSON-LD for search engine readability-->
<script type='application/ld+json'>
    {
        "@context":"http://schema.org",
        "@type":"Review",
        "itemReviewed":{"name": "{$testim['location']}"},
        "reviewRating":{
            "@type":"Rating",
            "ratingValue":"{$testim['rating']}"
        },
        "name":"{$testim['title']}",
        "author":{
        "@type":"person",
        "name":"{$testim['name']}"
        },
        "reviewBody":"{$testim['excerpt']}"
    }
</script>
JSON;
            }
        }

        $output .= "</div>"; // The testimonial div ends

        return $output;
    }

    /**
     * Process the common arguments like Order, Orderby, post per page  etc
     *
     * @param array $atts
     * @return array
     */
    private function common_args(array &$atts): array
    {
        $args = [];
        if (isset($atts['count'])) {
            $args['posts_per_page'] = intval($atts['count']);
        }
        if (isset($atts['odr'])) {
            $args['order'] = $atts['odr'];
        }
        if (isset($atts['odrby'])) {
            $args['orderby'] = $atts['odrby'];
        }
        if (isset($atts['category'])) {
            $cat = (int)$atts['category'];
            $args['tax_query'] = [
                [
                    'taxonomy' => 'rs_dr_testimonial_type',
                    'terms' => $cat
                ]
            ];
        }
        return $args;
    }

    /**
     * Retrieves image URL based upon different settings
     *
     * @param string $wpblog_fetrdimg If exists, featured image url
     * @param string $client_email Client's Email for getting gravater
     * @return string   Appropriate image URL
     */
    private function get_image_url(string $wpblog_fetrdimg, string $client_email): string
    {
        {//Begin Display Testimonial image section
            //Fetch the value of image indicator from database
            $img_ind = get_option('rs_dr_image_options');
            if (($gravatar = get_avatar_url($client_email)) && isset($img_ind['use_gravaters']) && empty($wpblog_fetrdimg)) { //If email address has a gravatar, and no image uploaded
                $image_testimonial = $gravatar;
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
                                    $image_testimonial = $mystery_image_path;
                                    break;
                                }
                            case 2:
                                {
                                    $image_testimonial = '';
                                }
                        }
                    } else {
                        $image_testimonial = $wpblog_fetrdimg;
                    }
                } else {
                    $image_testimonial = '';
                }
            }
        }//End Display Testimonial image section
        return $image_testimonial;
    }


}
