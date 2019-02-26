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
 * Deals With plugin's basic settings
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Basic_Settings extends Rs_Dr_Testimonial_Settings
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
     * @var array $default_basic_settings Default values of basic settings
     */
    public static $default_basic_settings = [
        'show_in_search' => '1',
        'allow_html_tags' => '1',
        'css_all_screens' => '',
        'css_768_screens' => '',
        'css_320_screens' => ''
    ];

    public static $default_review_settings = [
        'output_review_markup' => '1',
        'global_item_reviewed' => '',
        'use_global_item_reviewed' => '1',
    ];

    public static $default_cache_settings = [
        'cache_time' => 900,
        'use_caching' => '1'
    ];

    /**
     * Register a settings menu
     *
     * @since 1.0.0
     */
    public function register_basic_settings()
    {
//        Basic Settings
        register_setting(
            'rs_dr_testimonial_basic_settings',
            'rs_dr_basic_settings_options',
            [$this, 'rs_dr_testimonial_validate_basic_option']
        );
//        Review Settings
        register_setting(
            'rs_dr_testimonial_reviewed_settings',
            'rs_dr_review_settings_options',
            [$this, 'rs_dr_testimonial_validate_reviewed_option']
        );
//        Cache Settings
        register_setting(
            'rs_dr_testimonial_cache_settings',
            'rs_dr_cache_options',
            [$this, 'rs_dr_testimonial_validate_cache_option']
        );
    }

    /**
     * Register Settings Section
     *
     * @since 1.0.0
     */
    public function register_basic_sections()
    {
//        Basic Settings
        add_settings_section(
            'rs_dr_testimonial_basic_options_section',
            __('Basic Options', 'rs-dr-testimonial'),
            array($this, 'rs_dr_testimonial_basic_options_section_callback'),
            'rs-dr-testimonial-basic-option-page'
        );
//        Reviewed Settings
        add_settings_section(
            'rs_dr_testimonial_item_reviewed_options_section',
            __('Item Reviewed Options', 'rs-dr-testimonial'),
            array($this, 'rs_dr_testimonial_item_reviewed_options_section_callback'),
            'rs-dr-testimonial-reviewed-option-page'
        );
//        Cache Settings
        add_settings_section(
            'rs_dr_testimonial_cache_options_section',
            __('Cache Options', 'rs-dr-testimonial'),
            array($this, 'rs_dr_testimonial_cache_options_section_callback'),
            'rs-dr-testimonial-cache-option-page'
        );
    }

    /**
     * Register basic option Field
     *
     * @since 1.0.0
     */
    public function register_basic_options_fields()
    {

        add_settings_field(
            'show_in_search',
            __('Show in Search', 'rs-dr-testimonial'),
            array($this, 'display_checkbox_field'),
            'rs-dr-testimonial-basic-option-page',
            'rs_dr_testimonial_basic_options_section',
            array('id' => 'show_in_search', 'name' => 'rs_dr_basic_settings_options', 'type' => 'checkbox')
        );

        add_settings_field(
            'allow_html_tags',
            __('Allow Html Tags in Testimonial', 'rs-dr-testimonial'),
            array($this, 'display_checkbox_field'),
            'rs-dr-testimonial-basic-option-page',
            'rs_dr_testimonial_basic_options_section',
            array('id' => 'allow_html_tags', 'name' => 'rs_dr_basic_settings_options', 'type' => 'checkbox')
        );

        add_settings_field(
            'css_all_screens',
            __('Custom CSS (All Screens)', 'rs-dr-testimonial'),
            array($this, 'display_textarea_field'),
            'rs-dr-testimonial-basic-option-page',
            'rs_dr_testimonial_basic_options_section',
            array('id' => 'css_all_screens', 'name' => 'rs_dr_basic_settings_options', 'type' => 'textarea')
        );

        add_settings_field(
            'css_768_screens',
            __('Custom CSS (768px and Low)', 'rs-dr-testimonial'),
            array($this, 'display_textarea_field'),
            'rs-dr-testimonial-basic-option-page',
            'rs_dr_testimonial_basic_options_section',
            array('id' => 'css_768_screens', 'name' => 'rs_dr_basic_settings_options', 'type' => 'textarea')
        );

        add_settings_field(
            'css_320_screens',
            __('Custom CSS (320px and Low)', 'rs-dr-testimonial'),
            array($this, 'display_textarea_field'),
            'rs-dr-testimonial-basic-option-page',
            'rs_dr_testimonial_basic_options_section',
            array('id' => 'css_320_screens', 'name' => 'rs_dr_basic_settings_options', 'type' => 'textarea')
        );
    }

    /**
     * Register Item Received Options Fields
     *
     * @since 1.0.0
     */
    public function register_item_reviewed_options_fields()
    {
        add_settings_field(
            'output_review_markup',
            __('Output Review Markup', 'rs-dr-testimonial'),
            array($this, 'display_checkbox_field'),
            'rs-dr-testimonial-reviewed-option-page',
            'rs_dr_testimonial_item_reviewed_options_section',
            array('id' => 'output_review_markup', 'name' => 'rs_dr_review_settings_options', 'type' => 'checkbox')
        );

        add_settings_field(
            'global_item_reviewed',
            __('Global Item Reviewed', 'rs-dr-testimonial'),
            array($this, 'display_text_field'),
            'rs-dr-testimonial-reviewed-option-page',
            'rs_dr_testimonial_item_reviewed_options_section',
            array('id' => 'global_item_reviewed', 'name' => 'rs_dr_review_settings_options', 'type' => 'text')
        );

        add_settings_field(
            'use_global_item_reviewed',
            __('Use Global Item Reviewed', 'rs-dr-testimonial'),
            array($this, 'display_checkbox_field'),
            'rs-dr-testimonial-reviewed-option-page',
            'rs_dr_testimonial_item_reviewed_options_section',
            array('id' => 'use_global_item_reviewed', 'name' => 'rs_dr_review_settings_options', 'type' => 'checkbox')
        );
    }

    /**
     * Register Cache Options Fields
     *
     * @since 1.0.0
     */
    public function register_cache_options_fields()
    {
        add_settings_field(
            'cache_time',
            __('Cache Time', 'rs-dr-testimonial'),
            array($this, 'display_text_field'),
            'rs-dr-testimonial-cache-option-page',
            'rs_dr_testimonial_cache_options_section',
            array('id' => 'cache_time', 'name' => 'rs_dr_cache_options', 'type' => 'number')
        );

        add_settings_field(
            'use_caching',
            __('Use Caching', 'rs-dr-testimonial'),
            array($this, 'display_checkbox_field'),
            'rs-dr-testimonial-cache-option-page',
            'rs_dr_testimonial_cache_options_section',
            array('id' => 'use_caching', 'name' => 'rs_dr_cache_options', 'type' => 'checkbox')
        );

        add_settings_field(
            'flush_caching',
            __('Flush Caching', 'rs-dr-testimonial'),
            array($this, 'display_button'),
            'rs-dr-testimonial-cache-option-page',
            'rs_dr_testimonial_cache_options_section',
            array('id' => 'flush_caching', 'name' => 'rs_dr_flush_cache', 'value' => 'flush_cache_ok', 'page' => 'rs-dr-testimonial-basic-settings-page', 'tab' => 'cache-tab')
        );
    }

    /**
     * Validate and sanitize input for basic options
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_validate_basic_option(array $input): array
    {
        return $input;
    }

    /**
     * Validate and sanitize input for review options
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_validate_reviewed_option(array $input): array
    {
        return $input;
    }

    /**
     * Validate and sanitize input for cache options
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_validate_cache_option(array $input): array
    {


        return $input;
    }

    /**
     * Basic Option Settings Section Callback
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_basic_options_section_callback()
    {
        _e("Basic Options Section", 'rs-dr-testimonial');
    }

    /**
     * Item Reviewed Options Section Callback
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_item_reviewed_options_section_callback()
    {
        _e("Item Reviewed Options Section", 'rs-dr-testimonial');
    }

    /**
     * Cache Options Section Callback
     *
     * @since 1.0.0
     */
    public function rs_dr_testimonial_cache_options_section_callback()
    {
        _e("Cache Options Section", 'rs-dr-testimonial');
    }

    /**
     * Text Field callback function
     *
     * @since 1.0.0
     */
    public function display_text_field($data = [])
    {
        extract($data);
        if (isset($name) && isset($id) && isset($type)) {

//        Value of the name attribute of the input field
            $name_attr = $name . '[' . $id . ']';
//        Get the options from the database
            $option = get_option($name, Rs_Dr_Testimonial_Basic_Settings::$default_basic_settings);
//            The Value of the text field
            $value = esc_html($option[$id]);

            $html = <<<EOL
<input type="{$type}" name="{$name_attr}" value="{$value}" size="40">
EOL;
            echo $html;
        } else {
            echo __("Something wrong in the text field", 'rs-dr-testimonial');
        }


    }

    /**
     * Checkbox Field Callback Function
     *
     * @since 1.0.0
     */
    public function display_checkbox_field($data = [])
    {
        extract($data);
        if (isset($name) && isset($id) && isset($type)) {

//        Value of the name attribute of the input field
            $name_attr = $name . '[' . $id . ']';
//        Get the options from the database
            $option = get_option($name);
//            The Value of the text field
            $value = esc_html(isset($option[$id]) ? $option[$id] : 0);
//            Whether checked or not
            $checked = checked($value, 1, false);
            $html = <<<EOL
<input type="{$type}" name="{$name_attr}" value="1" size="40" {$checked}>
EOL;
            echo $html;
        } else {
            echo __("Something wrong in the checkbox field", 'rs-dr-testimonial');
        }
    }

    /**
     * Textarea field callback function
     *
     * @param array $data
     */
    public function display_textarea_field($data = [])
    {
        extract($data);
        if (isset($name) && isset($id) && isset($type)) {
//        Value of the name attribute of the input field
            $name_attr = $name . '[' . $id . ']';
//        Get the options from the database
            $option = get_option($name);
//            The Value of the text field
            $value = esc_html($option[$id]);
            $html = <<<EOL
<textarea id="{$id}" name="{$name_attr}" rows="7" cols="50">{$value}</textarea>
EOL;
            echo $html;
        } else {
            echo __("Something wrong in the textarea", 'rs-dr-testimonial');
        }
    }

    /**
     * HTML Link callback function
     *
     * @param array $data
     */
    public function display_button(array $data = [])
    {
        // Brake up the array; make each key a variable identifier and corresponding value -the variable value
        extract($data);
        if (isset($name) && isset($page) && isset($id) && isset($tab)) {
            if (isset($_GET[$name])) {
                // Call a method for deleting cache
                $this->delete_all_transients();
            }
            $link_to = add_query_arg(['page' => $page, 'tab' => $tab, $name => $id], admin_url('admin.php'));
            $html = <<<EOL
<a href="{$link_to}" class="button-primary">Flush Cache</a>
EOL;
            echo $html;
        }
    }

    /**
     * Deletes all saved transients
     *
     * @since 1.0.0
     */
    private function delete_all_transients()
    {
        global $wpdb;
        $sql_delete = 'DELETE FROM wp_options WHERE option_name LIKE "%rs_dr_cache_store%"';
        $wpdb->query($sql_delete);
    }
}