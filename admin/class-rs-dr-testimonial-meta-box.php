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
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Meta_Box
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
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Creates array for registering post-type or taxonomy
     *
     * @param string $indicator Indicator for return array; argument value 'post' indicates  post-type registration array  and 'taxonomy' indicates taxonomy registration array
     * @return array
     */
    private function the_args(string $indicator): array
    {
        switch ($indicator) {
            case 'post':
                {
                    //Post-type arguments
                    $args['show_in_nav_menus'] = false;
                    $args['show_ui'] = true;
                    $args['taxonomies'] = array();
                    $args['menu_icon'] = 'dashicons-format-quote';
                    $args['has_archive'] = 'true';
                    $args['menu_position'] = 20;

                    $args['supports'][] = 'title';
                    $args['supports'][] = 'editor';
                    $args['supports'][] = 'thumbnail';
                    $args['supports'][] = 'excerpt';

                    $args['labels']['name'] = __('Testimonials', 'rs-dr-testimonial');
                    $args['labels']['singular_name'] = __('Testimonial', 'rs-dr-testimonial');
                    $args['labels']['add_new'] = __('Add New Testimonial', 'rs-dr-testimonial');
                    $args['labels']['add_new_item'] = __('Add New Testimonial', 'rs-dr-testimonial');
                    $args['labels']['edit'] = __('Edit', 'rs-dr-testimonial');
                    $args['labels']['edit_item'] = __('Edit Testimonial', 'rs-dr-testimonial');
                    $args['labels']['new_item'] = __('New Testimonial', 'rs-dr-testimonial');
                    $args['labels']['view'] = __('View', 'rs-dr-testimonial');
                    $args['labels']['view_item'] = __('View Testimonial', 'rs-dr-testimonial');
                    $args['labels']['search_items'] = __('Search Testimonial', 'rs-dr-testimonial');
                    $args['labels']['not_found'] = __('No Testimonial Found', 'rs-dr-testimonial');
                    $args['labels']['not_found_in_trash'] = __('No Testimonial Found in Trash', 'rs-dr-testimonial');
                    $args['labels']['parent'] = __('Parent Testimonial', 'rs-dr-testimonial');

                    $out =& $args;
                    break;
                }
            case 'taxonomy':
                {
                    // Taxonomy argument
                    $tax = array();
                    $tax['show_ui'] = true;
                    $tax['show_tagcloud'] = true;
                    $tax['hierarchical'] = true;

                    $tax['labels']['name'] = __('Testimonial Type', 'rs-dr-testimonial');
                    $tax['labels']['add_new_item'] = __('Add New Testimonial Type', 'rs-dr-testimonial');
                    $tax['labels']['new_item_name'] = __('Add New Testimonial Name', 'rs-dr-testimonial');

                    $out =& $tax;
                    break;
                }
        }
        return $out;
    }

    /**
     * Register the stylesheets for the admin area.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rs-dr-testimonial-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rs-dr-testimonial-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Construct the argument array for the Testimonial Post Type
     *
     * @param array $args Register custom post-type arguments
     * @return array
     */
    private function argsArray(array &$args): array
    {
        //Get the data form the database for show_in_search
        $options = get_option('rs_dr_basic_settings_options');
        $value = isset($options['show_in_search']) ? $options['show_in_search'] : 0;

        if ($value) {
            $search = [
                'exclude_from_search' => false,
                'publicly_queryable' => true,
            ];
            $args = array_merge($args, $search);
        }
        return $args;

    }

    /**
     * Creates the custom post type: Testimonial
     *
     */
    public function rs_dr_create_testimonial_post_type()
    {
        //Store the array of register post-type arguments in a variable
        $post_array = $this->the_args('post');
        //Store the array of taxonomy arguments in a variable
        $tax_array = $this->the_args('taxonomy');

//        Register the custom post type
        register_post_type('rs_dr_testimonial', $this->argsArray($post_array));

//        Register the Testimonial Type
        register_taxonomy('rs_dr_testimonial_type', 'rs_dr_testimonial', $tax_array);
    }

    /**
     * Called when administration section is visited
     */
    public function rs_dr_admin_init()
    {

        //Add Client Information Meta Box
        add_meta_box(
            'rs_dr_client_information_meta_box',
            __('Client Information Details'),
            array($this, 'rs_dr_display_client_information_meta_box'),
            'rs_dr_testimonial',
            'advanced',
            'high'
        );
    }

    /**
     * Displays the meta-box
     * @param $post
     */
    public function rs_dr_display_client_information_meta_box($post)
    {

        require_once plugin_dir_path(__FILE__) . 'partials/rs_dr_display_client_information_meta_box.php';

    }

    /**
     * Save the Client Information
     *
     * @param $post_id
     */
    public function rs_dr_save_client_info($post_id)
    {

        if (isset($_POST['rs_dr_testimonial_client_info_nonce']) && isset($_POST['post_type'])) {

            // Don't save if the user hasn't submitted the changes
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // Verify that the input is coming from the proper form
            if (!wp_verify_nonce($_POST['rs_dr_testimonial_client_info_nonce'], 'rs_dr_testimonial_client_info_action')) {
                return;
            } // end if

            // Make sure the user has permissions to post
            if ('rs_dr_testimonial' == $_POST['post_type']) {
                if (!current_user_can('edit_post', $post_id)) {
                    return;
                } // end if
            } // end if/else

            // Read the Client's Name
            $rs_dr_testimonial_client_name = isset($_POST['rs_dr_testimonial_client_name']) ? $_POST['rs_dr_testimonial_client_name'] : '';
//            Read Client's email
            $rs_dr_testimonial_email = isset($_POST['rs_dr_testimonial_email']) ? $_POST['rs_dr_testimonial_email'] : '';
//            Read Client's position
            $rs_dr_testimonial_position = isset($_POST['rs_dr_testimonial_position']) ? $_POST['rs_dr_testimonial_position'] : '';
            //Read Client's location
            $rs_dr_testimonial_location = isset($_POST['rs_dr_testimonial_location']) ? $_POST['rs_dr_testimonial_location'] : '';
            //Read Rating
            $rs_dr_testimonial_rating = isset($_POST['rs_dr_testimonial_rating']) ? $_POST['rs_dr_testimonial_rating'] : '';

            // Update the Client Name.
            update_post_meta($post_id, 'rs_dr_testimonial_client_name', $rs_dr_testimonial_client_name);
            // Update the Client Email.
            update_post_meta($post_id, 'rs_dr_testimonial_email', $rs_dr_testimonial_email);
            // Update the Client Position.
            update_post_meta($post_id, 'rs_dr_testimonial_position', $rs_dr_testimonial_position);
            // Update the Client Location.
            update_post_meta($post_id, 'rs_dr_testimonial_location', $rs_dr_testimonial_location);
            // Update the Rating.
            update_post_meta($post_id, 'rs_dr_testimonial_rating', $rs_dr_testimonial_rating);
        }
    }


}
