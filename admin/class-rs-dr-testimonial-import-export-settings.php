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
//                fputcsv($file, array('ID','Author_ID','Date','Content','Excerpt')); For testing: we may need field headings

                foreach ($arr_post as $my_post) {
                    // cast wp_post object to array
                    $data = (array)$my_post;
                    $id = $data['ID'];
                    $author_id = $data['post_author'];
                    $date = $data['post_date'];
                    $content = $data['post_content'];
                    $excerpt = $data['post_excerpt'];
                    //Write each post on each row
                    $row = [$id, $author_id, $date, $content, $excerpt];
                    fputcsv($file, $row);
                }// end foreach $arr_post
            }// end $arr_post not empty block

        }


    }

    public function import_to_wp()
    {
        if (!current_user_can('manage_options')) {
            wp_die('Not Allowed');
        }
        //Check if the request came form wordpress admin part with a nonce, and submit button is clicked
        if (check_admin_referer('import-testimonial', 'the-import-nonce')) {
            // Instance of the sanitation class
            $validator = new Rs_Dr_Testimonial_Sanitation();
            //Allowed mime-type
            $allowed = ['text/csv'];
            //Check and store the uploaded file
            $file = isset($_FILES['testimonials']);
        }// End nonce and submit check block(Main block)
    }

}