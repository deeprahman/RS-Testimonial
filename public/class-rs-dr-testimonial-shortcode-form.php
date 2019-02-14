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
     * Responsible for holding the instance of the Sanitation class
     *
     * @since   1.0.0
     * @access  public
     * @var     object $sanitize The Sanitation instance
     */
    public $sanitation;

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
        if ($_GET['message'] === '1') {
            echo "<strong style='color: green'>Testimonial created and waiting for moderation!</strong>";
        } elseif ($_GET['message'] === '2') {
            echo "<strong style='color: red'>Something Wrong!</strong>";
        } elseif ($_GET['message'] === '3') {
            echo "<strong style='color: red;'>reCapcha Validation Failed!</strong>";
        } else {
            echo "<strong>Submit Testimonial</strong>";
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
        if (isset($_POST['g-recaptcha-response'])) {
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
            if (!$recap_status->success) {
                $msg_array['message'] = 3;
            } else {
                if (isset($_POST['form_nonce']) && wp_verify_nonce($_POST['form_nonce'], 'rs_dr_t_from')) {
                    $client_name = sanitize_text_field($_POST['client_name']);
                    $client_email = sanitize_email($_POST['client_email']);
                    $web_address = esc_url_raw($_POST['client_web_address']);
                    $product_review = sanitize_text_field($_POST['product_review']);
                    $rating = intval($_POST['rating']);
                    $testimonial_category = intval($_POST['test_cat']);
                    $testimonial_title = sanitize_text_field($_POST['title']);
                    $testimonial_content = sanitize_text_field($_POST['testi_content']);

                    //Validation of the form
                    // Instance of the sanitation class
                    $this->sanitation = new Rs_Dr_Testimonial_Sanitation();
                    $name = $this->sanitation->var;


                    if (($testimonial_content != '') && ($testimonial_title != '')) {
                        $testimonial_post_data = [
                            'post_title' => $testimonial_title,
                            'post_content' => $testimonial_content,
                            'post_status' => 'pending',
                            'post_author' => $current_user->ID,
                            'post_type' => 'rs_dr_testimonial'
                        ];
                        if ($post_id = wp_insert_post($testimonial_post_data)) {
                            // Post meta update
                            update_post_meta($post_id, 'rs_dr_testimonial_client_name', $client_name);
                            update_post_meta($post_id, 'rs_dr_testimonial_email', $client_email);
                            update_post_meta($post_id, 'rs_dr_testimonial_position', $web_address);
                            update_post_meta($post_id, 'rs_dr_testimonial_location', $product_review);
                            $this->handle_inage_upload('client_pic', $post_id);
                            wp_set_object_terms($post_id, $testimonial_category, 'rs_dr_testimonial_type');
                            $msg_array = ['message' => '1'];
                        } else {
                            $msg_array = ['message' => '2'];
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