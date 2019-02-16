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
 * The file for managing post list.
 *
 * Defines the plugin name, version, post-type and other functions to be called for adding and/or removing columns
 * from the post-manage screen
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */

namespace admin\mics;


class Rs_Dr_Testimonial_Post_Management_Columns extends \Rs_Dr_Testimonial_Meta_Box
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
     * Post-type to be worked with
     *
     * @since   1.0.0
     * @access  public
     * @var string $post_type Post type to work with
     */
    public $post_type;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     * @param   string $post_type Post-type to work with
     */
    public function __construct($plugin_name, $version, $post_type)
    {

        $this->post_type = $post_type;

        parent::__construct($plugin_name, $version);
    }

    /**
     * Adds the following columns to the default column array:
     * 1)Rating
     * 2)Title or Position
     * 3)Location or Product Review
     * 4)Shortcode
     * 5)Date
     *
     * @since   1.0.0
     * @param   array $columns The current columns of the post manage screen
     * @return  array   $columns    Returns the following columns checkbox, Title, Shortcode, Date
     */
    public function add_columns(array $columns): array
    {

        unset($columns['date']);

        $columns['author_name'] = 'Author';
        $columns['shortcode'] = 'Shortcode';
        $columns['date'] = 'Date';
        return $columns;
    }

    /**
     * Construct shortcode for each single testimonial
     *
     * @since   1.0.0
     * @access  private
     * @param integer $post_id The id of the current post
     * @return  string  The shortcode for the current post-id
     */
    private function shortcode_gen(int $post_id): string
    {
        if ($tag = get_option('rs_dr_shortcode_options')['rs_dr_t_shortcode']) {
            $tag = "[{$tag} type='single' id='{$post_id}']";
            return $tag;
        }
        return "Please Set a shortcode tag";
    }

    /**
     * Function for populating columns
     *
     * @since   1.0.0
     * @access  public
     * @param   string $columns A key in the column array
     * @param   int $post_id The current post_id
     */
    public function populate_column(string $columns, int $post_id)
    {
        // Different behaviour for different column name
        switch ($columns) {
            // For Shortcode Column
            case 'shortcode':
                {
                    $shortcode = $this->shortcode_gen($post_id);
                    $shortcode = <<<EOL
<input type="text" value="{$shortcode}" size="23">
EOL;

                    print($shortcode);
                    break;
                }
            // For author name
            case 'author_name':
                {
                    the_author();
                    break;
                }
        }
    }
    /**
     * Makes columns sortable
     *
     * @since   1.0.0
     * @access  public
     * @param   array $columns An array of column heading
     * @return  array   An array of column heading
     */
    public function sortable_columns(array $columns)
    {
        $columns['title_edited'] = 'Title';

        return $columns;
    }
}