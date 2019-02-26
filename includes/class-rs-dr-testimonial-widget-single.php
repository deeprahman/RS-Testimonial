<?php
/**
 * Created by PhpStorm.
 * User: webdev
 * Date: 25/02/19
 * Time: 18:01
 */

namespace includes;


class Rs_Dr_Testimonial_Widget_Single extends \WP_Widget
{
    /**
     * The ID of this plugin.
     *
     * @since        1.0.0
     * @access        private
     * @var        string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {

        $this->plugin_name = 'rs-dr-testimonial';

        $name = esc_html__('RS Testimonial Single', 'rs-dr-testimonial');
        $opts['classname'] = 'rs-dr-testimonial-html-class';
        $opts['description'] = esc_html__('Display a Single Testimonial', 'rs-dr-testimonial');
        $control = array('width' => '', 'height' => '');

        parent::__construct(false, $name, $opts, $control);

    } // __construct()

    /**
     * Back-end widget form.
     *
     * @see        WP_Widget::form()
     *
     * @uses       wp_parse_args
     * @uses       esc_attr
     * @uses       get_field_id
     * @uses       get_field_name
     * @uses       selected
     *
     * @param    array $instance Previously saved values from database.
     */
    function form($instance)
    {
        //Get an array of testimonial
        $args = [];
        $args['post_type'] = 'rs_dr_testimonial';
        $args['posts_per_page'] = -1;
        $testimonials = new \WP_Query($args);
        if ($testimonials->have_posts()) {
            while ($testimonials->have_posts()) {
                $testimonials->the_post();
                $id = get_the_ID();
                $titles[$id] = get_the_title();
            }
        }

//        Defults values if no previous valuse present
        $defaults['single_title'] = 'Testimonials';
        $defaults['single_list_testimonial'] = '';
        $defaults['single_show_title'] = '1';
        $defaults['single_show_excerpt'] = '1';
        $defaults['single_show_image'] = '1';
        $defaults['single_show_location'] = '1';

        $defaults['single_show_date'] = '1';
        $defaults['single_show_more_link'] = '1';
        $defaults['single_show_rating'] = '2';

        $instance = wp_parse_args((array)$instance, $defaults);

//        Input Title
        $single_field_title = 'single_title';
        $single_label_title = esc_html__(ucwords('Title'));
        $single_id_title = $this->get_field_id($single_field_title);
        $single_name_title = $this->get_field_name($single_field_title);
        $single_value_title = esc_html($instance['single_title']);

        //Testimonial List
        $single_field_list = 'single_list_testimonial';
        $single_label_list = esc_html__(ucwords('List of Testimonials'));
        $single_id_list = $this->get_field_id($single_field_list);
        $single_name_list = $this->get_field_name($single_field_list);
        $single_value_list = esc_html($instance['single_list_testimonial']);

        //Show title field
        $single_field_show_title = 'single_show_title';
        $single_label_show_title = esc_html__(ucwords($single_field_show_title));
        $single_id_show_title = $this->get_field_id($single_field_show_title);
        $single_name_show_title = $this->get_field_name($single_field_show_title);
        $single_value_show_title = esc_attr($instance['single_show_title']);

        // Show excerpt field
        $single_field_show_excerpt = 'single_show_excerpt';
        $single_label_show_excerpt = esc_html__(ucwords($single_field_show_excerpt));
        $single_id_show_excerpt = $this->get_field_id($single_field_show_excerpt);
        $single_name_show_excerpt = $this->get_field_name($single_field_show_excerpt);
        $single_value_show_excerpt = esc_attr($instance['single_show_excerpt']);

        // Show featured image
        $single_field_show_image = 'single_show_image';
        $single_label_show_image = esc_html__(ucwords($single_field_show_image));
        $single_id_show_image = $this->get_field_id($single_field_show_image);
        $single_name_show_image = $this->get_field_name($single_field_show_image);
        $single_value_show_image = esc_attr($instance['single_show_image']);

        //Show testimonial date
        $single_field_show_date = 'single_show_date';
        $single_label_show_date = esc_html__(ucwords($single_field_show_date));
        $single_id_show_date = $this->get_field_id($single_field_show_date);
        $single_name_show_date = $this->get_field_name($single_field_show_date);
        $single_value_show_date = esc_attr($instance['single_show_date']);

        //Show testimonial Location Review
        $single_field_show_location = 'single_show_location';
        $single_label_show_location = esc_html__(ucwords($single_field_show_location));
        $single_id_show_location = $this->get_field_id($single_field_show_location);
        $single_name_show_location = $this->get_field_name($single_field_show_location);
        $single_value_show_location = esc_attr($instance['single_show_location']);

        //Show testimonial More Links
        $single_field_show_more_link = 'single_show_more_link';
        $single_label_show_more_link = esc_html__(ucwords($single_field_show_more_link));
        $single_id_show_more_link = $this->get_field_id($single_field_show_more_link);
        $single_name_show_more_link = $this->get_field_name($single_field_show_more_link);
        $single_value_show_more_link = esc_attr($instance['single_show_more_link']);

        //Show testimonial Rating
        $single_field_show_rating = 'single_show_rating';
        $single_label_show_rating = esc_html__(ucwords($single_field_show_rating));
        $single_id_show_rating = $this->get_field_id($single_field_show_rating);
        $single_name_show_rating = $this->get_field_name($single_field_show_rating);
        $single_value_show_rating = esc_attr($instance['single_show_rating']);


        require(plugin_dir_path(__FILE__) . 'partials/rs-dr-testimonial-widget-single-form-display.php');
    } // form()

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see        WP_Widget::update()
     *
     * @param    array $new_instance Values just sent to be saved.
     * @param    array $old_instance Previously saved values from database.
     *
     * @return    array    $instance        Updated safe values to be saved.
     */
    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['single_title'] = sanitize_text_field($new_instance['single_title']);
        $instance['single_list_testimonial'] = sanitize_text_field($new_instance['single_list_testimonial']);
        $instance['single_show_title'] = sanitize_text_field($new_instance['single_show_title']);
        $instance['single_show_excerpt'] = sanitize_text_field($new_instance['single_show_excerpt']);
        $instance['single_show_image'] = sanitize_text_field($new_instance['single_show_image']);
        $instance['single_show_location'] = sanitize_text_field($new_instance['single_show_location']);
        $instance['single_show_date'] = sanitize_text_field($new_instance['single_show_date']);
        $instance['single_show_more_link'] = sanitize_text_field($new_instance['single_show_more_link']);
        $instance['single_show_rating'] = sanitize_text_field($new_instance['single_show_rating']);

