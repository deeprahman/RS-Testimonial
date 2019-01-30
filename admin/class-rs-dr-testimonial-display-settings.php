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
     * @access   privateK
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
     * @var array $default_excerpt_settings Default values of the display settings
     */
    public static $default_excerpt_settings = [
        'display_excerpt_char' => 20
    ];
    /**
     * @since   1.0.0
     * @access  Public Static
     * @var array $default_date_settings Default values for the date settings
     */
    public static $default_date_settings = [
        'display_date_format' => 'F J, y'
    ];
    /**
     * @since   1.0.0
     * @access  Public Static
     * @var array $default_image_settings Default values for the image settings
     */
    public static $default_image_settings = [
        'show_testimonial_image' => 1,
        'image_size' => 1, //There are two image sizes; 1:150x150 px, 2: 300x300 px
        'fallback_image' => 3, //There are three types of fallback images, 1:Mystery Person; 2:Smart Text Avatar, 3:No Fallback Image
        'use_gravaters' => 1 //Use Gravatar if one is found with a matching email address
    ];
    /**
     * Registers all display settings
     *
     * @since 1.0.0
     */
    public function register_display_settings()
    {
        //Register Excerpt Settings
        register_setting(
            'rs_dr_t_excerpt_group',
            'rs_dr_excerpt_options',
            array(&$this, 'excerpt_validator')
        );
        register_setting(
            'rs_dr_t_date_group',
            'rs_dr_date_options',
            array(&$this, 'date_validator')
        );
        register_setting(
            'rs_dr_t_image_group',
            'rs_dr_image_options',
            array(&$this, 'image_validator')
        );
    }
    /**
     * Validator Callback Function for excerpt
     *
     * @since   1.0.0
     */
    public function excerpt_validator($input)
    {
        return $input;
    }

    /**
     * Validator callback function for date
     *
     * @since   1.0.0
     */
    public function date_validator($input)
    {
        return $input;
    }

    /**
     * Validator callback function for image
     *
     * @since   1.0.0
     */
    public function image_validator($input)
    {
        return $input;
    }

    /**
     * Create sections for display
     *
     * @since   1.0.0
     */
    public function create_display_sections()
    {
        //Excerpt Section
        add_settings_section(
            'rs_dr_t_excerpt_section_id',
            'Excerpt Section',
            array(&$this, 'excerpt_section_description_callback'),
            'rs-dr-t-excerpt-section-page'
        );
        //Date Section
        add_settings_section(
            'rs_dr_t_date_section_id',
            'Date Section',
            array(&$this, 'date_section_description_callback'),
            'rs-dr-t-date-section-page'
        );
        //Image Section
        add_settings_section(
            'rs_dr_t_image_section_id',
            'Image Section',
            array(&$this, 'image_section_description_callback'),
            'rs-dr-t-image-section-page'
        );
    }

    /**
     * Excerpt section callback
     *
     * @since   1.0.0
     */
    public function excerpt_section_description_callback()
    {
        print "Takes Value for the excerpt length";
    }

    /**
     * Date section callback
     *
     * @since   1.0.0
     */
    public function date_section_description_callback()
    {
        print 'Takes format specifier for displaying date';
    }

    /**
     * Image section callback
     *
     * @since   1.0.0
     */
    public function image_section_description_callback()
    {
        print 'Activate or deactivate different options for testimonial image';
    }

    /**
     * Create fields for displaying excerpt
     *
     * @since   1.0.0
     */
    public function create_excerpt_fields()
    {
        // The Excerpt Length Field
        add_settings_field(
            'display_excerpt_char',
            'Excerpt Length',
            array(&$this, 'display_text_field'),
            'rs-dr-t-excerpt-section-page',
            'rs_dr_t_excerpt_section_id',
            array('id' => 'display_excerpt_char', 'name' => 'rs_dr_excerpt_options', 'type' => 'number')
        );
    }

    /**
     * Create fields for displaying date
     *
     * @since 1.0.0
     */
    public function create_date_fields()
    {
        //The date format field
        add_settings_field(
            'display_date_format',
            'Date Format',
            array(&$this, 'display_text_field'),
            'rs-dr-t-date-section-page',
            'rs_dr_t_date_section_id',
            array('id' => 'display_date_format', 'name' => 'rs_dr_date_options', 'type' => 'text')
        );
    }

    /**
     * Create fields for displaying testimonial image
     *
     * @since   1.0.0
     */
    public function create_image_fields()
    {
        //Display testimonial image Field
        add_settings_field(
            'show_testimonial_image',
            'Display Image',
            array(&$this, 'display_check_box'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'show_testimonial_image', 'name' => 'rs_dr_image_options', 'type' => 'checkbox')
        );
        // testimonial image size field
        add_settings_field(
            'image_size',
            'Image Size',
            array(&$this, 'display_select_field'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'image_size', 'name' => 'rs_dr_image_options', 'values' => ['1' => 'Thumbnail 150 x 150 px', '2' => 'Medium 300 x 300 px'])
        );
        //Fallback Image Field
        add_settings_field(
            'fallback_image',
            'Fallback Image',
            array(&$this, 'display_radio_button'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'fallback_image', 'name' => 'rs_dr_image_options', 'values' => ['1' => 'Mystery Person', '2' => 'Smart Text Avatar', '3' => 'No Fallback Image'])
        );
        //Use gravater field
        add_settings_field(
            'use_gravaters',
            'Use Gravater',
            array(&$this, 'display_check_box'),
            'rs_dr_t_image_section_id',
            'rs_dr_t_image_section_id',
            array('id' => 'use_gravaters', 'name' => 'rs_dr_image_options', 'type' => 'checkbox')
        );
    }

    /**
     * Text-box display callback function
     *
     * @since 1.0.0
     */
    public function display_text_field(array $data = [])
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
        } else {
            print "Something wrong in the settings field!";
        }
    }

    /**
     * Checkbox display callback
     *
     * @since   1.0.0
     */
    public function display_checkbox_field(array $data = [])
    {
        extract($data);
        if (isset($name) && isset($id) && isset($type)) {
            //Value of the name attribute in the input field
            $name_attr = $name . '[' . $id . ']';
            // Fetch the options from the database
            $options = get_option($name);
            //Value of the checkbox field
            $value = intval(isset($options[$id]) ? $options[$id] : 0);
            //Whether checked or not
            $checked = checked($value, 1, false);
            $html = <<<INPUT
<input type="{$type}" name="{$name_attr}" value="1" size="40" {$checked}>
INPUT;
        } else {
            print "Something wrong in the checkbox field";
        }
    }

    /**
     * HTML Select display callback
     *
     * @since   1.0.0
     * @param array $data
     */
    public function display_select_field(array $data = [])
    {
        extract($data);
        if (isset($id) && isset($name) && isset($values)) {
            // Value of the name attribute in the select field
            $name_attr = $name . '[' . $id . ']';
            // Fetch the option from the database
            $options = get_option($name);
            //Value of the selected field
            $opt_value = $options[$id];
            // Loop through the values array, and generate option html element
            $html_opt = '';
            foreach ($values as $value => $label) {
                $selected = selected($opt_value, $value, false);
                $html_opt .= <<<OPTION
<option value="{$value}" {$selected}>{$label}</option>
OPTION;
            }
            // Construct HTML select
            $html_select = <<<EOL
<select name="{$name_attr}">{$html_opt}</select>
EOL;
            print $html_select;

        } else {
            print "Something wrong with the select field";
        }
    }

    /**
     * Display radio button callback
     *
     * @since   1.0.0
     * @param array $data
     */
    public function display_radio_button(array $data = []): void
    {
        extract($data);
        if (isset($id) && isset($name) && isset($values)) {
            // Value of the name attribute in the radio button field
            $name_attr = $name . '[' . $id . ']';
            // Fetch the options from the database
            $options = get_option($name);
            // The current value of the field
            $rdo_value = $options[$id];
            // Loop through the values array, generate html input element for radio button
            $html_rdo = '';
            foreach ($values as $value => $label) {
                $checked = checked($rdo_value, $value, false);
                $html_rdo .= <<<RADIO
<label>
    {$label}
    <input type="radio" name="{$name_attr}" value="{$value}" {$checked}>
</label>
RADIO;
                print $html_rdo;
            }
        } else {
            print 'Something is wrong with radio button';
        }
    }
}