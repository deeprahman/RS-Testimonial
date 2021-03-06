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


        wp_enqueue_style($this->plugin_name, PLUGIN_URL . 'includes/css/rs-dr-testimonial-public.css', array(), $this->version, 'all');

        wp_enqueue_style('easy-slide', plugin_dir_url(__FILE__) . 'css/jquery.easy_slides.css', array(), $this->version, 'all');
        wp_enqueue_style('simple-pagination', plugin_dir_url(__FILE__) . 'css/simplePagination.css', array(), $this->version, 'all');


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
//        wp_enqueue_script('jquery');

        wp_enqueue_script('easy-slider-js', plugin_dir_url(__FILE__) . 'js/jquery.easy_slides.js', array('jquery'), null, false);
        wp_enqueue_script('simple-pagination-plugin-js', plugin_dir_url(__FILE__) . 'js/jquery.simplePagination.js', array('jquery'), null, false);
        wp_enqueue_script('pagination-ajax-js', plugin_dir_url(__FILE__) . 'js/pagination.ajax.js', array('jquery', 'simple-pagination-plugin-js'), null, true);
        wp_localize_script('pagination-ajax-js', 'pageAjaxObj', ['ajax_url' => admin_url('admin-ajax.php')]);

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rs-dr-testimonial-public.js', array('jquery'), null, true);


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
        $width_option = get_option('rs_dr_width_options');
        //Default width
        if (isset($width_option) && !empty($width_option['testimonial_width'])) {
            $custom_css = <<<EOL
<style type="text/css">
    .rs-dr-container{
        width: {$width_option['testimonial_width']};
    }
    .slider_one_big_picture{
        width: {$width_option['testimonial_width']};
    }
</style>
EOL;
            echo $custom_css;

        }

        $options = get_option('rs_dr_basic_settings_options');
        // For all Screen
        if (isset($options) && !empty($options['css_all_screens'])) {
            $custom_css = <<<EOL
<style type="text/css">
    {$options['css_all_screens']}
</style>
EOL;
            echo $custom_css;

        }
        // For all Screen lass than or equal to 768px
        if (isset($options) && !empty($options['css_768_screens'])) {
            $custom_css_768 = <<<EOL
<style type="text/css">
    @media only screen and (max-width: 768px) {
        {$options['css_768_screens']}
    }
</style>
EOL;
            echo $custom_css_768;

        }
        // For all Screen lass than or equal to 320px
        if (isset($options) && !empty($options['css_320_screens'])) {
            $custom_css_320 = <<<EOL
<style type="text/css">
    @media only screen and (max-width: 320px) {
        {$options['css_320_screens']}
    }
</style>
EOL;
            echo $custom_css_320;

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

    /**
     * Theme change css
     *
     * @since   1.0.0
     */
    public function theme_change_css()
    {
        // Get the theme options form the database
        $options = get_option('rs_dr_theme_options');
        $value = intval(isset($options['theme_value']) ? $options['theme_value'] : 1);
        switch ($value) {
            case 1:
                {
                    $style = <<<EOL

EOL;
                    break;
                }
            case 2:
                {
                    $style = <<<EOL
<style>
    .rs-dr-container{
                background:#555653;
                color:silver;
            }
</style>
EOL;
                    break;
                }
            case 3:
                {
                    $style = <<<EOL
<style>
    .rs-dr-container{
                background:#ebede6;
                color: #161616
            }
            
</style>
EOL;
                    break;
                }
            default:
                {
                    $style = <<<EOL
<style>
    .rs-dr-container{
                border: none;
            }
</style>
EOL;
                    break;
                }
        }
        print($style);
    }

    /**
     * Theme change for single testimonial
     *
     * @since   1.0.0
     */
    public function theme_change_single_css()
    {
        // Get the theme options form the database
        $options = get_option('rs_dr_single_options');
        $value = intval(isset($options['single_theme']) ? $options['single_theme'] : 1);
        switch ($value) {
            case 1:
                {
                    $style = <<<EOL

EOL;
                    break;
                }
            case 2:
                {
                    $style = <<<EOL
<style>
    div.rs-dr-t-single-test{
                background:#555653;
                color:silver;
            }
</style>
EOL;
                    break;
                }
            case 3:
                {
                    $style = <<<EOL
<style>
    div.rs-dr-t-single-test{
                background:#ebede6;
                color: #161616
            }
            
</style>
EOL;
                    break;
                }
            default:
                {
                    $style = <<<EOL
<style>
    div.rs-dr-t-single-test{
                border: none;
            }
</style>
EOL;
                    break;
                }
        }
        print($style);
    }






    public function rs_session_start()
    {
        session_start();
    }
}