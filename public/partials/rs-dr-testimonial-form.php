<style>
    .rs-dr-rating {
        margin-left: 10px;
    }
</style>
<form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="action" value="contact_form">
    <?php wp_nonce_field('rs_dr_t_from', 'form_nonce') ?>
    <div>
        <label for="rs-dr-name"><?php esc_html_e('Your Full Name', 'rs-dr-testimonial') ?></label><br>
        <input type="text" id="rs-dr-name" name="client_name">
    </div>
    <div>
        <label for="rs-dr-email"><?php esc_html_e('Your Email Address', 'rs-dr-testimonial') ?></label><br><br>
        <input type="text" id="rs-dr-email" name="client_email">
    </div>
    <div>
        <label for="rs-dr-review"><?php esc_html_e('Product Review', 'rs-dr-testimonial') ?></label><br>
        <input type="text" id="rs-dr-review" name="product_review">
    </div>
    <div>
        <label for="rs-dr-webaddress"><?php esc_html_e('Web Address', 'rs-dr-testimonial') ?></label><br>
        <input type="text" name="client_web_address">
    </div>
    <div>
        <label><?php esc_html_e('Product Rating', 'rs-dr-testimonial') ?><br>
            <input type="radio" class="rs-dr-rating" name="rating"
                   value="1"><?php esc_html_e('1', 'rs-dr-testimonial') ?>
            <input type="radio" class="rs-dr-rating" name="rating"
                   value="2"><?php esc_html_e('2', 'rs-dr-testimonial') ?>
            <input type="radio" class="rs-dr-rating" name="rating"
                   value="3"><?php esc_html_e('3', 'rs-dr-testimonial') ?>
            <input type="radio" class="rs-dr-rating" name="rating"
                   value="4"><?php esc_html_e('4', 'rs-dr-testimonial') ?>
            <input type="radio" class="rs-dr-rating" name="rating"
                   value="5"><?php esc_html_e('5', 'rs-dr-testimonial') ?>
        </label>

    </div>
    <div>
        <label for="rs-dr-cat"><?php esc_html_e('Testimonial Category', 'rs-dr-testimonial') ?></label><br>
        <?= $this->create_dropdown('rs_dr_testimonial_type') ?><br><br>
    </div>
    <div>
        <input type="file" name="client_pic"><br><br>
    </div>
    <div>
        <label for="rs-dr-title"><?= esc_html_x('Title', 'Title of the Testimonial', 'rs-dr-testimonial') ?></label><br>
        <input type="text" id="rs-dr-title" name="title">
    </div>
    <div>
        <label for="rs-dr-testimonial"><?= esc_html_x('Testimonial', 'The content of the testimonial', 'rs-dr-testimonial') ?></label>
        <textarea name="testi_content" id="rs-dr-testimonial" cols="30" rows="10"></textarea>
    </div>
    <br>
    <div class="g-recaptcha" data-sitekey="6LcQYJEUAAAAANSgjQS6MqwFBmBuNzR9jhuQ2MMO"></div>
    <div>
        <BR><BR><input type="submit" name="test_submit"
                       value="<?php esc_attr_e('Submit Testimonial', 'rs-dr-testimonial') ?>">
    </div>
</form>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
