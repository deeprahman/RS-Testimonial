<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define caching system for widget.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Widget_cache
{
    /**
     * $cache_time
     *
     * transient expiration time
     *
     * @var int
     */
    private $cache_time;

    /**
     * $option_name
     *
     * The name under which cache options are saved
     *
     * @var string
     */
    private $options_array;

    /**
     * __construct
     *
     * class constructor where we shall get the value for cache time setting and set the value
     */
    public function __construct()
    {
        $options = get_option('rs_dr_cache_options');
        $this->cache_time = $options['cache_time'];
        // Set the option array
        $this->options_array = $options;
    }

    /**
     * Simple function to generate a unique id for the widget transient based on widget's instance and arguments
     *
     * @param array $i widget instance
     * @param array $a widget arguments
     * @return string md5 hash
     */
    public function get_widget_key($i, $a)
    {
        return 'rs_dr_cache_store' . md5(serialize(array($i, $a)));
    }

    /**
     * cache_widget_output
     * @param array $instance The current widget instance's settings
     * @param WP_Widget $widget The current widget instance.
     * @param array $args The array of defaults widget arguments.
     * @return mixed array|boolean
     */
    public function cache_widget_output($instance, $widget, $args)
    {
        if ((false === $instance)) {
            return $instance;
        }

        if (!isset($this->options_array['use_caching'])) {// Use cache is unchecked
            ob_start();
            // This renders the widget
            $widget->widget($args, $instance);
            // Get rendered widget from buffer
            $cached_widget = ob_get_clean();
            // Output the widget
            echo $cached_widget;
            // After the widget was rendered and printed we return to short-circuit the normal display of the widget
            return false;
        }// End if

        //Create a unique transient ID for this widget instance
        $transient_name = $this->get_widget_key($instance, $args);
        //Get the cached version of the widget
        if ((false === ($cached_widget = get_transient($transient_name)))) { // if no cached widget, render the widget and save it as transient.
            // Start a buffer to capture the widget output
            ob_start();
            // This renders the widget
            $widget->widget($args, $instance);
            // Get rendered widget from buffer
            $cached_widget = ob_get_clean();
            // Save/cache the widget output as a transient
            set_transient($transient_name, $cached_widget, $this->cache_time);
        }//end if
        // Output the widget
        echo $cached_widget;
        // After the widget was rendered and printed we return to short-circuit the normal display of the widget
        return false;
    }
}