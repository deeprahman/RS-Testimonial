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
 * Testimonial theme options change section in the plugin.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Themes_Settings extends Rs_Dr_Testimonial_Meta_Box
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
     * @since   1.0.0
     * @access  public
     * @var array
     */
    public static $default_theme_value = [
        'theme_value' => '1'
    ];

    /**
     * Register and enqueue theTheme CSS and js
     *
     * @since   1.0.0
     */
    public function enqueue_theme_styles_scripts($hook)
    {
        // Return execution if the current page is not the specified page
        if ($hook !== 'rs-testimonial-settings_page_rs-dr-testimonial-themes-settings-page') return;
        // Enqueue styles
        wp_enqueue_style('themes-css', PLUGIN_URL . 'includes/css/rs-dr-testimonial-public.css', array(), '1.0.0', 'all');
        // Enqueue Scripts
        wp_enqueue_script('theme-js', PLUGIN_URL . 'admin/js/rs-dr-testimonial-themes.js', array('jquery'), '1.0.1', false);
    }

    public function theme_save()
    {
        // Check the privilege of the current user
        if (!current_user_can('manage_options')) {
            wp_die('Not Allowed!');
        }
        // Check that the nonce field is created and configuration form is present
        check_admin_referer('save_theme_option', 'the_theme_nonce');
        // create the select field array
        $select_field[] = 'theme_value';
        // Get the options from the database
        $options = get_option('rs_dr_theme_options');
        // Store the value in the options array
        foreach ($select_field as $opt_key) {
            $options[$opt_key] = intval(isset($_POST[$opt_key]) ? $_POST[$opt_key] : 1);
        }
        // Store the updated option array
        update_option('rs_dr_theme_options', $options);
        //Redirect to the theme option page
        wp_redirect(
            add_query_arg(
                array('page' => 'rs-dr-testimonial-themes-settings-page', 'message' => '1'),
                admin_url('admin.php')
            )
        );
        exit;
    }
}