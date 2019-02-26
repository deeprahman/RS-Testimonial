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
 * Registers and displays shortcode meta box.
 *
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Show_Sortcode_metabox extends Rs_Dr_Testimonial_Meta_Box
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
     * Called when administration section is visited
     */
    public function rs_dr_admin_init()
    {
        //Add Client Information Meta Box
        add_meta_box(
            'rs_dr_show_shortcode_meta_box',
            __('Shortcode for Single Testimonial'),
            array($this, 'rs_dr_show_shortcode_meta_box'),
            'rs_dr_testimonial',
            'side',
            'high'
        );
    }

    /**
     * Displays the meta-box
     * @param $post
     */
    public function rs_dr_show_shortcode_meta_box($post)
    {

        require_once plugin_dir_path(__FILE__) . 'partials/rs_dr_display_show_shortcode_meta_box.php';

    }
}