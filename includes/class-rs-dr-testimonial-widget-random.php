<?php
/**
 * The widget functionality of the plugin.
 *
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 */

/**
 * This widget is for displaying the testimonials in a random order
 *
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */

namespace includes;


class Rs_Dr_Testimonial_Widget_Random extends \WP_Widget
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
     * Rs_Dr_Testimonial_Widget_Random constructor.
     */
    public function __construct()
    {
        $this->plugin_name = 'rs-dr-testimonial';
        $id_base = false;
        $name = "RS Testimonial Random";
        $widget_options['classname'] = 'rs-dr-testimonial-html-class';
        $widget_options['description'] = __('Display Testimonials in Random Order', 'rs-dr-testimonial');
        $control_options = [
            'width' => '',
            'height' => ''
        ];
        parent::__construct($id_base, $name, $widget_options, $control_options);
    }

    public function form($instance)
    {
        //        Defults values if no previous valuse present
        $defaults['rand_title'] = 'Testimonials';
        $defaults['rand_count'] = '1';
//        $defaults['rand_orderby'] = 'date';
        $defaults['rand_order'] = 'ASC';
        $defaults['rand_category'] = null;
        $defaults['rand_taxonomy'] = 'rs_dr_testimonial_type';
        $defaults['rand_show_title'] = '1';
        $defaults['rand_show_excerpt'] = '1';
        $defaults['rand_show_image'] = '1';
        $defaults['rand_show_location'] = '1';

        $defaults['rand_show_date'] = '1';
        $defaults['rand_show_more_link'] = '1';
        $defaults['rand_show_rating'] = '2';

        $instance = wp_parse_args((array)$instance, $defaults);

        // Input Title
        $rand_field_title = 'rand_title';
        $rand_label_title = esc_html__(ucwords('Title'), 'rs-dr-testimonial');
        $rand_id_title = $this->get_field_id($rand_field_title);
        $rand_name_title = $this->get_field_name($rand_field_title);
        $rand_value_title = esc_html($instance[$rand_field_title]);

        // Input Testimonial Count
        $rand_field_count = 'rand_count';
        $rand_label_count = esc_html__(ucwords('Testimonial Count'), 'rs-dr-testimonial');
        $rand_id_count = $this->get_field_id($rand_field_count);
        $rand_name_count = $this->get_field_name($rand_field_count);
        $rand_value_count = esc_html($instance[$rand_field_count]);


        // Input testimonial sorting order
        $rand_field_sort = 'rand_order';
        $rand_label_sort = esc_html__(ucwords('Sort By'), 'rs-dr-testimonial');
        $rand_id_sort = $this->get_field_id($rand_field_sort);
        $rand_name_sort = $this->get_field_name($rand_field_sort);
        $rand_value_sort = esc_html($instance[$rand_field_sort]);

        //Input testimonial category
        $rand_field_cat = 'rand_category';
        $rand_label_cat = esc_html__(ucwords('Category'), 'ra-dr-testimonial');
        $rand_id_cat = $this->get_field_id($rand_field_cat);
        $rand_name_cat = $this->get_field_name($rand_field_cat);
        $rand_selected_category = esc_html($instance[$rand_field_cat]);
        $rand_name_taxonomy = $instance['taxonomy'];

        //Show title field
        $rand_field_show_title = 'rand_show_title';
        $rand_label_show_title = esc_html__(ucwords($rand_field_show_title));
        $rand_id_show_title = $this->get_field_id($rand_field_show_title);
        $rand_name_show_title = $this->get_field_name($rand_field_show_title);
        $rand_value_show_title = esc_attr($instance['rand_show_title']);

        // Show excerpt field
        $rand_field_show_excerpt = 'rand_show_excerpt';
        $rand_label_show_excerpt = esc_html__(ucwords($rand_field_show_excerpt));
        $rand_id_show_excerpt = $this->get_field_id($rand_field_show_excerpt);
        $rand_name_show_excerpt = $this->get_field_name($rand_field_show_excerpt);
        $rand_value_show_excerpt = esc_attr($instance['rand_show_excerpt']);

        // Show featured image
        $rand_field_show_image = 'rand_show_image';
        $rand_label_show_image = esc_html__(ucwords($rand_field_show_image));
        $rand_id_show_image = $this->get_field_id($rand_field_show_image);
        $rand_name_show_image = $this->get_field_name($rand_field_show_image);
        $rand_value_show_image = esc_attr($instance['rand_show_image']);

        //Show testimonial date
        $rand_field_show_date = 'rand_show_date';
        $rand_label_show_date = esc_html__(ucwords($rand_field_show_date));
        $rand_id_show_date = $this->get_field_id($rand_field_show_date);
        $rand_name_show_date = $this->get_field_name($rand_field_show_date);
        $rand_value_show_date = esc_attr($instance['rand_show_date']);

        //Show testimonial Location Review
        $rand_field_show_location = 'rand_show_location';
        $rand_label_show_location = esc_html__(ucwords($rand_field_show_location));
        $rand_id_show_location = $this->get_field_id($rand_field_show_location);
        $rand_name_show_location = $this->get_field_name($rand_field_show_location);
        $rand_value_show_location = esc_attr($instance['rand_show_location']);


        //Show testimonial More Links
        $rand_field_show_more_link = 'rand_show_more_link';
        $rand_label_show_more_link = esc_html__(ucwords($rand_field_show_more_link));
        $rand_id_show_more_link = $this->get_field_id($rand_field_show_more_link);
        $rand_name_show_more_link = $this->get_field_name($rand_field_show_more_link);
        $rand_value_show_more_link = esc_attr($instance['rand_show_more_link']);

        //Show testimonial Rating
        $rand_field_show_rating = 'rand_show_rating';
        $rand_label_show_rating = esc_html__(ucwords($rand_field_show_rating));
        $rand_id_show_rating = $this->get_field_id($rand_field_show_rating);
        $rand_name_show_rating = $this->get_field_name($rand_field_show_rating);
        $rand_value_show_rating = esc_attr($instance['rand_show_rating']);

        require(plugin_dir_path(__FILE__) . 'partials/rs-dr-testimonial-widget-random-form-display.php');
    }

    /**
     * Sanitize widget form values as they are saved.
     * @param $new_instance
     * @param $old_instance
     * @return mixed
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['rand_title'] = sanitize_text_field($new_instance['rand_title']);
        $instance['rand_count'] = sanitize_text_field($new_instance['rand_count']);
        $instance['rand_orderby'] = sanitize_text_field($new_instance['rand_orderby']);
        $instance['rand_order'] = sanitize_text_field($new_instance['rand_order']);
        $instance['rand_category'] = sanitize_text_field($new_instance['rand_category']);
        $instance['rand_show_title'] = sanitize_text_field($new_instance['rand_show_title']);
        $instance['rand_show_excerpt'] = sanitize_text_field($new_instance['rand_show_excerpt']);
        $instance['rand_show_image'] = sanitize_text_field($new_instance['rand_show_image']);
        $instance['rand_show_date'] = sanitize_text_field($new_instance['rand_show_date']);
        $instance['rand_show_location'] = sanitize_text_field($new_instance['rand_show_location']);

        $instance['rand_show_more_link'] = sanitize_text_field($new_instance['rand_show_more_link']);
        $instance['rand_show_rating'] = sanitize_text_field($new_instance['rand_show_rating']);


        return $instance;
    }

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

        $title = (!empty($instance['rand_title']) ? $instance['rand_title'] : 'Testimonial');
        $count = (!empty($instance['rand_count']) ? $instance['rand_count'] : '1');

        $order = (!empty($instance['rand_order']) ? $instance['rand_order'] : 'DESC');
        $category = intval(!empty($instance['rand_category']) ? $instance['rand_category'] : 1);

        $show_title = isset($instance['rand_show_title']) ? $instance['rand_show_title'] : 'null';
        $show_excerpt = isset($instance['rand_show_excerpt']) ? $instance['rand_show_excerpt'] : 'null';
        $show_image = isset($instance['rand_show_image']) ? $instance['rand_show_image'] : 'null';
        $show_date = isset($instance['rand_show_date']) ? $instance['rand_show_date'] : 'null';
        $show_review = isset($instance['rand_show_location']) ? $instance['rand_show_location'] : 'null';
        $show_more_link = isset($instance['rand_show_more_link']) ? $instance['rand_show_more_link'] : 'null';
        $show_rating = intval(isset($instance['rand_show_rating']) ? $instance['rand_show_rating'] : '2');

        $query_args = [
            'post_type' => 'rs_dr_testimonial',
            'orderby' => 'rand',
            'order' => $order,
            'posts_per_page' => $count,
            'tax_query' => [
                [
                    'taxonomy' => 'rs_dr_testimonial_type',
                    'terms' => $category
                ]
            ]
        ];
        // Get the review option array form the database
        $options = get_option('rs_dr_review_settings_options');


        require plugin_dir_path(dirname(__FILE__)) . 'includes/partials/rs-dr-testimonial-widget-randdom-display.php';
    }

    /**
     * @param $taxonomy_name
     * @param $selected
     * @param $name
     * @param $id
     * @return string
     */
    private function create_terms_dropdown($taxonomy_name, $selected, $name, $id): string
    {
        //Arguments for dropdown categories function
        $args = [

            'taxonomy' => $taxonomy_name,
            'name' => $name,
            'selected' => $selected,
            'hide_empty' => 1,
            'id' => $id,
            'echo' => 0
        ];
        return wp_dropdown_categories($args);
    }

}