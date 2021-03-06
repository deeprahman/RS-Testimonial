<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */

use admin\mics\Rs_Dr_Testimonial_Post_Management_Columns;
use admin\Rs_Dr_Testimonial_Import_Export_Settings;


class Rs_Dr_Testimonial
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Rs_Dr_Testimonial_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('PLUGIN_NAME_VERSION')) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'rs-dr-testimonial';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_widget_hooks();
        $this->define_post_manage_hooks();
        $this->define_form_shortcode_hooks();
        $this->define_import_export_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Rs_Dr_Testimonial_Loader. Orchestrates the hooks of the plugin.
     * - Rs_Dr_Testimonial_i18n. Defines internationalization functionality.
     * - Rs_Dr_Testimonial_Admin. Defines all hooks for the admin area.
     * - Rs_Dr_Testimonial_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-meta-box.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-show-shrtcode-metabox.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-basic-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-display-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-advanced-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-shortcode-generation.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-rs-dr-testimonial-public.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-rs-dr-testimonial-shortcode.php';

        /**
         * The class responsible for defining all actions that occur in the public as well as admin facing
         * side of the site for slider widget.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-widget-slider.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-widget-random.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-widget-single.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-widget-list.php';

        /**
         * The class responsible caching the widget content.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rs-dr-testimonial-widget-cache.php';

        /**
         * The class responsible for changing themes
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-themes-settings.php';
        /**
         * The class responsible for managing columns in post list
         */
        require_once RS_DR_TEST_DIR . '/admin/mics/class-rs-dr-testimonial-post-management-columns.php';

        /**
         * The class responsible for displaying form in the front-end
         */
        require_once RS_DR_TEST_DIR . 'public/class-rs-dr-testimonial-shortcode-form.php';

        /**
         * The class containing various sanitation methods
         */
        require_once RS_DR_TEST_DIR . "includes/class-rs-dr-testimonial-sanitation.php";
        /**
         * The file containing the class responsible for testimonial import and export to csv format
         */
        require_once RS_DR_TEST_DIR . "admin/class-rs-dr-testimonial-import-export-settings.php";

        $this->loader = new Rs_Dr_Testimonial_Loader();


    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Rs_Dr_Testimonial_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Rs_Dr_Testimonial_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Rs_Dr_Testimonial_Meta_Box($this->get_plugin_name(), $this->get_version());
        // Instance of the shortcode metabox class
        $plugin_metabox_shortcode = new Rs_Dr_Testimonial_Show_Sortcode_metabox($this->get_plugin_name(), $this->get_version());
//		Instance of the settings class
        $plugin_settings = new Rs_Dr_Testimonial_Settings($this->get_plugin_name(), $this->get_version());
//        Instance of the basic Settings Class
        $plugin_basic_settings = new Rs_Dr_Testimonial_Basic_Settings($this->get_plugin_name(), $this->get_version());
//        Instance of the Display Settings class
        $plugin_display_settings = new Rs_Dr_Testimonial_Display_Settings($this->get_plugin_name(), $this->get_version());
//        Instance of advanced settings class
        $plugin_advanced_settings = new Rs_Dr_Testimonial_Advanced_Settings($this->get_plugin_name(), $this->get_version());
//        Instance of Shortcode Generation class
        $plugin_shortcode_gen = new Rs_Dr_Testimonial_Shortcode_Generation($this->get_plugin_name(), $this->get_version());
//        Instance of the Theme Settings class
        $plugin_theme_settings = new Rs_Dr_Testimonial_Themes_Settings($this->get_plugin_name(), $this->get_version());


        /*==============================================================*/

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        /**
         * AJAX HOOKS
         */
//        AJAX call for shortcode generation(hook wp_ajax + action value in js data object)
        $this->loader->add_action('wp_ajax_rs_dr_t_shortcode_gen', $plugin_shortcode_gen, 'handle_ajax_request');

//		hook for custom post type: Testimonials
        $this->loader->add_action('init', $plugin_admin, 'rs_dr_create_testimonial_post_type');

//		Fires after all built-in meta boxes have been added.
        $this->loader->add_action('add_meta_boxes_rs_dr_testimonial', $plugin_admin, 'rs_dr_admin_init');
        $this->loader->add_action('add_meta_boxes_rs_dr_testimonial', $plugin_metabox_shortcode, 'rs_dr_admin_init');
//		Save the meta box data
        $this->loader->add_action('save_post', $plugin_admin, 'rs_dr_save_client_info');

//      runs after the basic admin panel menu structure is in place
        $this->loader->add_action('admin_menu', $plugin_settings, 'rs_dr_settings_menu');

//      Plugin's Basic Settings
        $this->loader->add_action('admin_init', $plugin_basic_settings, 'register_basic_settings');
        $this->loader->add_action('admin_init', $plugin_basic_settings, 'register_basic_sections');
        $this->loader->add_action('admin_init', $plugin_basic_settings, 'register_basic_options_fields');
        $this->loader->add_action('admin_init', $plugin_basic_settings, 'register_item_reviewed_options_fields');
        $this->loader->add_action('admin_init', $plugin_basic_settings, 'register_cache_options_fields');
