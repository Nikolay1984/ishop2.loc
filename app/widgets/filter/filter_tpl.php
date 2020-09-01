<div class="w_sidebar">
    <?php foreach ($this->groups as $id_group => $item): ?>
    <section class="sky-form">
        <h4><?= $item ?></h4>
        <div class="row1 scroll-pane">
            <?php foreach ($this->attrs[$id_group] as $id_attr => $item_attr): ?>

            <div class="col col-4">
                <label class="checkbox"><input type="checkbox" name="checkbox" value="<?= $id_attr ?>" ><i></i><?= $item_attr ?></label>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>
</div>