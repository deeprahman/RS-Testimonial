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
     * Set Default Options
     *
     * @since    1.0.0
     * @access   public static
     * @var      array $default_settings The default settings of the plugin
     */
    public static $default_settings = [
        'length_excerpt' => 20

    ];

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
            'rs-dr-testimonial-settings',
            [$this, 'rs_dr_display_basic_settings_page'],
            'dashicons-admin-generic'
        );

        add_submenu_page(
            'rs-dr-testimonial-settings',
            'RS Testimonial Settings',
            'Basic',
            'manage_options',
            'rs-dr-testimonial-settings'
        );

        add_submenu_page(
            'rs-dr-testimonial-settings',
            'Display Settings',
            'Display',
            'manage_options',
            'rs-dr-testimonial-display-display-settings',
            [&$this, 'rs_dr_display_display_settings_page']
        );

        add_submenu_page(
            'rs-dr-testimonial-settings',
            'Advances Settings',
            'Advanced',
            'manage_options',
            'rs-dr-testimonial-display-advanced-settings',
            [&$this, 'rs_dr_display_advanced_settings_page']
        );

        add_submenu_page(
            'rs-dr-testimonial-settings',
            'Themes Settings',
            'Themes',
            'manage_options',
            'rs-dr-testimonial-display-themes-settings',
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

    /**
     * Register a settings menu
     *
     * @since 1.0.0
     */
    public function register_display_settings()
    {
        register_setting(
            'rs_dr_testimonial_settings',
            'rs_dr_testimonial_options',
            [$this, 'rs_dr_testimonial_validate_option']
        );
    }

    /**
     * Register Settings Section
     *
     * @since 1.0.0
     */
    public function register_display_sections()
    {
        add_settings_section(
            'rs_dr_testimonial_main_section',
            'Main Settings',
            array($this, 'rs_dr_testimonial_settings_section_callback'),
            'rs-dr-testimonial-section'
        );
    }

    /**
     * Register Settings Field
     *
     * @since 1.0.0
     */
    public function register_display_fields()
    {
        add_settings_field(
            'excerpt_length',
            'Length of Excerpt',
            array($this, 'rs_dr_testimonial_display_excerpt'),
            'rs-dr-testimonial-section',
            'rs_dr_testimonial_main_section',
            array('name' => 'length_excerpt')
        );
    }

    /**
     * Validate the settings input
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_validate_option($input)
    {

        $input['varsion'] = $this->version;
        $input['length_excerpt'] = (int)$input['length_excerpt'];
        return $input;

    }

    /**
     * Description of the section
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_settings_section_callback()
    {

        echo "<p>This is the main configuration section</p>";

    }

    /**
     * Display settings field for length of excerpt
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_display_excerpt($data = [])
    {

        extract($data);
        $options = get_option('rs_dr_testimonial_options');

        $excerpt_value = esc_html($options[$name]);

        $html = <<<EOL
<input type="number" name="rs_dr_testimonial_options[{$name}]" value="{$excerpt_value}">
EOL;
        echo $html;


    }


}