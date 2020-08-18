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
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">
                        <div class="flexslider">

                            <ul class="slides">
                                <li data-thumb="images/<?= $gallery[0]['img'] ?>">
                                    <div class="thumb-image"><img src="/images/<?= $gallery[0]['img'] ?>"
                                                                  data-imagezoom="true" class="img-responsive" alt=""/>
                                    </div>
                                </li>

                                <?php if (isset($gallery[1])): ?>
                                    <?php for ($i = 1; $i < count($gallery); $i++): ?>
                                        <li data-thumb="images/<?= $gallery[$i]['img'] ?>">
                                            <div class="thumb-image"><img src="/images/<?= $gallery[$i]['img'] ?>"
                                                                          data-imagezoom="true" class="img-responsive"
                                                                          alt=""/></div>
                                        </li>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!-- FlexSlider -->


                    </div>
                    <div class="col-md-7 single-top-right">

                        <?php $curr = \ishop\App::$app->getProperty("currency") ?>

                        <div class="single-para simpleCart_shelfItem">
                            <h2><?= $product->title ?></h2>
                            <div class="star-on">
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <div class="review">
                                    <a href="#"> 1 customer review </a>

                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <h5 id = "base-price" data-base = '<?= round($product->price * $curr["value"]) ?>' class="item_price"><?= $curr["symbol_left"] ?>
                                <?= round($product->price * $curr["value"]) ?><?= $curr["symbol_right"] ?>
                            </h5>
                            <?php if ($product->old_price): ?>
                                <del><?= $curr["symbol_left"] ?><?= round($product->old_price * $curr["value"]) ?></del>
                            <?php endif; ?>

                            <p><?= $product->content ?></p>

                            <?php if($productModifications): ?>

                            <div class="available">
                                <ul>
                                    <li>Color
                                        <select>
                                            <option >ЦВЕТ НЕ ВЫБРАН</option>

                                            <?php foreach ($productModifications as $mod): ?>
                                                <option  data-price = "<?= $mod['price'] * $curr['value'] ?>" value="<?= $mod['id'] ?>"><?= $mod['title'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </li>
                                    <div class="clearfix"></div>
                                </ul>
                            </div>

                            <?php endif; ?>

                            <ul class="tag-men">
                                <li>
                                    <span>Category</span>
                                    <span>:
                                            <a href="category/<?= \ishop\App::$app->getProperty('cats')[$product->category_id]['alias'] ?>"
                                               class="women1"><?= \ishop\App::$app->getProperty('cats')[$product->category_id]['title'] ?>
                                            </a>
                                    </span>
                                </li>
                            </ul>
                            <div class="quantity">
                                <input type="number" value="1" name="quantity" min="1" step="1">
                            </div>
                            <a id="productAdd" data-id="<?= $product->id ?>" href="cart/add?id=<?= $product->id ?>"
                               class="add-cart item_add add-to-cart-link">ADD TO CART</a>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tabs">
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="/images/arrow.png" alt="">Description</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="/images/arrow.png" alt="">Additional information</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="/images/arrow.png" alt="">Reviews (10)</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="/images/arrow.png" alt="">Helpful Links</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="/images/arrow.png" alt="">Make A Gift</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="latestproducts">
                    <div class="product-one">
                        <h3>С этим товаром также покупают</h3>
                        <?php if ($related): ?>
                            <?php foreach ($related as $item): ?>
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="product/<?= $item['alias'] ?>" class="mask"><img
                                                    class="img-responsive zoom-img" src="/images/<?= $item['img'] ?>"
                                                    alt="<?= $item['title'] ?>"/></a>
                                        <div class="product-bottom">
                                            <h3><?= $item['title'] ?></h3>

                                            <p>Explore Now</p>
                                            <h4><a class="item_add add-to-cart-link" data-id="<?= $item["id"] ?>"
                                                   href="cart/add?id=<?= $item["id"] ?>"><i></i></a> <span
                                                        class=" item_price">
                                            <?= $curr["symbol_left"] ?>
                                                    <?= round($item['price'] * $curr["value"]) ?><?= $curr["symbol_right"] ?>
                                                    <?php if ($item['old_price']): ?>
                                                        <del><?= $curr["symbol_left"] ?><?= round($item['old_price'] * $curr["value"]) ?></del>
                                                    <?php endif; ?>
                                        </span></h4>
                                        </div>
                                        <div class="srch">
                                            <?php if ($item['old_price']):
                                                $sale = round((100 - ($item['price'] * 100) / $item['old_price']), 1);

                                                ?>

                                                <span>-<?= $sale ?>%</span>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="latestproducts visitedProducts">
                    <div class="product-one">
                        <?php if ($visitedProducts): ?>
                            <h3>Вы смотрели:</h3>
                            <?php foreach ($visitedProducts as $item): ?>
                                <div class="col-md-2 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="product/<?= $item['alias'] ?>" class="mask"><img
                                                    class="img-responsive zoom-img" src="/images/<?= $item['img'] ?>"
                                                    alt="<?= $item['title'] ?>"/></a>
                                        <div class="product-bottom">
                                            <h6><?= $item['title'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>
                            <div class="product-all">
                                <a href="/recentlyView/view"> Показать все просмотренные товары</a>
                            </div>
                        <?php endif ?>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
            <div class="col-md-3 single-right">
                <div class="w_sidebar">
                    <section class="sky-form">
                        <h4>Catogories</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>All
                                    Accessories</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Women
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kids
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Men
                                    Watches</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Brand</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>kurtas</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sonata</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Titan</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Casio</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Omax</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fastrack</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sports</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fossil</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Maxima</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yepme</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Citizen</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diesel</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Colour</h4>
                        <ul class="w_nav2">
                            <li><a class="color1" href="#"></a></li>
                            <li><a class="color2" href="#"></a></li>
                            <li><a class="color3" href="#"></a></li>
                            <li><a class="color4" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                            <li><a class="color12" href="#"></a></li>
                            <li><a class="color13" href="#"></a></li>
                            <li><a class="color14" href="#"></a></li>
                            <li><a class="color15" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                        </ul>
                    </section>
                    <section class="sky-form">
                        <h4>discount</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio" checked=""><i></i>60 % and
                                    above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>50 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>40 % and above</label>
                            </div>
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio"><i></i>30 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>20 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>10 % and above</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--end-single-->