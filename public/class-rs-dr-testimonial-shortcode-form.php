<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/public
 */

use includes\Rs_Dr_Testimonial_Sanitation;

/**
 * The Class for displaying testimonial form shortcode.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/public
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Shortcode_Form extends Rs_Dr_Testimonial_Public
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
     * Register a shortcode
     *
     * @since   1.0.0
     */
    public function reg_form_shortcode()
    {
        add_shortcode('rs_dr_t_form', [$this, 'display_form_shortcode']);
    }

    /**
     * Display the shortcode
     *
     * @since   1.0.0
     */
    public function display_form_shortcode($atts)
    {
        if (!is_user_logged_in()) {
            return "You need to be logged in to submit a form!";
        }
        ob_start();
        if (isset($_GET)) {
            foreach ($_GET as $value) {
                echo "<strong>$value</strong><br>";
            }
        }
        // Include the HTML form
        require_once RS_DR_TEST_DIR . "public/partials/rs-dr-testimonial-form.php";

        $out = ob_get_clean();
        return $out;
    }


    /**
     * Taxonomy term drop-down
     *
     * @since   1.0.0
     * @param   string $taxonomy_name The name of the taxonomy
     * @param   int $selected ID of the term to be selected
     * @return string
     */
    private function create_dropdown(string $taxonomy_name, int $selected = 0)
    {
        $args = [
            'taxonomy' => $taxonomy_name,
            'name' => 'test_cat',
            'selected' => $selected,
            'hide_empty' => 0,
            'echo' => 0
        ];
        return wp_dropdown_categories($args);
    }

    /**
     * Handle form submission
     *
     * @since   1.0.0
     */
    public function form_submission()
    {
        global $current_user;

        $msg_array['message'] = 4;
        // Check if the recaptcha is pressed and then check for recaptcha
        if (isset($_POST['g-recaptcha-response'])) { // isset($_POST['g-recaptcha-response'])
            //Get the reCaptcha response key
            $response_key = $_POST['g-recaptcha-response'];
            // The recaptcha secret key
            $secret_key = "6LcQYJEUAAAAAMTNuIziSBuAsCEc9TchbxgPsNh5";
            // Get the user IP address
            $user_IP = $_SERVER['REMOTE_ADDR'];
            //Create the URL for getting reCaptcha success or failure status
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response_key&remoteip=$user_IP";
            // Get the reCaptcha status data in JSON format
            $recap_status = file_get_contents($url);
            // Decode the JSON data
            $recap_status = json_decode($recap_status);

            if (!$recap_status->success) { // reCaptcha is temporarily shutdown  $recap_status->success
                $msg_array['message'] = "reCaptcha Problem";
            } else {
                if (isset($_POST['form_nonce']) && wp_verify_nonce($_POST['form_nonce'], 'rs_dr_t_from')) {
                    //Validation of the form
                    // Instance of the sanitation class
                    $sanitize = new Rs_Dr_Testimonial_Sanitation();

                    $usr_data = array();
                    $usr_data['client_name'] = $sanitize->validate_text_field($_POST['client_name']);
                    $usr_data['client_email'] = $sanitize->validate_email($_POST['client_email']);
                    $usr_data['web_address'] = $sanitize->validate_url($_POST['client_web_address']);
                    $usr_data['product_review'] = $sanitize->validate_text_field($_POST['product_review']);
                    $usr_data['rating'] = $sanitize->validate_radio(1, 5, $_POST['rating']);
                    $usr_data['test_cat'] = intval($_POST['test_cat']);
                    $usr_data['title'] = $sanitize->validate_text_field($_POST['title']);
                    $usr_data['testi_content'] = $sanitize->validate_textarea($_POST['testi_content']);
                    $usr_data['file'] = $sanitize->validate_file($_FILES['client_pic'], 200000);

                    if (!empty($sanitize->validation_error)) {
                        $msg_array = $sanitize->validation_error;
                    } else {

                        if ((!in_array(false, $usr_data))) {
                            $testimonial_post_data = [
                                'post_title' => $usr_data['title'],
                                'post_content' => $usr_data['testi_content'],
                                'post_status' => 'pending',
                                'post_author' => $current_user->ID,
                                'post_type' => 'rs_dr_testimonial'
                            ];
                            // Insert the data to a new post
                            if ($post_id = wp_insert_post($testimonial_post_data)) {
                                // Post meta update
                                update_post_meta($post_id, 'rs_dr_testimonial_client_name', $usr_data['client_name']);
                                update_post_meta($post_id, 'rs_dr_testimonial_email', $usr_data['client_email']);
                                update_post_meta($post_id, 'rs_dr_testimonial_position', $usr_data['web_address']);
                                update_post_meta($post_id, 'rs_dr_testimonial_location', $usr_data['product_review']);
                                $this->handle_inage_upload('client_pic', $post_id);
                                wp_set_object_terms($post_id, $usr_data['test_cat'], 'rs_dr_testimonial_type');
                                $msg_array['message'] = "Submitted";
                            } else {
                                $msg_array['message'] = "Not Submitted";
                            }
                        }
                    }

                }
            }
        }

        wp_redirect(
            add_query_arg(
                $msg_array,
                get_site_url()
            )
        );
    }

    /**
     * Handle file upload
     *
     * @since   1.0.0
     */
    private function handle_inage_upload($file, $post_id)
    {
        require_once ABSPATH . "wp-admin" . "/includes/image.php";
        require_once ABSPATH . "wp-admin" . "/includes/file.php";
        require_once ABSPATH . "wp-admin" . "/includes/media.php";

        $attachment_id = media_handle_upload($file, $post_id);

        update_post_meta($post_id, '_thumbmail_id', $attachment_id);
        return $attachment_id;
    }
}