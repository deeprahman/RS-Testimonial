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
    <label for="<?= $id_orderby ?>"><?= esc_html__('Order By', 'rs-dr-testimonial') ?>
        <select id="<?= $id_orderby ?>" name="<?= $name_orderby ?>">
            <option value="date" <?php selected($value_orderby, 'date') ?>><?= esc_html__('Date', 'rs-dr-testimonial') ?></option>
            <option value="rand" <?php selected($value_orderby, 'rand') ?>><?= esc_html__('Random', 'rs-dr-testimonial') ?></option>
            <option value="id" <?php selected($value_orderby, 'id') ?>><?= esc_html__('ID', 'rs-dr-testimonial') ?></option>
            <option value="author" <?php selected($value_orderby, 'author') ?>><?= esc_html__('Author', 'rs-dr-testimonial') ?></option>
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

