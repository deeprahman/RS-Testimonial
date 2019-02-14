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
    public $validation_error = array();

    /**
     * Validate the text field
     *
     * @param string $text
     * @return bool|string
     */
    public function validate_text_field(string $text)
    {
        $text = sanitize_text_field($text);
        if ($text != '') {
            return $text;
        }
        $this->error_msg('text', 'Some text fields are not properly filled');
        return false;
    }

    /**
     * validate textarea
     *
     * @param string $textarea
     * @return bool|string
     */
    public function validate_textarea(string $textarea)
    {
        $textarea = sanitize_textarea_field($textarea);
        if ($textarea != '') {
            return $textarea;
        }
        $this->error_msg('textarea', 'Textarea is not properly filled');
        return false;
    }

    /**
     * Validate the email
     *
     * @param string $email
     * @return bool|string
     */
    public function validate_email(string $email)
    {
        $email = sanitize_email($email);
        $email_val = is_email($email);
        if ($email_val !== false) {
            return $email;
        }
        $this->error_msg('email', 'Email address is not properly entered');
        return $email_val;
    }

    /**
     * Validate the input of the radio button
     *
     * @param int $min
     * @param int $max
     * @param string $value
     * @return bool|int|string
     */
    public function validate_radio(int $min, int $max, string $value)
    {
        $value = intval($value);
        if (($value <= $min) && ($value >= $max)) {
            $this->error_msg('radio', 'Rating value is not properly entered');
            return false;
        }

        return $value;
    }

    public function validate_url(string $url)
    {
        $url = esc_url_raw($url);
        if ($url != '') {
            return $url;
        }
        $this->error_msg('url', 'Url is not properly entered');
        return false;
    }

    /**
     * @param array $file The information about uploaded array
     * @param int $size The maximum size of the file
     * @return boolean
     */
    public function validate_file(array $file, int $size): bool
    {
        $out = false;
        $this->error_msg('file_size', "Maximum Filesize should not be more than $size byte");
        //check the file size
        $file_size = filesize($file['tmp_name']);
        $type = mime_content_type($file['tmp_name']);
        $allowed = ["image/jpeg", "image/png"];
        //Check the size of the file
        if ($file_size >= $size) {
            $this->error_msg('file_size', "Maximum Filesize should not be more than $size byte");
            $out = false;
        }
        if (!in_array($type, $allowed)) {
            $this->error_msg('mime_type', "MIME type does not match");
            $out = false;
        } else {
            $out = true;
        }
        return $out;

    }

    /**
     * @param string $key
     * @param string $value
     * @return array
     */
    public function error_msg(string $key, string $value): array
    {
        $this->validation_error[$key] = $value;
    }
}