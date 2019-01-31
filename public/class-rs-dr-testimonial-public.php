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


//		Deregister Jquery
        wp_deregister_script('jquery');

//        Jquery From CDN
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, false);

        wp_enqueue_script('easy-slider-js', plugin_dir_url(__FILE__) . 'js/jquery.easy_slides.js', array(), null, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rs-dr-testimonial-public.js', array(), null, true);


    }

    /**
     * Fetch the excerpt length form database
     *
     * @param $length
     * @return int
     */
    public function custom_excerpt_length($length): int
    {

        $length = get_option('rs_dr_excerpt_options');
        $length = $length['display_excerpt_char'];
        return $length;
    }

    /**
     * Fetch the custom css form the database and prints it
     *
     * @since 1.0.0
     */
    public function printCustomCss()
    {
        $options = get_option('rs_dr_basic_settings_options');

        if (isset($options) && !empty($options['css_all_screens'])) {
            $custom_css = <<<EOL
<style type="text/css">
    {$options['css_all_screens']}
</style>
EOL;
            echo $custom_css;

        }
    }

    /**
     * Custom CSS for Displaying testimonial Image
     *
     * @since   1.0.0
     */
    public function image_display_css()
    {
        //Fetch the image-size indicator form the database
        $img_siz_indcr = get_option('rs_dr_image_options');
        $img_siz_indcr = $img_siz_indcr['image_size'] ?? false;
        //A switch for selecting
        switch ($img_siz_indcr) {
            case 1 :
                {
                    $html = <<<EOL
<style>
#image{
height: 150px;
width:150px;
}
</style>
EOL;
                    break;
                }
            case 2:
                {
                    $html = <<<EOL
<style>
#image{
height: 300px;
width: 300px;
}
</style>
EOL;
                    break;
                }
        }
        print $html;
    }
}