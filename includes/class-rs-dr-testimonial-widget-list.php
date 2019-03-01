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
 *Widget for displaying testimonial list-wise
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */

namespace includes;


class Rs_Dr_Testimonial_Widget_List extends \WP_Widget
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

        $name = esc_html__('RS Testimonial List', 'rs-dr-testimonial');
        $opts['classname'] = 'rs-dr-testimonial-html-class';
        $opts['description'] = esc_html__('Display a list of Testimonials', 'rs-dr-testimonial');
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

//        Defults values if no previous valuse present
        $defaults['list_title'] = 'Testimonials';
        $defaults['list_count'] = '1';//max per page
        $defaults['list_orderby'] = 'date';
        $defaults['list_order'] = 'ASC';
        $defaults['list_category'] = 1;
        $defaults['list_taxonomy'] = 'rs_dr_testimonial_type';
        $defaults['list_show_title'] = '1';
        $defaults['list_show_excerpt'] = '1';
        $defaults['list_show_image'] = '1';
        $defaults['list_show_location'] = '1';

        $defaults['list_show_date'] = '1';
        $defaults['list_show_more_link'] = '1';
        $defaults['list_show_rating'] = '2';

        $instance = wp_parse_args((array)$instance, $defaults);

//        Input Title
        $list_field_title = 'list_title';
        $list_label_title = esc_html__(ucwords('List Title'));
        $list_id_title = $this->get_field_id($list_field_title);
        $list_namel_title = $this->get_field_name($list_field_title);
        $list_value_title = esc_html($instance[$list_field_title]);

//        Input testimonial count
        $list_field_count = 'list_count';
        $list_label_count = esc_html__('Max per page', 'rs-dr-testimonial');
        $list_id_count = $this->get_field_id($list_field_count);
        $list_name_count = $this->get_field_name($list_field_count);
        $list_value_count = esc_html__($instance[$list_field_count]);

//        Input ouderby
        $list_field_orderby = 'list_orderby';
        $list_label_orderby = esc_html__(ucwords('List Order'));
        $list_id_orderby = $this->get_field_id($list_field_orderby);
        $list_name_orderby = $this->get_field_name($list_field_orderby);
        $list_value_orderby = esc_attr($instance[$list_field_orderby]);


