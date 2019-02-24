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
 * The widget functionality of the plugin.
 *
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Widget_Slider extends WP_Widget
{
    /**
     * The ID of this plugin.
     *
     * @since        1.0.0
     * @access        private
     * @var        string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    public static $instance_counter = 0;

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {

        $this->plugin_name = 'rs-dr-testimonial';

        $name = esc_html__('RS Testimonial Cycle', 'rs-dr-testimonial');
        $opts['classname'] = 'rs-dr-testimonial-html-class';
        $opts['description'] = esc_html__('Display Testimonial Slide-show', 'rs-dr-testimonial');
        $control = array('width' => '', 'height' => '');

        parent::__construct(false, $name, $opts, $control);

        //Increment the instance counter by 1
        Rs_Dr_Testimonial_Widget_Slider::$instance_counter++;

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

//        Defults values if no previous valuse present
        $defaults['title'] = 'Testimonials';
        $defaults['count'] = '1';
        $defaults['orderby'] = 'date';
        $defaults['order'] = 'ASC';
        $defaults['category'] = 0;
        $defaults['taxonomy'] = 'rs_dr_testimonial_type';
        $defaults['show_title'] = '1';
        $defaults['show_excerpt'] = '1';
        $defaults['show_image'] = '1';
        $defaults['show_location'] = '1';
        $defaults['show_date'] = '1';
        $defaults['show_more_link'] = '1';
        $defaults['show_rating'] = '2';

        $instance = wp_parse_args((array)$instance, $defaults);

//        Input Title
        $field_title = 'title';
        $label_title = esc_html__(ucwords($field_title));
        $id_title = $this->get_field_id($field_title);
        $name_title = $this->get_field_name($field_title);
        $value_title = esc_html($instance[$field_title]);

//        Input testimonial count
        $field_count = 'count';
        $label_count = esc_html__(ucwords($field_count));
        $id_count = $this->get_field_id($field_count);
        $name_count = $this->get_field_name($field_count);
        $value_count = esc_html__($instance[$field_count]);

//        Input ouderby
        $field_orderby = 'date';

        $id_orderby = $this->get_field_id($field_orderby);
        $name_orderby = $this->get_field_name($field_orderby);
        $value_orderby = esc_attr($instance[$field_orderby]);


//        Input order
        $field_order = 'ASC';

        $id_order = $this->get_field_id($field_order);
        $name_order = $this->get_field_name($field_order);
        $value_order = esc_attr($instance[$field_order]);

        // Select taxonomy
        $field_category = 'category';

        $label_category = esc_html__(ucwords($field_category));
        $id_category = $this->get_field_id($field_category);
        $name_category = $this->get_field_name($field_category);
        $selected_category = esc_attr($instance[$field_category]);
        $name_taxonomy = $instance['taxonomy'];

        //Show title field
        $field_show_title = 'show_title';
        $label_show_title = esc_html__(ucwords($field_show_title));
        $id_show_title = $this->get_field_id($field_show_title);
        $name_show_title = $this->get_field_name($field_show_title);
        $value_show_title = esc_attr($instance['show_title']);

        // Show excerpt field
        $field_show_excerpt = 'show_excerpt';
        $label_show_excerpt = esc_html__(ucwords($field_show_excerpt));
        $id_show_excerpt = $this->get_field_id($field_show_excerpt);
        $name_show_excerpt = $this->get_field_name($field_show_excerpt);
        $value_show_excerpt = esc_attr($instance['show_excerpt']);

        // Show featured image
        $field_show_image = 'show_image';
        $label_show_image = esc_html__(ucwords($field_show_image));
        $id_show_image = $this->get_field_id($field_show_image);
        $name_show_image = $this->get_field_name($field_show_image);
        $value_show_image = esc_attr($instance['show_image']);

        //Show testimonial date
        $field_show_date = 'show_date';
        $label_show_date = esc_html__(ucwords($field_show_date));
        $id_show_date = $this->get_field_id($field_show_date);
        $name_show_date = $this->get_field_name($field_show_date);
        $value_show_date = esc_attr($instance['show_date']);

        //Show testimonial Location Review
        $field_show_location = 'show_location';
        $label_show_location = esc_html__(ucwords($field_show_location));
        $id_show_location = $this->get_field_id($field_show_location);
        $name_show_location = $this->get_field_name($field_show_location);
        $value_show_location = esc_attr($instance['show_location']);

        //Show testimonial More Links
        $field_show_more_link = 'show_more_link';
        $label_show_more_link = esc_html__(ucwords($field_show_more_link));
        $id_show_more_link = $this->get_field_id($field_show_more_link);
        $name_show_more_link = $this->get_field_name($field_show_more_link);
        $value_show_more_link = esc_attr($instance['show_more_link']);

        //Show testimonial Rating
        $field_show_rating = 'show_rating';
        $label_show_rating = esc_html__(ucwords($field_show_rating));
        $id_show_rating = $this->get_field_id($field_show_rating);
        $name_show_rating = $this->get_field_name($field_show_rating);
        $value_show_rating = esc_attr($instance['show_rating']);


        require(plugin_dir_path(__FILE__) . 'partials/rs-dr-testimonial-widget-form-display.php');
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

        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['count'] = sanitize_text_field($new_instance['count']);
        $instance['date'] = sanitize_text_field($new_instance['date']);
        $instance['ASC'] = sanitize_text_field($new_instance['ASC']);
        $instance['category'] = sanitize_text_field($new_instance['category']);
        $instance['show_title'] = sanitize_text_field($new_instance['show_title']);
        $instance['show_excerpt'] = sanitize_text_field($new_instance['show_excerpt']);
        $instance['show_image'] = sanitize_text_field($new_instance['show_image']);
        $instance['show_date'] = sanitize_text_field($new_instance['show_date']);
        $instance['show_location'] = sanitize_text_field($new_instance['show_location']);
        $instance['show_more_link'] = sanitize_text_field($new_instance['show_more_link']);
        $instance['show_rating'] = sanitize_text_field($new_instance['show_rating']);


        return $instance;

    } // update()

    /**
     * Front-end display of widget.
     *
     * @see        WP_Widget::widget()
     *
     * @uses       apply_filters
     *
     * @param    array $args Widget arguments.
     * @param    array $instance Saved values from database.
     *
     */
    function widget($args, $instance)
    {

        extract($args);
//        Retrieve the widget configuration options

        $title = (!empty($instance['title']) ? $instance['title'] : 'Testimonial');
        $count = (!empty($instance['count']) ? $instance['count'] : '1');
        $order_by = (!empty($instance['date']) ? $instance['date'] : 'date');
        $order = (!empty($instance['ASC']) ? $instance['ASC'] : 'DESC');
        $category = intval(!empty($instance['category']) ? $instance['category'] : 2);

        $show_title = isset($instance['show_title']) ? $instance['show_title'] : 'null';
        $show_excerpt = isset($instance['show_excerpt']) ? $instance['show_excerpt'] : 'null';
        $show_image = isset($instance['show_image']) ? $instance['show_image'] : 'null';
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : 'null';
        $show_review = isset($instance['show_location']) ? $instance['show_location'] : 'null';
        $show_more_link = isset($instance['show_more_link']) ? $instance['show_more_link'] : 'null';
        $show_rating = intval(isset($instance['show_rating']) ? $instance['show_rating'] : '2');
        //Arguments for WP_Query
        $query_args = [
            'post_type' => 'rs_dr_testimonial',
            'orderby' => $order_by,
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


        require plugin_dir_path(dirname(__FILE__)) . 'includes/partials/rs-dr-testimonial-widget-slider-display.php';

    } // widget()

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