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
<h2><?= $adminSubcategoryTitle ?></h2>

<form id="addSubcategory" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminSubcategories/add") ?>">
    <div class="form-group">
        <label for="name">Название новой категории</label>
        <input type="text" class="form-control" name="name" placeholder="Название категории">
    </div>
    <div class="form-group">
        <label for="description">Краткое описание</label><br>
        <textarea type="description" name="description" placeholder="Краткое описание" value=""></textarea>
    </div>

    <div class="form-group">
        <label for="category_id" style="padding-right: 10px;">Категория </label>
        <select name="category_id" class="category_id">
            <?php foreach ($categories['results'] as $category) { ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php } ?>
        </select>
    </div>

    <input type="submit" class="btn btn-primary" name="saveNewSubcategory" value="Сохранить" style="margin-right: 10px">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>    
