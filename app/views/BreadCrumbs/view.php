<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">

        <div class="breadcrumbs-main">

            <?php if (isset($breadCrumbs)): ?>

                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>

                    <?php forEach ($breadCrumbs as $value): ?>

                        <?php if (isset($value['alias'])): ?>
                            <li><a href="/category/<?= $value['alias'] ?>"><?= $value['title']; ?></a></li>
                        <?php endif; ?>

                    <?php endforeach; ?>

                    <li class="active"><?= $value['title']; ?></li>
                </ol>

            <?php endif; ?>

        </div>
    </div>
</div>
</div>
<!--end-breadcrumbs-->
