<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://therssoftware.com/
 * @since      1.0.0
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        //Delete Basic Settings
        delete_option('rs_dr_basic_settings_options');
        delete_option('rs_dr_review_settings_options');
        delete_option('rs_dr_cache_options');
        //Delete Display Settings
        delete_option('rs_dr_excerpt_options');
        delete_option('rs_dr_date_options');
        delete_option('rs_dr_image_options');
        //Delete advanced settings
        delete_option('rs_dr_shortcode_options');
        // Delete  theme settings
        delete_option('rs_dr_theme_options');

    }

}
