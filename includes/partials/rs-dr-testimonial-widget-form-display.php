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
    <label for="<?= $id_orderby ?>">Order By
        <select id="<?= $id_orderby ?>" name="<?= $name_orderby ?>">
            <option value="date" <?php selected($value_orderby, 'date') ?>>Date</option>
            <option value="rand" <?php selected($value_orderby, 'rand') ?>>Random</option>
            <option value="id" <?php selected($value_orderby, 'id') ?>>ID</option>
            <option value="author" <?php selected($value_orderby, 'author') ?>>Author</option>
        </select>
    </label>
</p>


<p>
    <label for="<?= $id_order ?>">Sort By
        <select id="<?= $id_order ?>" name="<?= $name_order ?>">
            <option value="ASC" <?php selected($value_order, 'ASC') ?>>Ascending Order</option>
            <option value="DESC" <?php selected($value_order, 'DESC') ?>>Descending Order</option>
        </select>
    </label>
</p>

