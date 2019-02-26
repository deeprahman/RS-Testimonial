<?php
//Retrieve the client information
$stored_shortcode = get_option('rs_dr_shortcode_options');
$stored_shortcode = isset($stored_shortcode['rs_dr_t_shortcode']) ? $stored_shortcode['rs_dr_t_shortcode'] : 'Something went Wrong!';
$shortcode_format = "[$stored_shortcode type='single' id='$post->ID']";


?>
<?php wp_nonce_field('rs_dr_testimonial_show_shortcode_action', 'rs_dr_testimonial_show_shortcode_nonce'); ?>
<table>
    <tr>
        <td><?= esc_html__('Shortcode:', 'rs-dr-testimonial') ?></td>
        <td><input type="text" name="rs_dr_testimonial_client_name" value="<?= $shortcode_format ?>" size="15"></td>
    </tr>
</table>