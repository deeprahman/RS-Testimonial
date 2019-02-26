<p>
    <label for="<?= $single_id_title ?>">
        <?= $single_label_title ?> <input type="text" id="<?= $single_id_title ?>" name="<?= $single_name_title ?>"
                                          value="<?= $single_value_title ?>">
    </label>
</p>

<p>
    <label for="<?= $single_id_list ?>">
        <select name="<?= $single_name_list ?>" id="<?= $single_id_list ?>">
            <?php foreach ($titles as $id => $title): ?>
                <option value="<?= $id ?>" <?= selected($single_value_list, $id, false) ?>><?= $title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
</p>
<p>

    <label for="<?= $single_id_show_title ?>">
        <?= $single_label_show_title ?>
        <input type="checkbox" id="<?= $single_id_show_title ?>"
               name="<?= $single_name_show_title ?>" <?= checked($single_value_show_title, 'on', false) ?>>
    </label>
</p>

<p>

    <label for="<?= $single_id_show_excerpt ?>">
        <?= $single_label_show_excerpt ?>
        <input type="checkbox" id="<?= $single_id_show_excerpt ?>"
               name="<?= $single_name_show_excerpt ?>" <?= checked($single_value_show_excerpt, 'on', false) ?>>
    </label>
</p>

<p>
    <label for="<?= $single_id_show_image ?>">
        <?= $single_label_show_image ?>
        <input type="checkbox" id="<?= $single_id_show_image ?>"
               name="<?= $single_name_show_image ?>" <?= checked($single_value_show_image, 'on', false) ?>>
    </label>
</p>

<p>
    <label for="<?= $single_id_show_date ?>">
        <?= $single_label_show_date ?>
        <input type="checkbox" id="<?= $single_id_show_date ?>"
               name="<?= $single_name_show_date ?>" <?= checked($single_value_show_date, 'on', false) ?>>
    </label>
</p>
<p>
    <label for="<?= $single_id_show_location ?>">
        <?= $single_label_show_location ?>
        <input type="checkbox" id="<?= $single_id_show_location ?>"
               name="<?= $single_name_show_location ?>" <?= checked($single_value_show_location, 'on', false) ?>>
    </label>
</p>
<p>
    <label for="<?= $single_id_show_more_link ?>">
        <?= $single_label_show_more_link ?>
        <input type="checkbox" id="<?= $single_id_show_more_link ?>"
               name="<?= $single_name_show_more_link ?>" <?= checked($single_value_show_more_link, 'on', false) ?>>
    </label>
</p>

<p>
    <label for="<?= $single_label_show_rating ?>">
        <?= __('Show Rating', 'rs-dr-testimonial') ?><br>
        <input type="radio" id="<?= $single_id_show_rating ?>" name="<?= $single_name_show_rating ?>"
               value="1" <?= checked($single_value_show_rating, '1', false) ?>> <?= __('Before Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $single_id_show_rating ?>" name="<?= $single_name_show_rating ?>"
               value="2" <?= checked($single_value_show_rating, '2', false) ?>> <?= __('After Title', 'rs-dr-testimonial') ?>
        <input type="radio" id="<?= $single_id_show_rating ?>" name="<?= $single_name_show_rating ?>"
               value="3" <?= checked($single_value_show_rating, '3', false) ?>> <?= __('No Rating', 'rs-dr-testimonial') ?>
    </label>
</p>