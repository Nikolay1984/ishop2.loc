<!--start-breadcrumbs-->
<?= $breadCrumbs ?>
<!--end-breadcrumbs-->
<div class="container">
<form data-toggle="validator" role="form" action="/user/login" method="post">


<div class="col-md-6 account-left">
    <div class="form-group">
    <input placeholder="login" type="text"  name = "user[login]" required class="form-control" pattern="^[_A-z0-9]{1,}$" autocomplete="username">
    </div>
    <div class="form-group">
    <input placeholder="Password" type="password" name = "user[password]" required autocomplete="current-password">
    </div>
</div>
<div class="clearfix"></div>
<div class="address submit">
    <input type="submit" value="Submit">
</div>

</form>
</div>

