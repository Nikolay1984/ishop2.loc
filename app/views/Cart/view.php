<!--start-breadcrumbs-->
<?= $breadCrumbs ?>
<!--end-breadcrumbs-->
<div class="cart-order">

    <div class="container">
<?php require VIEWS ."/Cart/cart_modal.php"?>
        <form method="post" action="cart/checkout" role="form" data-toggle="validator">
            <?php if(!isset($_SESSION['user'])): ?>
                <div class="form-group has-feedback">
                    <label for="login">Login</label>
                    <input type="text" name="user[login]" class="form-control" id="login" placeholder="Login" autocomplete="username" value="<?= isset($_SESSION['form_data']['login']) ? $_SESSION['form_data']['login'] : '' ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="pasword">Password</label>
                    <input type="password" name="user[password]" class="form-control" id="pasword" placeholder="Password" autocomplete="current-password" value="<?= isset($_SESSION['form_data']['password']) ? $_SESSION['form_data']['password'] : '' ?>" data-minlength="6" data-error="Пароль должен включать не менее 6 символов" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    <label for="name">Имя</label>
                    <input type="text" name="user[name]" class="form-control" id="name" placeholder="Имя" value="<?= isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '' ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="email">Email</label>
                    <input type="email" name="user[email]" class="form-control" id="email" placeholder="Email" value="<?= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '' ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="address">Address</label>
                    <input type="text" name="user[address]" class="form-control" id="address" placeholder="Address" value="<?= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : '' ?>" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
            <?php endif; ?>
            <?php if(!isset($cartEmpty)):?>

            <div class="form-group cart-note">
                <label for="address">Note</label>
                <textarea name="note" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-default cart-note">Оформить</button>
            <?php endif; ?>
        </form>
    </div>

</div>


