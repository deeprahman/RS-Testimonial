<?php
//Retrieve the client information

$rs_dr_testimonial_client_name = esc_html(get_post_meta($post->ID, 'rs_dr_testimonial_client_name', true));
$rs_dr_testimonial_email = esc_html(get_post_meta($post->ID, 'rs_dr_testimonial_email', true));
$rs_dr_testimonial_position = esc_html(get_post_meta($post->ID, 'rs_dr_testimonial_position', true));
$rs_dr_testimonial_location = esc_html(get_post_meta($post->ID, 'rs_dr_testimonial_location', true));
$rs_dr_testimonial_rating = intval(get_post_meta($post->ID, 'rs_dr_testimonial_rating', true));

?>
    <?php wp_nonce_field( 'rs_dr_testimonial_client_info_action', 'rs_dr_testimonial_client_info_nonce' );?>
<table>
    <tr>
        <td>Client's Name:</td>
        <td><input type="text" name="rs_dr_testimonial_client_name" value="<?= $rs_dr_testimonial_client_name?>"></td>
    </tr>
    <tr>
        <td>Email Address:</td>
        <td><input type="text" name="rs_dr_testimonial_email" value="<?= $rs_dr_testimonial_email?>"></td>
    </tr>
    <tr>
        <td>Position/ Web Address/ Other:</td>
        <td><input type="text" name="rs_dr_testimonial_position" value="<?= $rs_dr_testimonial_position?>"></td>
    </tr>

    <tr>
        <td>Location Reviewed/ Product Reviewed/ Item Reviewed:</td>
        <td><input type="text" name="rs_dr_testimonial_location" value="<?= $rs_dr_testimonial_location?>"></td>
    </tr>
    <tr>
        <td>Rating:</td>
        <td>
            1
            <input type="radio" name="rs_dr_testimonial_rating" value="1" <?php checked( '1', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            2
            <input type="radio" name="rs_dr_testimonial_rating" value="2" <?php checked( '2', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            3
            <input type="radio" name="rs_dr_testimonial_rating" value="3" <?php checked( '3', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            4
            <input type="radio" name="rs_dr_testimonial_rating" value="4" <?php checked( '4', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            5
            <input type="radio" name="rs_dr_testimonial_rating" value="5" <?php checked( '5', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
        </td>
    </tr>
</table>

<?php
