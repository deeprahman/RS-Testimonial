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
class Rs_Dr_Testimonial {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rs_Dr_Testimonial_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
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
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
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
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rs-dr-testimonial-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rs-dr-testimonial-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-meta-box.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-basic-settings.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-display-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-rs-dr-testimonial-public.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-rs-dr-testimonial-shortcode.php';

		$this->loader = new Rs_Dr_Testimonial_Loader();

        /**
         * The class responsible for defining all actions that occur in the public as well as admin facing
         * side of the site for slider widget.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rs-dr-testimonial-widget-slider.php';

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
	private function set_locale() {

		$plugin_i18n = new Rs_Dr_Testimonial_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

        $plugin_admin = new Rs_Dr_Testimonial_Meta_Box($this->get_plugin_name(), $this->get_version());
//		Instance of the settings class
        $plugin_settings = new Rs_Dr_Testimonial_Settings($this->get_plugin_name(), $this->get_version());
//        Instance of the basic Settings Class
        $plugin_basic_settings = new Rs_Dr_Testimonial_Basic_Settings($this->get_plugin_name(), $this->get_version());
//        Instance of the Display Settings class
        $plugin_display_settings = new Rs_Dr_Testimonial_Display_Settings($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );


//		hook for custom post type: Testimonials
		$this->loader->add_action( 'init', $plugin_admin, 'rs_dr_create_testimonial_post_type' );

//		Fires after all built-in meta boxes have been added.
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'rs_dr_admin_init' );
//		Save the meta box data
		$this->loader->add_action( 'save_post', $plugin_admin, 'rs_dr_save_client_info' );

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
        $this->loader->add_action('admin_init', $plugin_display_settings, 'register_display_sections');
        $this->loader->add_action('admin_init', $plugin_display_settings, 'register_display_options_fields');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Rs_Dr_Testimonial_Public( $this->get_plugin_name(), $this->get_version() );
        $plugin_shortcode = new Rs_Dr_Testimonial_Shortcode($this->get_plugin_name(), $this->get_version());


        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        //        For Registering Shortcode
        $this->loader->add_action('init', $plugin_shortcode, 'register_shortcodes');
//        For limiting excerpt length
        $this->loader->add_filter('excerpt_length', $plugin_public, 'custom_excerpt_length', 999);
        //For printing custom css on the head of the public facing pages
        $this->loader->add_filter('wp_head', $plugin_public, 'printCustomCss', 999);
    }

    /**
     * Register all of the hooks for widgets
     *
     * @since 		1.0.0
     * @access 		private
     */
    private function define_widget_hooks() {

        $this->loader->add_action( 'widgets_init', $this, 'widgets_init' );

    }

    /**
     * Registers widgets with WordPress
     *
     * @since 		1.0.0
     * @access 		public
     */
    public function widgets_init() {

        register_widget( 'Rs_Dr_Testimonial_Widget_Slider' );

    } // widgets_init()

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Rs_Dr_Testimonial_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
