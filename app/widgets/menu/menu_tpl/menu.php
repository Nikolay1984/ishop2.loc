<?php $parent = isset($category['childs']) ?>

    <li>
        <a href="?id = <?= $id ?>"> <?= $tab?>  <?= $category['title'] ?></a>

        <?php if(isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
        <?php endif; ?>

    </li>
