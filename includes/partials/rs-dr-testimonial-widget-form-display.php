<p>
    <label for="<?= $id_title ?>">
        <?= $label_title ?> <input type="text" id="<?= $id_title ?>" name="<?= $name_title ?>"
                                   value="<?= $value_title ?>">
    </label>
</p>

<p>
    <label for="<?= $id_count ?>">
        <?= $label_count ?> <input type="number" id="<?= $id_count ?>" name="<?= $name_count ?>"
                                   value="<?= $value_count ?>">
    </label>
</p>
<p>
    <label for="<?= $id_category ?>">
        <?= $label_category ?>
        : <?= $this->create_terms_dropdown($name_taxonomy, $selected_category, $name_category, $id_category) ?>
    </label>
</p>

<p>
    <label for="<?= $id_orderby ?>"><?= esc_html__('Order By', 'rs-dr-testimonial') ?>
        <select id="<?= $id_orderby ?>" name="<?= $name_orderby ?>">
            <option value="date" <?php selected($value_orderby, 'date') ?>><?= esc_html__('Date', 'rs-dr-testimonial') ?></option>
            <option value="rand" <?php selected($value_orderby, 'rand') ?>><?= esc_html__('Random', 'rs-dr-testimonial') ?></option>
            <option value="id" <?php selected($value_orderby, 'id') ?>><?= esc_html__('ID', 'rs-dr-testimonial') ?></option>
            <option value="author" <?php selected($value_orderby, 'author') ?>><?= esc_html__('Author', 'rs-dr-testimonial') ?></option>
            <option value="title" <?php selected($value_orderby, 'title') ?>><?= esc_html__('Title', 'rs-dr-testimonial') ?></option>
            <option value="parent" <?php selected($value_orderby, 'parent') ?>><?= esc_html__('Parent', 'rs-dr-testimonial') ?></option>
            <option value="ID" <?php selected($value_orderby, 'ID') ?>><?= esc_html__('ID', 'rs-dr-testimonial') ?></option>
        </select>
    </label>
</p>

<p>
    <label for="<?= $id_order ?>"><?= esc_html__('Sort By', 'rs-dr-testimonial') ?>
        <select id="<?= $id_order ?>" name="<?= $name_order ?>">
            <option value="ASC" <?php selected($value_order, 'ASC') ?>><?= esc_html__('Ascending Order', 'rs-dr-testimonial') ?></option>
            <option value="DESC" <?php selected($value_order, 'DESC') ?>><?= esc_html__('Descending Order', 'rs-dr-testimonial') ?></option>
        </select>
    </label>
</p>

<p>
    <!--    Label for show title-->
    <label for="<?= $id_show_title ?>">
        <?= $label_show_title ?>
        <input type="checkbox" id="<?= $id_show_title ?>"
               name="<?= $name_show_title ?>" <?= checked($value_show_title, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show excerpt-->
    <label for="<?= $id_show_excerpt ?>">
        <?= $label_show_excerpt ?>
        <input type="checkbox" id="<?= $id_show_excerpt ?>"
               name="<?= $name_show_excerpt ?>" <?= checked($value_show_excerpt, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show image-->
    <label for="<?= $id_show_image ?>">
        <?= $label_show_image ?>
        <input type="checkbox" id="<?= $id_show_image ?>"
               name="<?= $name_show_image ?>" <?= checked($value_show_image, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for show Date-->
    <label for="<?= $id_show_date ?>">
        <?= $label_show_date ?>
        <input type="checkbox" id="<?= $id_show_date ?>"
               name="<?= $name_show_date ?>" <?= checked($value_show_date, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for Location Review-->
    <label for="<?= $id_show_location ?>">
        <?= $label_show_location ?>
        <input type="checkbox" id="<?= $id_show_location ?>"
               name="<?= $name_show_location ?>" <?= checked($value_show_location, 'on', false) ?>>
    </label>
</p>

<p>
    <!--    Label for View More Testimonial Link-->
    <label for="<?= $id_show_more_link ?>">
        <?= $label_show_more_link ?>
        <input type="checkbox" id="<?= $id_show_more_link ?>"
               name="<?= $name_show_more_link ?>" <?= checked($value_show_more_link, 'on', false) ?>>
    </label>
</p>

<p>
    <label for="<?= $id_show_rating ?>">
        <?= __('Show Rating', 'rs-dr-testimonial') ?><br>
        <input type="radio" id="<?= $id_show_rating ?>" name="<?= $name_show_rating ?>"
               value="1" <?= checked($value_show_rating, '1', false) ?>> <?= __('Before Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $id_show_rating ?>" name="<?= $name_show_rating ?>"
               value="2" <?= checked($value_show_rating, '2', false) ?>> <?= __('After Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $id_show_rating ?>" name="<?= $name_show_rating ?>"
               value="3" <?= checked($value_show_rating, '3', false) ?>> <?= __('No Rating', 'rs-dr-testimonial') ?>

    </label>
</p>





