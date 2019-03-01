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
        'display_excerpt_char' => 20,
        'display_excerpt_text' => 'Details'
    ];
    /**
     * @since   1.0.0
     * @access  Public Static
     * @var array $default_date_settings Default values for the date settings
     */
    public static $default_date_settings = [
        'display_date_format' => 'F j, y'
    ];
    /**
     * @since   1.0.0
     * @access  Public Static
     * @var array $default_image_settings Default values for the image settings
     */
    public static $default_image_settings = [
        'show_testimonial_image' => 1,
        'image_size' => 1, //There are two image sizes; 1:150x150 px, 2: 300x300 px
        'fallback_image' => 1, //There are three types of fallback images, 1:Mystery Person; 2:Smart Text Avatar, 3:No Fallback Image
        'use_gravaters' => 1 //Use Gravatar if one is found with a matching email address
    ];
    /**
     * @since   1.0.0
     * @access  Public Static
     * @var array $default_width_settings Default values for the width settings
     */
    public static $default_width_settings = [
        'testimonial_width' => ''
    ];
    /**
     * @since   1.0.0
     * @access  Public Static
     * @var array $default_link_settings Default values for the link settings
     */
    public static $default_link_settings = [
        'link_address' => '',
        'link_text' => 'View More Testimonial',
        'show_the_link' => 'on'
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
        register_setting(
            'rs_dr_t_width_group',
            'rs_dr_width_options',
            array(&$this, 'width_validator')
        );
        register_setting(
            'rs_dr_t_link_group',
            'rs_dr_link_options',
            array(&$this, 'link_validator')
        );
        register_setting(
            'rs_dr_t_single_group',
            'rs_dr_single_options',
            array(&$this, 'single_validator')
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
     * Validator callback function for width
     *
     * @since   1.0.0
     */
    public function width_validator($input)
    {
        return $input;
    }

    /**
     * Validator callback function for a link for viewing more testimonials
     *
     * @since   1.0.0
     */
    public function link_validator($input)
    {
        return $input;
    }

    /**
     * Validator callback function for a link for viewing more testimonials
     *
     * @since   1.0.0
     */
    public function single_validator($input)
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
            __('Excerpt Section', 'rs-dr-testimonial'),
            array(&$this, 'excerpt_section_description_callback'),
            'rs-dr-t-excerpt-section-page'
        );
        //Date Section
        add_settings_section(
            'rs_dr_t_date_section_id',
            __('Date Section', 'rs-dr-testimonial'),
            array(&$this, 'date_section_description_callback'),
            'rs-dr-t-date-section-page'
        );
        //Image Section
        add_settings_section(
            'rs_dr_t_image_section_id',
            __('Image Section', 'rs-dr-testimonial'),
            array(&$this, 'image_section_description_callback'),
            'rs-dr-t-image-section-page'
        );
        //Width Section
        add_settings_section(
            'rs_dr_t_width_section_id',
            __('Width Section', 'rs-dr-testimonial'),
            array(&$this, 'width_section_description_callback'),
            'rs-dr-t-width-section-page'
        );
        //Link Section
        add_settings_section(
            'rs_dr_t_link_section_id',
            __('View More Link Section', 'rs-dr-testimonial'),
            array(&$this, 'link_section_description_callback'),
            'rs-dr-t-link-section-page'
        );
        //single Section
        add_settings_section(
            'rs_dr_t_single_section_id',
            __('Single Testimonial View Options', 'rs-dr-testimonial'),
            array(&$this, 'single_section_description_callback'),
            'rs-dr-t-single-section-page'
        );
    }

    /**
     * Excerpt section callback
     *
     * @since   1.0.0
     */
    public function excerpt_section_description_callback()
    {
        _e("Takes Value for the excerpt length", 'rs-dr-testimonial');
    }

    /**
     * Date section callback
     *
     * @since   1.0.0
     */
    public function date_section_description_callback()
    {
        _e('Takes format specifier for displaying date', 'rs-');
    }

    /**
     * Image section callback
     *
     * @since   1.0.0
     */
    public function image_section_description_callback()
    {
        _e('Activate or deactivate different options for testimonial image', 'rs-dr-testimonial');
    }

    /**
     * Width section callback
     *
     * @since   1.0.0
     */
    public function width_section_description_callback()
    {
        _e('Default Testimonial Width', 'rs-dr-testimonial');
    }

    /**
     * Link section callback
     *
     * @since   1.0.0
     */
    public function link_section_description_callback()
    {
        _e('Link to a page for viewing more testimonials', 'rs-dr-testimonial');
    }

    /**
     * Single section callback
     *
     * @since   1.0.0
     */
    public function single_section_description_callback()
    {
        _e('Options for viewing single testimonial', 'rs-dr-testimonial');
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
            __('Excerpt Length', 'rs-dr-testimonial'),
            array(&$this, 'display_text_field'),
            'rs-dr-t-excerpt-section-page',
            'rs_dr_t_excerpt_section_id',
            array('id' => 'display_excerpt_char', 'name' => 'rs_dr_excerpt_options', 'type' => 'number')
        );
        //The excerpt text field
        add_settings_field(
            'display_excerpt_text',
            __('Excerpt Text', 'rs-dr-testimonial'),
            array(&$this, 'display_text_field'),
            'rs-dr-t-excerpt-section-page',
            'rs_dr_t_excerpt_section_id',
            array('id' => 'display_excerpt_text', 'name' => 'rs_dr_excerpt_options', 'type' => 'text')
        );
        // Link to Details
        add_settings_field(
            'link_to_detail',
            __('Excerpt Text', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-excerpt-section-page',
            'rs_dr_t_excerpt_section_id',
            array('id' => 'link_to_detail', 'name' => 'rs_dr_excerpt_options', 'type' => 'checkbox')
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
            __('Date Format', 'rs-dr-testimonial'),
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
            __('Display Image', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'show_testimonial_image', 'name' => 'rs_dr_image_options', 'type' => 'checkbox')
        );
        // testimonial image size field
        add_settings_field(
            'image_size',
            __('Image Size', 'rs-dr-testimonial'),
            array(&$this, 'display_select_field'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'image_size', 'name' => 'rs_dr_image_options', 'values' => ['1' => 'Thumbnail 150 x 150 px', '2' => 'Medium 300 x 300 px'])
        );
        //Fallback Image Field
        add_settings_field(
            'fallback_image',
            __('Fallback Image', 'rs-dr-testimonial'),
            array(&$this, 'display_radio_button'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'fallback_image', 'name' => 'rs_dr_image_options', 'values' => ['1' => 'Mystery Person', '2' => 'No Fallback Image'])
        );
        //Use gravater field
        add_settings_field(
            'use_gravaters',
            __('Use Gravater', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-image-section-page',
            'rs_dr_t_image_section_id',
            array('id' => 'use_gravaters', 'name' => 'rs_dr_image_options', 'type' => 'checkbox')
        );
    }

    /**
     * Create fields for displaying width
     *
     * @since 1.0.0
     */
    public function create_width_fields()
    {
        //The width settings
        add_settings_field(
            'testimonial_width',
            __('Default Testimonial Width', 'rs-dr-testimonial'),
            array(&$this, 'display_text_field'),
            'rs-dr-t-width-section-page',
            'rs_dr_t_width_section_id',
            array('id' => 'testimonial_width', 'name' => 'rs_dr_width_options', 'type' => 'text')
        );
    }

    /**
     * Create fields for displaying link
     *
     * @since 1.0.0
     */
    public function create_link_fields()
    {
        //The link address
        add_settings_field(
            'link_address',
            __('Link Address', 'rs-dr-testimonial'),
            array(&$this, 'display_text_field'),
            'rs-dr-t-link-section-page',
            'rs_dr_t_link_section_id',
            array('id' => 'link_address', 'name' => 'rs_dr_link_options', 'type' => 'text')
        );
        // The link text
        add_settings_field(
            'link_text',
            __('Link Text', 'rs-dr-testimonial'),
            array(&$this, 'display_text_field'),
            'rs-dr-t-link-section-page',
            'rs_dr_t_link_section_id',
            array('id' => 'link_text', 'name' => 'rs_dr_link_options', 'type' => 'text')
        );

        //View more testimonial link checkbox
        add_settings_field(
            'show_the_link',
            __('Show View More Testimonial Link', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-link-section-page',
            'rs_dr_t_link_section_id',
            array('id' => 'show_the_link', 'name' => 'rs_dr_link_options', 'type' => 'checkbox')
        );

    }

    /**
     * Create fields for controlling the single testimonial view
     *
     * @since 1.0.0
     */
    public function create_single_fields()
    {
        //The Theme field
        add_settings_field(
            'single_theme',
            __('Theme', 'rs-dr-testimonial'),
            array(&$this, 'display_select_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_theme', 'name' => 'rs_dr_single_options', 'values' => ['1' => 'Default', '2' => 'Dark', '3' => 'Light', '4' => 'None'])
        );

        //Show testimonial title
        add_settings_field(
            'single_show_title',
            __('Show Testimonial Title', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_show_title', 'name' => 'rs_dr_single_options', 'type' => 'checkbox')
        );
        //Show testimonial Image
        add_settings_field(
            'single_show_image',
            __('Show Testimonial Image', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_show_image', 'name' => 'rs_dr_single_options', 'type' => 'checkbox')
        );
        //Show testimonial date
        add_settings_field(
            'single_show_date',
            __('Show Testimonial Date', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_show_date', 'name' => 'rs_dr_single_options', 'type' => 'checkbox')
        );
        //Show testimonial Location
        add_settings_field(
            'single_show_location',
            __('Show Testimonial Location', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_show_location', 'name' => 'rs_dr_single_options', 'type' => 'checkbox')
        );
        //Show more testimonial link
        add_settings_field(
            'single_show_link',
            __('Show More Testimonial Link', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_show_link', 'name' => 'rs_dr_single_options', 'type' => 'checkbox')
        );
        //Use Schema.org compliant markup
        add_settings_field(
            'single_printing_json_ld',
            __('Use Schema.org compliant markup', 'rs-dr-testimonial'),
            array(&$this, 'display_checkbox_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_printing_json_ld', 'name' => 'rs_dr_single_options', 'type' => 'checkbox')
        );

        add_settings_field(
            'single_show_rating',
            __('Show Rating', 'rs-dr-testimonial'),
            array(&$this, 'display_select_field'),
            'rs-dr-t-single-section-page',
            'rs_dr_t_single_section_id',
            array('id' => 'single_show_rating', 'name' => 'rs_dr_single_options', 'values' => ['1' => 'Before Testimonial', '2' => 'After Testimonial', '3' => 'Don\'t show Rating'])
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
            _e("Something wrong in the settings field!", 'rs-dr-testimonial');
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
            print $html;
        } else {
            _e("Something wrong in the checkbox field", 'rs-dr-testimonial');
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
            $opt_value = isset($options[$id]) ? $options[$id] : null;
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
            _e("Something wrong with the select field", 'rs-dr-testimonial');
        }
    }

    /**
     * Display radio button callback
     *
     * @since   1.0.0
     * @param array $data
     */
    public function display_radio_button(array $data = [])
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
    {$label}&nbsp;
    <input type="radio" name="{$name_attr}" value="{$value}" {$checked}>
</label><br><br>
RADIO;
            }
            print $html_rdo;
        } else {
            _e('Something is wrong with radio button', 'rs-dr-testimonial');
        }
    }
}