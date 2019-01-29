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
 * Deals With plugin's Display settings
 *
 * Defines the plugin name, version.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Display_Settings extends Rs_Dr_Testimonial_Settings
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
     * @since  1.0.0
     * @access public static
     * @var array $default_display_settings Default values of the display settings
     */
    public static $default_display_settings = [
        'rs_dr_testimonial_display_excerpt_id' => 20
    ];

    /**
     * Registers all display settings
     *
     * @since 1.0.0
     */
    public function register_display_settings()
    {

        register_setting(
            'rs_dr_testimonial_display_settings_group',
            'rs_dr_testimonial_display_options',
            [&$this, 'display_settings_validator']
        );
    }

    /**
     * Adds sections for display settings
     *
     * @since 1.0.0
     */
    public function register_display_sections()
    {

        add_settings_section(
            'rs_dr_testimonial_display_section',
            'Display Section',
            [&$this, 'display_section_description_callback'],
            'rs-dr-testimonial-display-settings-page' //This is same as the display submenu slug
        );
    }

    /**
     * Adds fields for display section
     *
     * @since 1.0.0
     */
    public function register_display_options_fields()
    {

        add_settings_field(
            'rs_dr_testimonial_display_excerpt_id',
            'Excerpt Lenth',
            [&$this, 'display_textbox_input_field'],
            'rs-dr-testimonial-display-settings-page', //Same as the settings section slug
            'rs_dr_testimonial_display_section', //Same as the section id
            ['id' => 'rs_dr_testimonial_display_excerpt_id', 'name' => 'rs_dr_testimonial_display_options', 'type' => 'number']
        );

    }

    /**
     * Validates and sanitizes the display option input
     *
     * @since 1.0.0
     * @param $input
     * @return mixed
     */
    public function display_settings_validator($input)
    {

        $input['rs_dr_testimonial_display_excerpt_id'] = (intval($input['rs_dr_testimonial_display_excerpt_id']));
        return $input;
    }

    /**
     * Display the brief description of the display section
     */
    public function display_section_description_callback()
    {

        echo "This section is for controlling display on the public facing pages";
    }

    public function display_textbox_input_field($data = [])
    {
        extract($data);
        if (isset($id) && isset($name) && isset($type)) {
            //Value of the name attribute of the input field
            $name_attr = $name . '[' . $id . ']';
            //Get the relevant options from the database
            $options = get_option($name, Rs_Dr_Testimonial_Display_Settings::$default_display_settings);
            //Get the relevant value from the option array
            $value = esc_html($options[$id]);

            $html = <<<EOL
<input type="{$type}" name="{$name_attr}" value="{$value}" >
EOL;
            echo $html;
        } else {
            echo 'Something wrong in the text field';
        }
    }


}