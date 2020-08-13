<!--banner-starts-->
<div class="bnr" id="home">
    <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->
<!--Slider-Starts-Here-->

<!--End-slider-script-->
<!--about-starts-->
<?php if($brands): ?>

<div class="about">
    <div class="container">
        <div class="about-top grid-1">
            <?php foreach ($brands as $brand): ?>

            <div class="col-md-4 about-left">
                <figure class="effect-bubba">
                    <img class="img-responsive" src="/images/<?= $brand->img ?>" alt="<?= $brand->title ?>"/>
                    <figcaption>
                        <h2><?= $brand->title ?></h2>
                        <p><?= $brand->description ?></p>
                    </figcaption>
                </figure>
            </div>

            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--about-end-->
<!--product-starts-->

<?php if($popularProducts): ?>
<?php $curr = \ishop\App::$app->getProperty('currency'); ?>
<div class="product">
    <div class="container">
        <div class="product-top">
            <div class="product-one">
                <?php foreach ($popularProducts as $product): ?>
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="product/<?= $product->alias ?>" class="mask"><img class="img-responsive zoom-img" src="images/<?= $product->img ?>" alt="<?= $product->title ?>" /></a>
                        <div class="product-bottom">
                            <h3><a href="product/<?= $product->alias ?>" /> <?= $product->title ?> </a></h3>
                            <p>Explore Now</p>
                            <h4><a class="add-to-cart-link" href="cart/add?id=<?= $product->id ?>"><i></i></a>
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
<?php endif; ?>
<!--product-end-->
<!--information-starts-->
<div class="information">
    <div class="container">
        <div class="infor-top">
            <div class="col-md-3 infor-left">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                    <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                    <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Information</h3>
                <ul>
                    <li><a href="#"><p>Specials</p></a></li>
                    <li><a href="#"><p>New Products</p></a></li>
                    <li><a href="#"><p>Our Stores</p></a></li>
                    <li><a href="contact.html"><p>Contact Us</p></a></li>
                    <li><a href="#"><p>Top Sellers</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>My Account</h3>
                <ul>
                    <li><a href="account.html"><p>My Account</p></a></li>
                    <li><a href="#"><p>My Credit slips</p></a></li>
                    <li><a href="#"><p>My Merchandise returns</p></a></li>
                    <li><a href="#"><p>My Personal info</p></a></li>
                    <li><a href="#"><p>My Addresses</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Store Information</h3>
                <h4>The company name,
                    <span>Lorem ipsum dolor,</span>
                    Glasglow Dr 40 Fe 72.</h4>
                <h5>+955 123 4567</h5>
                <p><a href="mailto:example@email.com">contact@example.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->