        return $instance;

    } // update()

    /**
     * Front-end display of widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        extract($args);
//        Retrieve the widget configuration options

        $title = (!empty($instance['single_title']) ? $instance['single_title'] : 'Testimonial');

        $id_testimonial = intval(!empty($instance['single_list_testimonial']) ? $instance['single_list_testimonial'] : 0);

        $show_title = isset($instance['single_show_title']) ? $instance['single_show_title'] : 'null';
        $show_excerpt = isset($instance['single_show_excerpt']) ? $instance['single_show_excerpt'] : 'null';
        $show_image = isset($instance['single_show_image']) ? $instance['single_show_image'] : 'null';
        $show_date = isset($instance['single_show_location']) ? $instance['single_show_location'] : 'null';
        $show_review = isset($instance['single_show_date']) ? $instance['single_show_date'] : 'null';
        $show_more_link = isset($instance['single_show_more_link']) ? $instance['single_show_more_link'] : 'null';
        $show_rating = intval(isset($instance['single_show_rating']) ? $instance['single_show_rating'] : '2');

        $query_args = [
            'post_type' => 'rs_dr_testimonial',
            'posts_per_page' => 1,
            'p' => $id_testimonial
        ];
        // Get the review option array form the database
        $options = get_option('rs_dr_review_settings_options');


        require plugin_dir_path(dirname(__FILE__)) . 'includes/partials/rs-dr-testimonial-widget-single-display.php';
    }
}