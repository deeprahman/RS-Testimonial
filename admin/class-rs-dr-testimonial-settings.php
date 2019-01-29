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
 * Deals With plugin settings
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Settings extends Rs_Dr_Testimonial_Meta_Box
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
     * Registers Menu page
     *
     * @since 1.0.0
     */
    public function rs_dr_settings_menu()
    {
        add_menu_page(
            'RS Testimonial Settings',
            'RS Testimonial Settings',
            'manage_options',
            'rs-dr-testimonial-basic-settings-page',
            [$this, 'rs_dr_display_basic_settings_page'],
            'dashicons-admin-generic'
        );

        add_submenu_page(
            'rs-dr-testimonial-basic-settings-page',
            'RS Testimonial Settings',
            'Basic',
            'manage_options',
            'rs-dr-testimonial-basic-settings-page'
        );

        add_submenu_page(
            'rs-dr-testimonial-basic-settings-page',
            'Display Settings',
            'Display',
            'manage_options',
            'rs-dr-testimonial-display-settings-page',
            [&$this, 'rs_dr_display_display_settings_page']
        );

        add_submenu_page(
            'rs-dr-testimonial-basic-settings-page',
            'Advances Settings',
            'Advanced',
            'manage_options',
            'rs-dr-testimonial-advanced-settings-page',
            [&$this, 'rs_dr_display_advanced_settings_page']
        );

        add_submenu_page(
            'rs-dr-testimonial-basic-settings-page',
            'Themes Settings',
            'Themes',
            'manage_options',
            'rs-dr-testimonial-themes-settings-page',
            [&$this, 'rs_dr_display_themes_settings_page']
        );

    }

    /**
     * Displays Basic Settings Page
     *
     * @since 1.0.0
     */
    public function rs_dr_display_basic_settings_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/rs_dr_display_basic_settings_page.php';
    }

    /**
     * Displays Display Settings Page
     *
     * @since 1.0.0
     */
    public function rs_dr_display_display_settings_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/rs_dr_display_display_settings_page.php';
    }

    /**
     * Displays Advanced Settings Page
     *
     * @since 1.0.0
     */
    public function rs_dr_display_advanced_settings_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/rs_dr_display_advanced_settings_page.php';
    }

    /**
     * Displays Themes Settings Page
     *
     * @since 1.0.0
     */
    public function rs_dr_display_themes_settings_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/rs_dr_display_themes_settings_page.php';
    }

}