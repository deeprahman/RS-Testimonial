<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 */

/**
 * Deals With Shortcode Generation
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Shortcode_Generation extends Rs_Dr_Testimonial_Settings
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
     * Register the JavaScript for the shortcode generation page.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts_shortcode_gen_page($hook)
    {
        // Return execution if current page is not the desired page
        if ($hook !== 'rs-testimonial-settings_page_rs-dr-testimonial-shortcode-generation-page') {
            return;
        }
        //Enqueue The thickbox
        wp_enqueue_script('thickbox');
        // Enqueue the Jquery UI accordion
        wp_enqueue_script('jquery-ui-accordion', array('jquery', 'jquery-ui-core', 'jquery-ui-widget'));
        //Enqueue the JavaScript for ajax call
        wp_enqueue_script('ajax-short-gen',
            plugin_dir_url(__FILE__) . 'js/rs-dr-testimonial-shortcode-ajax.js',
            array('jquery'),
            $this->version,
            true);
        // Get the protocol for same origin policy
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        // Create the urs for sending ajax request
        $params = array('ajaxurl' => admin_url('admin-ajax.php', $protocol));
        // Send the url as javascript variable to the js page with handle ajax-short-gen
        wp_localize_script(
            'ajax-short-gen',
            'ajax_short',
            $params
        );
    }

    /**
     * Register CSS for shortcode generation page
     *
     * @since   1.0.0
     */
    public function enqueue_styles_shortcode_gen_page()
    {
        // Get the Loaded JavaScript files Information Object
        $wp_scripts = wp_scripts();
        // Load the jquery-ui-theme-smoothness css
        wp_enqueue_style(
            'jquery-ui-theme-smoothness',
            sprintf(
                '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css', // working for https as well now
                $wp_scripts->registered['jquery-ui-core']->ver
            )
        );
    }

    /**
     * Handle AJAX requests for shortcode generation
     *
     * @since   1.0.0
     */
    public function handle_ajax_request()
    {
        if (!current_user_can('manage_options')) {
            exit;
        }
        $shortcode = get_option('rs_dr_shortcode_options');
        $shortcode = isset($shortcode['rs_dr_t_shortcode']) ? $shortcode['rs_dr_t_shortcode'] : null;
        $type = filter_input(INPUT_POST, 'box', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //Common
        $image = isset($_POST['image']) ? 1 : null;
        $excerpt = isset($_POST['excerpt']) ? 1 : null;
        $title = isset($_POST['title']) ? 1 : null;

        switch ($type) {
            case 'rand':
                {
                    $output = "[$shortcode type='$type'" . ' ';
                    if ($image) {
                        $output .= "image='$image' ";
                    }
                    if ($excerpt) {
                        $output .= "excerpt='$excerpt' ";
                    }
                    if ($title) {
                        $output .= "title='$title'";
                    }
                    $output .= ']';
                    break;
                }
            case 'cycle':
                {
                    $count = intval(isset($_POST['count']) ? $_POST['count'] : -1);
                    $output = "[$shortcode type='$type' count='$count'" . ' ';
                    if ($image) {
                        $output .= "image='$image' ";
                    }
                    if ($excerpt) {
                        $output .= "excerpt='$excerpt' ";
                    }
                    if ($title) {
                        $output .= "title='$title'";
                    }
                    $output .= ']';
                    break;
                }
            case 'single':
                {
                    $id = intval(isset($_POST['post_id']) ? $_POST['post_id'] : null);
                    $output = "[$shortcode type='$type' id='$id'" . ' ';
                    if ($image) {
                        $output .= "image='$image' ";
                    }
                    if ($excerpt) {
                        $output .= "excerpt='$excerpt' ";
                    }
                    if ($title) {
                        $output .= "title='$title'";
                    }
                    $output .= ']';
                    break;
                }
        }
        print($output);
        exit;

    }
}