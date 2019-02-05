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
 * Deals With plugin's advanced settings
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Advanced_Settings extends Rs_Dr_Testimonial_Settings
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
     * @var array Default value for advanced settings
     */
    public static $default_shortcode_setting = [
        'rs_dr_t_shortcode' => 'rs_dr_testimonial'
    ];

    /**
     * Register Shortcode Settings
     *
     * @since   1.0.0
     */
    public function register_advanced_settings()
    {
        register_setting(
            'rs_dr_t_shortcode_group',
            'rs_dr_shortcode_options',
            [&$this, 'shortcode_validator']
        );
    }

    /**
     * Validator callback function for shortcode settings
     *
     * @since   1.0.0
     */
    public function shortcode_validator(array $input): array
    {
        return $input;
    }

    /**
     * Create a section for shortcode
     *
     * @since   1.0.0
     */
    public function create_shortcode_section()
    {
        add_settings_section(
            'rs_dr_t_shortcode_id',
            'Shortcode',
            [&$this, 'shortcode_section_description_callback'],
            'rs-dr-t-shortcode-settings-page'
        );
    }

    public function shortcode_section_description_callback()
    {
        print 'Change the shortcode.';
    }

    /**
     * Create a field for shortcode
     *
     * @since   1.0.0
     */
    public function create_shortcode_field()
    {
        add_settings_field(
            'rs_dr_t_shortcode',
            'Shortcode Identifier',
            array(&$this, 'display_text_field'),
            'rs-dr-t-shortcode-settings-page',
            'rs_dr_t_shortcode_id',
            array('id' => 'rs_dr_t_shortcode', 'name' => 'rs_dr_shortcode_options', 'type' => 'text')
        );
    }

    /**
     * Test-box display callback function
     * @param array $data
     * @since   1.0.0
     */
    public function display_text_field(array $data = []): void
    {
        extract($data);
        if (isset($name) && isset($id) && isset($type)) {
            //Value of the name attribute in the input field
            $name_attr = $name . '[' . $id . ']';
            //Fetch the options form the database
            $options = get_option($name);
            //The value of the text field
            $value = esc_html($options[$id]);
            //HTML for text input field
            $html = <<<INPUT
<input type="{$type}" name="{$name_attr}" value="{$value}" size="40">
INPUT;
            print $html;
            return;
        } else {
            print "Something wrong in the settings field!";
            return;
        }
    }
}