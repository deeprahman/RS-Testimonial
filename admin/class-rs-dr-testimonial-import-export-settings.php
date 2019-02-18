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
 * Deals With plugin's Import/Export testimonials
 *
 * Defines the plugin name, version, and methods for import and/or export testimonial
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */

namespace admin;

use includes\Rs_Dr_Testimonial_Sanitation;

class Rs_Dr_Testimonial_Import_Export_Settings extends \Rs_Dr_Testimonial_Meta_Box
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
     * All testimonial posts are made available for download in CSV form mat
     */
    public function export_to_csv()
    {
        // Check the privilege of the current user
        if (!current_user_can('manage_options')) {
            wp_die('Not Allowed!');
        }
        //Check if the request came from inside wordpress with a nonce, and the submit button was clicked
        if (check_admin_referer('export-testimonial', 'the-export-nonce') && $_POST['export_btn']) {
            $args = [
                'post_type' => 'rs_dr_testimonial',
                'post_status' => 'publish',
                'post_per_page' => -1
            ];
            // Get the all posts of the type 'rs_dr_testimonial
            $arr_post = get_posts($args);
            if (!empty($arr_post)) {
                // HTTP Headers for making content downloadable
                header('Content-type: text/csv');
                header('Content-Disposition: attachment; filename="RS Testimonial.csv"');
                header('Pragma: no-cache');
                header('Expires: 0');
                // Create a file pointer in write mode
                $file = fopen('php://output', 'w');
                fputcsv($file, array('ID', 'Author_ID', 'Date', 'Title', 'Content', 'Excerpt', 'Client\'s Name', 'Client\'s Email', 'Client\'s Web address', 'Client\'s Location', 'Rating'));

                foreach ($arr_post as $my_post) {
                    // cast wp_post object to array
                    $data = (array)$my_post;
                    $id = $data['ID'];
                    $author_id = $data['post_author'];
                    $date = $data['post_date'];
                    $title = $data['post_title'];
                    $content = $data['post_content'];
                    $excerpt = $data['post_excerpt'];
                    $client_name = get_post_meta($id, 'rs_dr_testimonial_client_name', true);
                    $email = get_post_meta($id, 'rs_dr_testimonial_email', true);
                    $position = get_post_meta($id, 'rs_dr_testimonial_position', true);
                    $location = get_post_meta($id, 'rs_dr_testimonial_location', true);
                    $rating = get_post_meta($id, 'rs_dr_testimonial_rating', true);
                    //Write each post on each row
                    $row = [$id, $author_id, $date, $title, $content, $excerpt, $client_name, $email, $position, $location, $rating];
                    fputcsv($file, $row, ',', '"', "\\");
                }// end foreach $arr_post
            } else {
                $defaults = [
                    'page' => 'rs-dr-testimonial-import-export-page',
                    'tab' => 'export-tab',
                    'msg' => 0
                ];
                wp_redirect(
                    add_query_arg(
                        $defaults,
                        admin_url('admin.php')
                    )
                );
            }

        }

    }

    /**
     * Creates posts form uploaded CSV file
     */
    public function import_to_wp()
    {
        if (!current_user_can('manage_options')) {
            wp_die('Not Allowed');
        }
        // Insert post status
        $msg = 0;
        //Check if the request came form wordpress admin part with a nonce, and submit button is clicked
        if (check_admin_referer('import-testimonial', 'the-import-nonce')) {
            // Instance of the sanitation class
            $validator = new Rs_Dr_Testimonial_Sanitation();
            //Allowed mime-type
            $allowed = ['text/plain'];
            //Check and store the uploaded file
            $file = isset($_FILES['testimonials']) ? $_FILES['testimonials'] : null;

            // Sanitize and validate the the input file
            $validator->validate_file_general($file, 2000000, $allowed);
            //Begin Validation failed block
            if (!empty($args = $validator->validation_error) && ($file['type'] !== 'text/csv')) {
                $defaults = [
                    'page' => 'rs-dr-testimonial-import-export-page',
                    'tab' => 'import-tab'
                ];
                $query_string = wp_parse_args($args, $defaults);
                wp_redirect(
                    add_query_arg(
                        $query_string,
                        admin_url('admin.php')
                    )
                );

                exit();

            }//End Validation Failed Block
            //Create a file pointer in read mode
            $handle = fopen($file['tmp_name'], 'r');
            //Read each row at a time
            global $current_user;
            //The row counter for CSV data
            $row_count = 1;

            while ($row = fgetcsv($handle, 0, ',', '"', '\\')) {
                // Ignore the First row of the data
                if ($row_count === 1) {
                    //Increase the counter
                    $row_count++;
                    continue;
                }// End count check


                //Array of arguments for programmatically creating posts
                $testimonial_post_date = [
                    'post_title' => $row[3],
                    'post_content' => $row[4],
                    'post_status' => 'publish',
                    'post_author' => $current_user->ID,
                    'post_type' => 'rs_dr_testimonial'
                ];
                if ($post_id = wp_insert_post($testimonial_post_date)) {
                    update_post_meta($post_id, 'rs_dr_testimonial_client_name', $row[6]);
                    update_post_meta($post_id, 'rs_dr_testimonial_email', $row[7]);
                    update_post_meta($post_id, 'rs_dr_testimonial_position', $row[8]);
                    update_post_meta($post_id, 'rs_dr_testimonial_location', $row[9]);
                    update_post_meta($post_id, 'rs_dr_testimonial_rating', $row[10]);
                    $msg = 1;
                } else {

                    break;
                }// End if:  insert posts
            }// End while
        }// End nonce and submit check block(Main block)
        $defaults = [
            'page' => 'rs-dr-testimonial-import-export-page',
            'tab' => 'import-tab',
            'msg' => $msg
        ];
        wp_redirect(
            add_query_arg(
                $defaults,
                admin_url('admin.php')
            )
        );
    }//End method import_to_wp

}//End class