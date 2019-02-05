<?php

/**
 * Fired during plugin activation
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        // Basic Setting Options
        if (get_option('rs_dr_basic_settings_options') === false) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-basic-settings.php';
            add_option('rs_dr_basic_settings_options', Rs_Dr_Testimonial_Basic_Settings::$default_basic_settings);
        }
        if (get_option('rs_dr_review_settings_options') === false) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-basic-settings.php';
            add_option('rs_dr_review_settings_options', Rs_Dr_Testimonial_Basic_Settings::$default_review_settings);
        }
        if (get_option('rs_dr_cache_options') === false) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-basic-settings.php';
            add_option('rs_dr_cache_options', Rs_Dr_Testimonial_Basic_Settings::$default_cache_settings);
        }
        //Display Settings Options
        if (get_option('rs_dr_excerpt_options') === false) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-display-settings.php';
            add_option('rs_dr_excerpt_options', Rs_Dr_Testimonial_Display_Settings::$default_excerpt_settings);
        }
        if (false === get_option('rs_dr_date_options')) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-display-settings.php';
            add_option('rs_dr_date_options', Rs_Dr_Testimonial_Display_Settings::$default_date_settings);
        }
        if (false === get_option('rs_dr_image_options')) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-display-settings.php';
            add_option('rs_dr_image_options', Rs_Dr_Testimonial_Display_Settings::$default_image_settings);
        }
        if (false === get_option('rs_dr_shortcode_options')) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-advanced-settings.php';
            add_option('rs_dr_shortcode_options', Rs_Dr_Testimonial_Advanced_Settings::$default_shortcode_setting);
        }
    }

}
