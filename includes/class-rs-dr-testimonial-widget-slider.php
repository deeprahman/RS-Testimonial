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
     * @since 		1.0.0
     * @access 		private
     * @var 		string 			$plugin_name 		The ID of this plugin.
     */
    private $plugin_name;

    /**
     * Register widget with WordPress.
     */
    function __construct() {

        $this->plugin_name 			= 'rs-dr-testimonial';

        $name 					= esc_html__( 'RS Testimonial Cycle', 'rs-dr-testimonial' );
        $opts['classname'] 		= 'rs-dr-testimonial-html-class';
        $opts['description'] 	= esc_html__( 'Display Testimonial Slide-show', 'now-hiring' );
        $control				= array( 'width' => '', 'height' => '' );

        parent::__construct( false, $name, $opts, $control );

    } // __construct()

    /**
     * Back-end widget form.
     *
     * @see		WP_Widget::form()
     *
     * @uses	wp_parse_args
     * @uses	esc_attr
     * @uses	get_field_id
     * @uses	get_field_name
     * @uses	selected
     *
     * @param	array	$instance	Previously saved values from database.
     */
    function form( $instance ) {

//        Defults values if no previous valuse present
        $defaults['title'] = 'Testimonials';
        $defaults['count'] = '1';
        $dfaults['orderby'] = 'date';
        $dfaults['order'] = 'ASC';

        $instance = wp_parse_args((array) $instance, $defaults);

//        Input Title
        $field_title = 'title';
        $label_title = esc_html__( ucwords( $field_title ) );
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

        require(plugin_dir_path(__FILE__) . 'partials/rs-dr-testimonial-widget-form-display.php');
    } // form()

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see		WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @return 	array	$instance		Updated safe values to be saved.
     */
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['count'] = sanitize_text_field( $new_instance['count'] );
        $instance['date'] = sanitize_text_field( $new_instance['date'] );
        $instance['ASC'] = sanitize_text_field( $new_instance['ASC'] );

        return $instance;

    } // update()

    /**
     * Front-end display of widget.
     *
     * @see		WP_Widget::widget()
     *
     * @uses	apply_filters
     *
     * @param	array	$args		Widget arguments.
     * @param 	array	$instance	Saved values from database.
     *
     */
    function widget( $args, $instance ) {

        extract($args);
//        Retrieve the widget configuration options

        $title = (!empty($instance['title']) ? $instance['title'] : 'Testimonial');
        $count = (!empty($instance['count']) ? $instance['count'] : '1');
        $order_by = (!empty($instance['date']) ? $instance['date'] : 'date');
        $order = (!empty($instance['ASC']) ? $instance['ASC'] : 'DESC');


        //Arguments for WP_Query
        $query_args = [
                'post_type' => 'rs_dr_testimonial',
                'orderby'   => $order_by,
                'order'     => $order,
                'posts_per_page' => $count
        ];

//        Initiate WP_Query
        $testimonial = new WP_Query($query_args);

        if($testimonial->have_posts()){

            $output = '';
            echo $before_widget;
            echo $before_title;
            echo apply_filters('widget_title', $title);
            echo $after_title;

            echo "<div class=\"slider_one_big_picture\">";

            while($testimonial->have_posts()){
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
    <p id="rs-dr-content">{$excerpt}<span><a href="{$permalink}"> &nbsp;Read More...</a></p>
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

            echo $output."</div>".$after_widget;
        }else{

            echo "No Testimonial Has been published";
        }

    } // widget()

}