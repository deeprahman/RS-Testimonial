<style>
    .rs-dr-rating {
        margin-left: 10px;
    }
</style>
<form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="action" value="contact_form">
    <?php wp_nonce_field('rs_dr_t_from', 'form_nonce') ?>
    <div>
        <label for="rs-dr-name">Your Full Name</label><br>
        <input type="text" id="rs-dr-name" name="client_name">
    </div>
    <div>
        <label for="rs-dr-email">Your Email Address</label><br><br>
        <input type="text" id="rs-dr-email" name="client_email">
    </div>
    <div>
        <label for="rs-dr-review">Product Review</label><br>
        <input type="text" id="rs-dr-review" name="product_review">
    </div>
    <div>
        <label for="rs-dr-webaddress">Web Address</label><br>
        <input type="text" name="client_web_address">
    </div>
    <div>
        <label>Product Rating<br>
            <input type="radio" class="rs-dr-rating" name="rating" value="1">1
            <input type="radio" class="rs-dr-rating" name="rating" value="2">2
            <input type="radio" class="rs-dr-rating" name="rating" value="3">3
            <input type="radio" class="rs-dr-rating" name="rating" value="4">4
            <input type="radio" class="rs-dr-rating" name="rating" value="5">5
        </label>

    </div>
    <div>
        <label for="rs-dr-cat">Testimonial Category</label><br>
        <?= $this->create_dropdown('rs_dr_testimonial_type') ?><br><br>
    </div>
    <div>
        <input type="file" name="client_pic"><br><br>
    </div>
    <div>
        <label for="rs-dr-title">Title</label><br>
        <input type="text" id="rs-dr-title" name="title">
    </div>
    <div>
        <label for="rs-dr-testimonial">Testimonial</label>
        <textarea name="testi_content" id="rs-dr-testimonial" cols="30" rows="10"></textarea>
    </div>
    <br>
    <div class="g-recaptcha" data-sitekey="6LcQYJEUAAAAANSgjQS6MqwFBmBuNzR9jhuQ2MMO"></div>
    <div>
        <BR><BR><input type="submit" name="test_submit" value="Submit Testimonial">
    </div>
</form>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
