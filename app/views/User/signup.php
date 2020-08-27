<!--start-breadcrumbs-->
<?= $breadCrumbs ?>
<!--end-breadcrumbs-->

<div class="container">
    <form data-toggle="validator" role="form" action="/user/signup" method="post">


        <div class="col-md-6 account-left">
            <div class="form-group">
                <input placeholder="login" type="text"  name = "user[login]"
                       required class="form-control" pattern="^[_A-z0-9]{1,}$"  autocomplete="username"
                       data-error="Не валидный логин"
                        value="<?= isset($_SESSION['formData']['login']) ? $_SESSION['formData']['login'] : '' ?>"
                >
                <div class="help-block with-errors">Только цифры и латинские буквы</div>
            </div>

            <div class="form-group">
                <input   class="form-control" placeholder="Password" data-minlength="6"
                       type="password" name = "user[password]" required  autocomplete="current-password"
                       data-error="Не валидный пароль"
                         value="<?= isset($_SESSION['formData']['password']) ? $_SESSION['formData']['password'] : '' ?>"
                >
                <div class="help-block with-errors">Минимум 6 символов</div>
            </div>

            <div class="form-group">
                <input placeholder="name" type="text"  name = "user[name]" required class="form-control"
                       value="<?= isset($_SESSION['formData']['name']) ? $_SESSION['formData']['name'] : '' ?>"
                >
            </div>
            <div class="form-group">
                <input placeholder="email" type="email"  name = "user[email]" required class="form-control"
                       data-error="Не валидный email"
                       value="<?= isset($_SESSION['formData']['email']) ? $_SESSION['formData']['email'] : '' ?>"
                >
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <input placeholder="address" type="text"  name = "user[address]" required class="form-control"
                       value="<?= isset($_SESSION['formData']['address']) ? $_SESSION['formData']['address'] : '' ?>"
                >
            </div>



        </div>
        <div class="clearfix"></div>
        <div class="address submit">
            <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>

    </form>
</div>
<?php if(isset($_SESSION['formData'])){
        unset($_SESSION['formData']);
}

    ?>