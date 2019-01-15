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

        if (get_option('rs_dr_testimonial_options') === false) {

            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-settings.php';
            add_option('rs_dr_testimonial_options', Rs_Dr_Testimonial_Settings::$default_settings);
        }

        if (get_option('rs_dr_basic_options') === false) {

            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rs-dr-testimonial-basic-settings.php';
            add_option('rs_dr_basic_options', Rs_Dr_Testimonial_Basic_Settings::$default_basic_settings);
        }

	}

}
