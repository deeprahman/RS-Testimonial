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
 * The Sanitation class.
 *
 * This is used to define methods used for various sanitation purpose.
 *
 * @since      1.0.0
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/includes
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */


namespace includes;


class Rs_Dr_Testimonial_Sanitation
{
    public function validate_text_field(string $text)
    {
        $text = sanitize_text_field($text);
        if ($text != '') {
            return $text;
        }
        return false;
    }

    public function valisate_textarea(string $textarea)
    {
        $testarea = sanitize_textarea_field($textarea);
        if ($testarea != '') {
            return $testarea;

        }
        return false;
    }
}