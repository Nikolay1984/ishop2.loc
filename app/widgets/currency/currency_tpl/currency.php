<?php

use ishop\App;
$currency = App::$app->getProperty("currency");
$currencies = App::$app->getProperty("currencies");

?>
<option value="" class="label"><?= $currency["code"] ?></option>
<?php foreach ($currencies as $key=>$value): ?>
<?php if($key != $currency["code"]): ?>
    <option value="<?= $key ?>"><?= $key ?> </option>

<?php endif; ?>
<?php endforeach; ?>


