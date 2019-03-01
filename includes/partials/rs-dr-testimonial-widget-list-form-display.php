<p>
    <label for="<?= $list_id_title ?>">
        <?= $list_label_title ?> <input type="text" id="<?= $list_id_title ?>" name="<?= $list_namel_title ?>"
                                        value="<?= $list_value_title ?>">
    </label>
</p>

<p>
    <label for="<?= $list_id_count ?>">
        <?= $list_label_count ?><input type="number" id="<?= $list_id_count ?>" name="<?= $list_name_count ?>"
                                       value="<?= $list_value_count ?>">
    </label>
</p>

<p>
    <label for="<?= $id_category ?>">
        <?= $list_label_category ?>
        <?= $this->create_terms_dropdown($list_name_taxonomy, $list_selected_category, $list_name_category, $list_id_category); ?>
    </label>
</p>

<p>
    <label for="<?= $list_id_orderby ?>"><?= esc_html__('Order By', 'rs-dr-testimonial') ?>
        <select id="<?= $list_id_orderby ?>" name="<?= $list_name_orderby ?>">
            <option value="date" <?php selected($list_value_orderby, 'date') ?>><?= esc_html__('Date', 'rs-dr-testimonial') ?></option>
            <option value="rand" <?php selected($list_value_orderby, 'rand') ?>><?= esc_html__('Random', 'rs-dr-testimonial') ?></option>
            <option value="id" <?php selected($list_value_orderby, 'id') ?>><?= esc_html__('ID', 'rs-dr-testimonial') ?></option>
            <option value="author" <?php selected($list_value_orderby, 'author') ?>><?= esc_html__('Author', 'rs-dr-testimonial') ?></option>
            <option value="title" <?php selected($list_value_orderby, 'title') ?>><?= esc_html__('Title', 'rs-dr-testimonial') ?></option>
            <option value="parent" <?php selected($list_value_orderby, 'parent') ?>><?= esc_html__('Parent', 'rs-dr-testimonial') ?></option>
            <option value="ID" <?php selected($list_value_orderby, 'ID') ?>><?= esc_html__('ID', 'rs-dr-testimonial') ?></option>
        </select>
    </label>
</p>

<p>
    <label for="<?= $list_id_order ?>"><?= esc_html__('Sort By', 'rs-dr-testimonial') ?>
        <select id="<?= $list_id_order ?>" name="<?= $list_name_order ?>">
            <option value="ASC" <?php selected($list_value_order, 'ASC') ?>><?= esc_html__('Ascending Order', 'rs-dr-testimonial') ?></option>
            <option value="DESC" <?php selected($list_value_order, 'DESC') ?>><?= esc_html__('Descending Order', 'rs-dr-testimonial') ?></option>
        </select>
    </label>
</p>

<p>
    <!--    Label for show title-->
    <label for="<?= $list_id_show_title ?>">
        <?= $list_label_show_title ?>
        <input type="checkbox" id="<?= $list_id_show_title ?>"
               name="<?= $list_name_show_title ?>" <?= checked($list_value_show_title, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show excerpt-->
    <label for="<?= $list_id_show_excerpt ?>">
        <?= $list_label_show_excerpt ?>
        <input type="checkbox" id="<?= $list_id_show_excerpt ?>"
               name="<?= $list_name_show_excerpt ?>" <?= checked($list_value_show_excerpt, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show image-->
    <label for="<?= $list_id_show_image ?>">
        <?= $list_label_show_image ?>
        <input type="checkbox" id="<?= $list_id_show_image ?>"
               name="<?= $list_name_show_image ?>" <?= checked($list_value_show_image, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show Date-->
    <label for="<?= $list_id_show_date ?>">
        <?= $list_label_show_date ?>
        <input type="checkbox" id="<?= $list_id_show_date ?>"
               name="<?= $list_name_show_date ?>" <?= checked($list_value_show_date, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for Location Review-->
    <label for="<?= $list_id_show_location ?>">
        <?= $list_label_show_location ?>
        <input type="checkbox" id="<?= $list_id_show_location ?>"
               name="<?= $list_name_show_location ?>" <?= checked($list_value_show_location, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for View More Testimonial Link-->
    <label for="<?= $list_id_show_more_link ?>">
        <?= $list_label_show_more_link ?>
        <input type="checkbox" id="<?= $list_id_show_more_link ?>"
               name="<?= $list_name_show_more_link ?>" <?= checked($list_value_show_more_link, 'on', false) ?>>
    </label>
</p>

<p>
    <label for="<?= $list_id_show_rating ?>">
        <?= __('Show Rating', 'rs-dr-testimonial') ?><br>
        <input type="radio" id="<?= $list_id_show_rating ?>" name="<?= $list_name_show_rating ?>"
               value="1" <?= checked($list_value_show_rating, '1', false) ?>> <?= __('Before Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $list_id_show_rating ?>" name="<?= $list_name_show_rating ?>"
               value="2" <?= checked($list_value_show_rating, '2', false) ?>> <?= __('After Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $list_id_show_rating ?>" name="<?= $list_name_show_rating ?>"
               value="3" <?= checked($list_value_show_rating, '3', false) ?>> <?= __('No Rating', 'rs-dr-testimonial') ?>

    </label>
</p>

