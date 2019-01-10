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
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs_Dr_Testimonial
 * @subpackage Rs_Dr_Testimonial/admin
 * @author     Deep Rahman <dp.rahman@gmail.com>
 */
class Rs_Dr_Testimonial_Meta_Box
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
     * @var array $args The arguments for registering custom post type: rs_dr_testimonial
     */
	private $args = [
        'labels' => [
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new' => 'Add New Testimonial',
            'add_new_item' => 'Add New Testimonial',
            'edit' => 'Edit',
            'edit_item' => 'Edit Testimonial',
            'new_item' => 'New Testimonial',
            'view' => 'View',
            'view_item' => 'View Testimonial',
            'search_items' => 'Search Testimonial',
            'not_found' => 'No Testimonial Found',
            'not_found_in_trash' => 'No Testimonials Found in Trash',
            'parent' => 'Parent Testimonial'
        ],
        'public' => true,
        'menu_position' => 20,
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt'

        ],
        'taxonomies' => [],
        'menu_icon' => 'dashicons-format-quote',
        'has_archive' => true
    ];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rs_Dr_Testimonial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rs_Dr_Testimonial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rs-dr-testimonial-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rs_Dr_Testimonial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rs_Dr_Testimonial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rs-dr-testimonial-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Creates the custom post type: Testimonial
     *
     *
     */
	public function rs_dr_create_testimonial_post_type(){

//        Register the custom post type
        register_post_type('rs_dr_testimonial', $this->args);
    }

    /**
     * Called when administration section is visited
     */
    public function rs_dr_admin_init(){

        //Add Client Information Meta Box
        add_meta_box(
            'rs_dr_client_information_meta_box',
            'Client Information Details',
            array($this, 'rs_dr_display_client_information_meta_box'),
            'rs_dr_testimonial',
            'advanced',
            'high'
        );
    }

    public function rs_dr_display_client_information_meta_box($post){

        require_once plugin_dir_path( __FILE__ ) . 'partials/rs_dr_display_client_information_meta_box.php';

    }

    /**
     * Save the Client Information
     *
     * @param $post_id
     */
    public function rs_dr_save_client_info($post_id){

        if ( isset( $_POST['rs_dr_testimonial_client_info_nonce'] ) && isset( $_POST['post_type'] ) ){

            // Don't save if the user hasn't submitted the changes
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
                return;
            }

            // Verify that the input is coming from the proper form
            if ( ! wp_verify_nonce( $_POST['rs_dr_testimonial_client_info_nonce'], 'rs_dr_testimonial_client_info_action' ) ) {
                return;
            } // end if

            // Make sure the user has permissions to post
            if ( 'rs_dr_testimonial' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                } // end if
            } // end if/else

            // Read the Client's Name
            $rs_dr_testimonial_client_name= isset( $_POST['rs_dr_testimonial_client_name'] ) ? $_POST['rs_dr_testimonial_client_name'] : '';
//            Read Client's email
            $rs_dr_testimonial_email= isset( $_POST['rs_dr_testimonial_email'] ) ? $_POST['rs_dr_testimonial_email'] : '';
//            Read Client's position
            $rs_dr_testimonial_position= isset( $_POST['rs_dr_testimonial_position'] ) ? $_POST['rs_dr_testimonial_position'] : '';
            //Read Client's location
            $rs_dr_testimonial_location= isset( $_POST['rs_dr_testimonial_location'] ) ? $_POST['rs_dr_testimonial_location'] : '';
            //Read Rating
            $rs_dr_testimonial_rating= isset( $_POST['rs_dr_testimonial_rating'] ) ? $_POST['rs_dr_testimonial_rating'] : '';

            // Update the Client Name.
            update_post_meta( $post_id, 'rs_dr_testimonial_client_name', $rs_dr_testimonial_client_name );
            // Update the Client Email.
            update_post_meta( $post_id, 'rs_dr_testimonial_email', $rs_dr_testimonial_email );
            // Update the Client Position.
            update_post_meta( $post_id, 'rs_dr_testimonial_position', $rs_dr_testimonial_position );
            // Update the Client Location.
            update_post_meta( $post_id, 'rs_dr_testimonial_location', $rs_dr_testimonial_location );
            // Update the Rating.
            update_post_meta( $post_id, 'rs_dr_testimonial_rating', $rs_dr_testimonial_rating );
        }
    }



}
