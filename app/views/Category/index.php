<!--start-breadcrumbs-->
<?= $breadCrumbs ?>
<!--end-breadcrumbs-->
<?php if($arrCategoryProducts): ?>
    <?php $curr = \ishop\App::$app->getProperty('currency'); ?>
    <div class="product">
        <div class="container">
            <div class="product-top">
                <div class="product-one">
                    <?php foreach ($arrCategoryProducts as $product): ?>
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="/product/<?= $product->alias ?>" class="mask"><img class="img-responsive zoom-img" src="/images/<?= $product->img ?>" alt="<?= $product->title ?>" /></a>
                                <div class="product-bottom">
                                    <h3><a href="/product/<?= $product->alias ?>" /> <?= $product->title ?> </a></h3>
                                    <p>Explore Now</p>
                                    <h4><a  data-id ='<?= $product->id ?>' class="add-to-cart-link item_add" href="cart/add?id=<?= $product->id ?>"><i></i></a>
                                        <span class=" item_price"><?= $curr["symbol_left"] ?><?= round($product->price * $curr["value"]) ?><?= $curr["symbol_right"] ?></span>
                                        <?php if($product->old_price): ?>
                                            <small><del><?= $curr["symbol_left"] ?><?= round($product->old_price * $curr["value"]) ?></del></small>
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <div class="srch">

                                    <?php if($product->old_price):
                                        $sale = round((100 - ($product->price * 100)/$product->old_price),1);

                                        ?>

                                        <span>-<?= $sale ?>%</span>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container">
    <p>Простите, данная категория пуста!</p>
    </div>
<?php endif; ?>

<?= $htmlPagination ?>
