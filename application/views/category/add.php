<style>
    textarea {
        height: 200%;
        width: 100%;
        color: #003300;
    }
</style>

<?php include('includes/admin-categories-nav.php'); ?>
<h2><?= $adminCategoryTitle ?></h2>

<form id="addCategory" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminCategories/add") ?>">
    <div class="form-group">
        <label for="name">Название новой категории</label>
        <input type="text" class="form-control" name="name" placeholder="Название категории">
    </div>
    <div class="form-group">
        <label for="description">Краткое описание</label><br>
        <textarea type="description" name="description" placeholder="Краткое описание" value=""></textarea>
    </div>

    <input type="submit" class="btn btn-primary" name="saveNewCategory" value="Сохранить" style="margin-right: 10px">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>    