//        Input order
        $list_field_order = 'list_order';
        $list_label_order = esc_html__(ucwords('Sort By'));
        $list_id_order = $this->get_field_id($list_field_order);
        $list_name_order = $this->get_field_name($list_field_order);
        $list_value_order = esc_attr($instance[$list_field_order]);

        // Select taxonomy
        $list_field_category = 'list_category';

        $list_label_category = esc_html__(ucwords('category', 'rs-dr-testimonial'));
        $list_id_category = $this->get_field_id($list_field_category);
        $list_name_category = $this->get_field_name($list_field_category);
        $list_selected_category = esc_attr($instance[$list_field_category]);
        $list_name_taxonomy = $instance['list_taxonomy'];

        //Show title field
        $list_field_show_title = 'list_show_title';
        $list_label_show_title = esc_html__(ucwords('Show Title'));
        $list_id_show_title = $this->get_field_id($list_field_show_title);
        $list_name_show_title = $this->get_field_name($list_field_show_title);
        $list_value_show_title = esc_attr($instance[$list_field_show_title]);

        // Show excerpt field
        $list_field_show_excerpt = 'list_show_excerpt';
        $list_label_show_excerpt = esc_html__(ucwords('Show Excerpt'));
        $list_id_show_excerpt = $this->get_field_id($list_field_show_excerpt);
        $list_name_show_excerpt = $this->get_field_name($list_field_show_excerpt);
        $list_value_show_excerpt = esc_attr($instance['list_show_excerpt']);

        // Show featured image
        $list_field_show_image = 'list_show_image';
        $list_label_show_image = esc_html__(ucwords('Show Image'));
        $list_id_show_image = $this->get_field_id($list_field_show_image);
        $list_name_show_image = $this->get_field_name($list_field_show_image);
        $list_value_show_image = esc_attr($instance['list_show_image']);

        //Show testimonial date
        $list_field_show_date = 'list_show_date';
        $list_label_show_date = esc_html__(ucwords('Show Date'));
        $list_id_show_date = $this->get_field_id($list_field_show_date);
        $list_name_show_date = $this->get_field_name($list_field_show_date);
        $list_value_show_date = esc_attr($instance[$list_field_show_date]);

        //Show testimonial Location Review
        $list_field_show_location = 'list_show_location';
        $list_label_show_location = esc_html__(ucwords('Show Location'));
        $list_id_show_location = $this->get_field_id($list_field_show_location);
        $list_name_show_location = $this->get_field_name($list_field_show_location);
        $list_value_show_location = esc_attr($instance[$list_field_show_location]);


        //Show testimonial More Links
        $list_field_show_more_link = 'list_show_more_link';
        $list_label_show_more_link = esc_html__(ucwords($list_field_show_more_link));
        $list_id_show_more_link = $this->get_field_id($list_field_show_more_link);
        $list_name_show_more_link = $this->get_field_name($list_field_show_more_link);
        $list_value_show_more_link = esc_attr($instance['list_show_more_link']);

        //Show testimonial Rating
        $list_field_show_rating = 'list_show_rating';
        $list_label_show_rating = esc_html__(ucwords('Show Rating'));
        $list_id_show_rating = $this->get_field_id($list_field_show_rating);
        $list_name_show_rating = $this->get_field_name($list_field_show_rating);
        $list_value_show_rating = intval($instance['list_show_rating']);


        require(plugin_dir_path(__FILE__) . 'partials/rs-dr-testimonial-widget-list-form-display.php');
    } // form()

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['list_title'] = sanitize_text_field($new_instance['list_title']);
        $instance['list_count'] = sanitize_text_field($new_instance['list_count']);//Max per page
        $instance['list_orderby'] = sanitize_text_field($new_instance['list_orderby']);
        $instance['list_order'] = sanitize_text_field($new_instance['list_order']);
        $instance['list_category'] = sanitize_text_field($new_instance['list_category']);
        $instance['list_show_title'] = sanitize_text_field($new_instance['list_show_title']);
        $instance['list_show_excerpt'] = sanitize_text_field($new_instance['list_show_excerpt']);
        $instance['list_show_image'] = sanitize_text_field($new_instance['list_show_image']);
        $instance['list_show_date'] = sanitize_text_field($new_instance['list_show_date']);
        $instance['list_show_location'] = sanitize_text_field($new_instance['list_show_location']);
        $instance['list_show_more_link'] = sanitize_text_field($new_instance['list_show_more_link']);
        $instance['list_show_rating'] = sanitize_text_field($new_instance['list_show_rating']);


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

        $title = (!empty($instance['list_title']) ? $instance['list_title'] : 'Testimonial');
        $count = (!empty($instance['list_count']) ? $instance['list_count'] : '1');
        $order_by = (!empty($instance['list_orderby']) ? $instance['list_orderby'] : 'date');
        $order = (!empty($instance['list_order']) ? $instance['list_order'] : 'DESC');
        $category = intval(!empty($instance['list_category']) ? $instance['list_category'] : null);

        $show_title = isset($instance['list_show_title']) ? $instance['list_show_title'] : 'null';
        $show_excerpt = isset($instance['list_show_excerpt']) ? $instance['list_show_excerpt'] : 'null';
        $show_image = isset($instance['list_show_image']) ? $instance['list_show_image'] : 'null';
        $show_date = isset($instance['list_show_date']) ? $instance['list_show_date'] : 'null';
        $show_review = isset($instance['list_show_location']) ? $instance['list_show_location'] : 'null';
        $show_more_link = isset($instance['list_show_more_link']) ? $instance['list_show_more_link'] : 'null';
        $show_rating = intval(isset($instance['list_show_rating']) ? $instance['list_show_rating'] : '2');

        //The base url
        $pagination_base = add_query_arg('w_page_no', '%#%');

        $paged = intval(isset($_GET['w_page_no']) ? $_GET['w_page_no'] : 1);
        //Arguments for WP_Query
        $query_args = [
            'paged' => $paged,
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


        require plugin_dir_path(dirname(__FILE__)) . 'includes/partials/rs-dr-testimonial-widget-list-display.php';

    } // widget()

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