//        Plugin's' Display Settings
        $this->loader->add_action('admin_init', $plugin_display_settings, 'register_display_settings');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_display_sections');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_excerpt_fields');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_date_fields');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_image_fields');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_width_fields');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_link_fields');
        $this->loader->add_action('admin_menu', $plugin_display_settings, 'create_single_fields');
//        Plugin's Advanced Settings
        $this->loader->add_action('admin_init', $plugin_advanced_settings, 'register_advanced_settings');
        $this->loader->add_action('admin_menu', $plugin_advanced_settings, 'create_shortcode_section');
        $this->loader->add_action('admin_menu', $plugin_advanced_settings, 'create_shortcode_field');
//        Plugin's shortcode generation options
        $this->loader->add_action('admin_enqueue_scripts', $plugin_shortcode_gen, 'enqueue_scripts_shortcode_gen_page');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_shortcode_gen, 'enqueue_styles_shortcode_gen_page');
//        Plugin's Theme Settings
        $this->loader->add_action('admin_enqueue_scripts', $plugin_theme_settings, 'enqueue_theme_styles_scripts');
        $this->loader->add_action('admin_post_save_theme_option', $plugin_theme_settings, 'theme_save');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new Rs_Dr_Testimonial_Public($this->get_plugin_name(), $this->get_version());
        $plugin_shortcode = new Rs_Dr_Testimonial_Shortcode($this->get_plugin_name(), $this->get_version());
        $plugin_widget_cache = new Rs_Dr_Testimonial_Widget_cache();

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_action('init', $plugin_public, 'rs_session_start');

        /*
         * Ajax in front-end
         */
        $this->loader->add_action('wp_ajax_pagination_ajax_reply', $plugin_shortcode, 'pagination_ajax_reply');
        $this->loader->add_action('wp_ajax_nopriv_pagination_ajax_reply', $plugin_shortcode, 'pagination_ajax_reply');
        //        For Registering Shortcode
        $this->loader->add_action('init', $plugin_shortcode, 'register_shortcodes');
//        For limiting excerpt length
        $this->loader->add_filter('excerpt_length', $plugin_public, 'custom_excerpt_length', 999);
        //For printing custom css on the head of the public facing pages
        $this->loader->add_filter('wp_head', $plugin_public, 'printCustomCss', 999);

        //For printing widgets from cache
        $this->loader->add_action('widget_display_callback', $plugin_widget_cache, 'cache_widget_output', 10, 3);

        //Printing Image-Size css in the head element of the public facing pages
        $this->loader->add_action('wp_head', $plugin_public, 'image_display_css');
//        Print Theme css in the head element of the public facing face
        $this->loader->add_action('wp_head', $plugin_public, 'theme_change_css');
        $this->loader->add_action('wp_head', $plugin_public, 'theme_change_single_css');
    }

    /**
     * Register all of the hooks for widgets
     *
     * @since        1.0.0
     * @access        private
     */
    private function define_widget_hooks()
    {

        $this->loader->add_action('widgets_init', $this, 'widgets_init');

    }

    /**
     * Register all the hooks for Post Management Screen
     * @since   1.0.0
     * @access  private
     */
    private function define_post_manage_hooks()
    {
        $plugin_post_manage = new Rs_Dr_Testimonial_Post_Management_Columns($this->get_plugin_name(), $this->get_version(), 'rs_dr_testimonial');
        // Display the manage post table head
        $this->loader->add_filter("manage_{$plugin_post_manage->post_type}_posts_columns", $plugin_post_manage, 'add_columns');
        // Display each row
        $this->loader->add_action('manage_posts_custom_column', $plugin_post_manage, 'populate_column', 10, 2);
        // Make column sortable
        $this->loader->add_filter("manage_edit-{$plugin_post_manage->post_type}_sortable_columns", $plugin_post_manage, 'sortable_columns');

    }

    /**
     * Register all the hooks for printing form in the front-end
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_form_shortcode_hooks()
    {
        $plugin_form_shortcode = new Rs_Dr_Testimonial_Shortcode_Form($this->get_plugin_name(), $this->get_version());

        // register a shortcode
        $this->loader->add_action('init', $plugin_form_shortcode, 'reg_form_shortcode');
        // Trigger a function when form is submitted
        $this->loader->add_action('admin_post_contact_form', $plugin_form_shortcode, 'form_submission');
    }

    /**
     * Register all of the hooks related to the import/export testimonial
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_import_export_hooks()
    {
        $plugin_export = new Rs_Dr_Testimonial_Import_Export_Settings($this->get_plugin_name(), $this->get_version());

        // Call an action for exporting CSV file
        $this->loader->add_action('admin_post_export-testimonial', $plugin_export, 'export_to_csv');
        // Call an action for importing testimonial post when post request is submitted to the admin-post.php
        $this->loader->add_action('admin_post_import-testimonial', $plugin_export, 'import_to_wp');
    }
    /**
     * Registers widgets with WordPress
     *
     * @since        1.0.0
     * @access        public
     */
    public function widgets_init()
    {

        register_widget('Rs_Dr_Testimonial_Widget_Slider');
        register_widget('includes\Rs_Dr_Testimonial_Widget_Random');// Namespaced
        register_widget('includes\Rs_Dr_Testimonial_Widget_Single');// Namespaced
        register_widget('includes\Rs_Dr_Testimonial_Widget_List');// Namespaced


    } // widgets_init()

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Rs_Dr_Testimonial_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

}
