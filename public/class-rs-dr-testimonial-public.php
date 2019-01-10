<?php


class Rs_Dr_Testimonial_Public
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

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rs_Dr_Testimonial_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rs_Dr_Testimonial_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */


        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rs-dr-testimonial-public.css', array(), $this->version, 'all');

        wp_enqueue_style('easy-slide', plugin_dir_url(__FILE__) . 'css/jquery.easy_slides.css', array(), null, 'all');


    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rs_Dr_Testimonial_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rs_Dr_Testimonial_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
//		Deragister Jquery
        wp_deregister_script('jquery');

//        Jquery From CDN
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, false);

        wp_enqueue_script('easy-slider-js', plugin_dir_url(__FILE__) . 'js/jquery.easy_slides.js', array(), null, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rs-dr-testimonial-public.js', array(), null, true);


    }

    public function custom_excerpt_length($length)
    {
        $length = get_option('rs_dr_testimonial_options');
        $length = $length['length_excerpt'];
        return $length;
    }

}