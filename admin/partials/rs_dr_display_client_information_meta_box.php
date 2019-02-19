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
        <td><?= esc_html__('Client\'s Name:', 'rs-dr-testimonial') ?></td>
        <td><input type="text" name="rs_dr_testimonial_client_name" value="<?= $rs_dr_testimonial_client_name?>"></td>
    </tr>
    <tr>
        <td><?= esc_html__('Email Address:', 'rs-dr-testimonial') ?></td>
        <td><input type="text" name="rs_dr_testimonial_email" value="<?= $rs_dr_testimonial_email?>"></td>
    </tr>
    <tr>
        <td><?= esc_html__('Position/ Web Address/ Other:', 'rs-dr-testimonial') ?></td>
        <td><input type="text" name="rs_dr_testimonial_position" value="<?= $rs_dr_testimonial_position?>"></td>
    </tr>

    <tr>
        <td><?= esc_html__('Location Reviewed/ Product Reviewed/ Item Reviewed:', 'rs-dr-testimonial') ?></td>
        <td><input type="text" name="rs_dr_testimonial_location" value="<?= $rs_dr_testimonial_location?>"></td>
    </tr>
    <tr>
        <td>Rating:</td>
        <td>
            <?= esc_html__('1', 'rs-dr-testimonial') ?>
            <input type="radio" name="rs_dr_testimonial_rating" value="1" <?php checked( '1', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            <?= esc_html__('2', 'rs-dr-testimonial') ?>
            <input type="radio" name="rs_dr_testimonial_rating" value="2" <?php checked( '2', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            <?= esc_html__('3', 'rs-dr-testimonial') ?>
            <input type="radio" name="rs_dr_testimonial_rating" value="3" <?php checked( '3', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            <?= esc_html__('4', 'rs-dr-testimonial') ?>
            <input type="radio" name="rs_dr_testimonial_rating" value="4" <?php checked( '4', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
            <?= esc_html__('5', 'rs-dr-testimonial') ?>
            <input type="radio" name="rs_dr_testimonial_rating" value="5" <?php checked( '5', $rs_dr_testimonial_rating ); ?>>&nbsp;&nbsp;
        </td>
    </tr>
</table>


