<style>
    textarea {
        height: 200%;
        width: 100%;
        color: #003300;
    }
</style>


<?php
include('includes/admin-categories-nav.php');
?>

<form id="addCategory" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminCategories/edit") ?>">
    <div class="form-group">
        <label for="name">Название категории</label>
        <input type="text" class="form-control" name="name" placeholder="Название категории"
               value="<?= $category->name; ?>">
    </div>
    <div class="form-group">
        <label for="content">Описание категории</label><br>
        <textarea type="description" name="description" placeholder="Краткое описание"
                  rows="<?= intval(strlen($category->description) / 200) ?>"><?= $category->description; ?></textarea>
    </div>

    <input name="id" value="<?=$category->id?>" hidden>
    <input type="submit" class="btn btn-primary" name="saveEditCategory" value="Сохранить" style="margin-right: 10px">
    <input type="submit" class="btn btn-danger" name="deleteCategory" value="Удалить" style="margin-right: 10px">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>
