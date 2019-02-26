<p>
    <label for="<?= $rand_id_title ?>">
        <?= $rand_label_title ?> <input type="text" id="<?= $rand_id_title ?>" name="<?= $rand_name_title ?>"
                                        value="<?= $rand_value_title ?>">
    </label>
</p>

<p>
    <label for="<?= $rand_id_count ?>">
        <?= $rand_label_count ?> <input type="number" id="<?= $rand_id_count ?>" name="<?= $rand_name_count ?>"
                                        value="<?= $rand_value_count ?>">
    </label>
</p>
<p>
    <label for="<?= $rand_id_cat ?>">
        <?= $rand_label_cat ?>
        : <?= $this->create_terms_dropdown($rand_name_taxonomy, $rand_selected_category, $rand_name_cat, $rand_id_cat) ?>
    </label>
</p>


<p>
    <label for="<?= $rand_id_sort ?>"><?= esc_html__('Sort By', 'rs-dr-testimonial') ?>
        <select id="<?= $rand_id_sort ?>" name="<?= $rand_name_sort ?>">
            <option value="ASC" <?php selected($rand_value_sort, 'ASC') ?>><?= esc_html__('Ascending Order', 'rs-dr-testimonial') ?></option>
            <option value="DESC" <?php selected($rand_value_sort, 'DESC') ?>><?= esc_html__('Descending Order', 'rs-dr-testimonial') ?></option>
        </select>
    </label>
</p>

<p>
    <!--    Label for show title-->
    <label for="<?= $rand_id_show_title ?>">
        <?= $rand_label_show_title ?>
        <input type="checkbox" id="<?= $rand_id_show_title ?>"
               name="<?= $rand_name_show_title ?>" <?= checked($rand_value_show_title, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show excerpt-->
    <label for="<?= $rand_id_show_excerpt ?>">
        <?= $rand_label_show_excerpt ?>
        <input type="checkbox" id="<?= $rand_id_show_excerpt ?>"
               name="<?= $rand_name_show_excerpt ?>" <?= checked($rand_value_show_excerpt, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show image-->
    <label for="<?= $rand_id_show_image ?>">
        <?= $rand_label_show_image ?>
        <input type="checkbox" id="<?= $rand_id_show_image ?>"
               name="<?= $rand_name_show_image ?>" <?= checked($rand_value_show_image, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show Date-->
    <label for="<?= $rand_id_show_date ?>">
        <?= $rand_label_show_date ?>
        <input type="checkbox" id="<?= $rand_id_show_date ?>"
               name="<?= $rand_name_show_date ?>" <?= checked($rand_value_show_date, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for Location Review-->
    <label for="<?= $rand_id_show_location ?>">
        <?= $rand_label_show_location ?>
        <input type="checkbox" id="<?= $rand_id_show_location ?>"
               name="<?= $rand_name_show_location ?>" <?= checked($rand_value_show_location, 'on', false) ?>>
    </label>
</p>


<p>
    <!--    Label for View More Testimonial Link-->
    <label for="<?= $rand_id_show_more_link ?>">
        <?= $rand_label_show_more_link ?>
        <input type="checkbox" id="<?= $rand_id_show_more_link ?>"
               name="<?= $rand_name_show_more_link ?>" <?= checked($rand_value_show_more_link, 'on', false) ?>>
    </label>
</p>

<p>
    <label for="<?= $rand_id_show_rating ?>">
        <?= __('Show Rating', 'rs-dr-testimonial') ?><br>
        <input type="radio" id="<?= $rand_id_show_rating ?>" name="<?= $rand_name_show_rating ?>"
               value="1" <?= checked($rand_value_show_rating, '1', false) ?>> <?= __('Before Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $rand_id_show_rating ?>" name="<?= $rand_name_show_rating ?>"
               value="2" <?= checked($rand_value_show_rating, '2', false) ?>> <?= __('After Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $rand_id_show_rating ?>" name="<?= $rand_name_show_rating ?>"
               value="3" <?= checked($rand_value_show_rating, '3', false) ?>> <?= __('No Rating', 'rs-dr-testimonial') ?>

    </label>
</p>






