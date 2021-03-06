
<?php $curr = \ishop\App::$app->getProperty('currency'); ?>

<?php if(!empty($_SESSION['productsInCart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($_SESSION['productsInCart'] as $id => $item): ?>
                <tr>
                    <td><a href="product/<?=$item['alias'];?>"><img src="images/<?=$item['img'];?>" alt=""></a></td>
                    <td><a href="product/<?=$item['alias'];?>"><?=$item['name'] . " " . $item['modName'];?></td>
                    <td><?=$item['quantity'];?></td>
                    <td><?= round($item['price'] * $_SESSION['productsInCart.currency']['value'])   ;?></td>
                    <td>

                        <a href="cart/delete?deleteFromCart=<?=$id;?>" data-id="<?=$id;?>"
                           class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></a>


                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>Итого:</td>
                <td colspan="4" class="text-right cart-qty"><?=$_SESSION['productsInCart.quantity'];?></td>
            </tr>
            <tr>
                <td>На сумму:</td>
                <td colspan="4" class="text-right cart-sum" id = "cart-sum-my"><?= $_SESSION['productsInCart.currency']['symbol_left']
                    . round($_SESSION['productsInCart.sum'] * $_SESSION['productsInCart.currency']['value']).
                    $_SESSION['productsInCart.currency']['symbol_right'];?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
<?php $cartEmpty = '<h3>Корзина пуста</h3>'; echo $cartEmpty?>
<?php endif; ?>
