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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */

namespace admin;

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
}