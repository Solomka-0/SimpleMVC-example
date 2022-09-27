<?php

use ItForFree\SimpleMVC\Config;
$subcategories = Config::getObject('core.subcategory.class')->getListByCategoryId($_POST['category_id']);

foreach ($subcategories as $subcategory) { ?>
    <option value="<?= $subcategory->id ?>" <?=isset($_POST['subcategory_id']) ? ($subcategory->id == $_POST['subcategory_id'] ? "selected" : "") : ""?>><?= $subcategory->name ?></option>
<?php } ?>