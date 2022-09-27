<style>
    textarea {
        height: 200%;
        width: 100%;
        color: #003300;
    }
</style>


<?php

use ItForFree\SimpleMVC\Config;

include('includes/admin-subcategories-nav.php');
$categories = Config::getObject('core.category.class')->getList();
?>

<form id="addSubcategory" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminSubcategories/edit") ?>">
    <div class="form-group">
        <label for="name">Название подкатегории</label>
        <input type="text" class="form-control" name="name" placeholder="Название подкатегории"
               value="<?= $subcategory->name; ?>">
    </div>
    <div class="form-group">
        <label for="content">Описание подкатегории</label><br>
        <textarea type="description" name="description" placeholder="Краткое описание"
                  rows="<?= intval(strlen($subcategory->description) / 200) ?>"><?= $subcategory->description; ?></textarea>
    </div>
    <div class="form-group">
        <label for="category_id" style="padding-right: 10px;">Категория </label>
        <select name="category_id" class="category_id">
            <?php foreach ($categories['results'] as $category) { ?>
                <option value="<?= $category->id ?>" <?=$subcategory->category_id == $category->id ? "selected" : ""?>><?= $category->name ?></option>
            <?php } ?>
        </select>
    </div>

    <input name="id" value="<?=$subcategory->id?>" hidden>
    <input type="submit" class="btn btn-primary" name="saveEditSubcategory" value="Сохранить" style="margin-right: 10px">
    <input type="submit" class="btn btn-danger" name="deleteSubcategory" value="Удалить" style="margin-right: 10px">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>
