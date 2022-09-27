<style>
    textarea {
        height: 200%;
        width: 100%;
        color: #003300;
    }
</style>

<script>
    $(document).ready(function () {

            let onChange = function () {
                let url = "<?=\ItForFree\SimpleMVC\Url::link('ajax/getSubcategory')?>";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {category_id: this.value ?? $('.categoryId').children()[0].value},
                    dataType: 'html',
                    success: function (data) {
                        $('.subcategoryId').html(data);
                    }
                })
            };
            let a = "<?=$_SESSION['user']['id']?>";
            $('.authors').children('[value=' + a + ']').attr('selected', 'selected');
            onChange();
            $('.categoryId').bind('change', onChange);
        }
    );
</script>

<?php use ItForFree\SimpleMVC\Config;

include('includes/admin-articles-nav.php');
$categories = Config::getObject('core.category.class')->getList();
$usernames = Config::getObject('core.user.class')->getUsernameList();
?>
<h2><?= $adminArticleTitle ?></h2>

<form id="addNote" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminArticles/add") ?>">
    <div class="form-group">
        <label for="title">Название новой статьи</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Заголовок статьи">
    </div>
    <div class="form-group">
        <label for="content">Предисловие</label><br>
        <textarea type="description" name="summary" placeholder="Краткое описание" value=""></textarea>
    </div>
    <div class="form-group">
        <label for="content">Контент</label><br>
        <textarea type="description" name="content" placeholder="Текст статьи" value="" rows="8"></textarea>
    </div>
    <div class="form-group">

    </div>

    <div class="form-group">
        <label for="categoryId" style="padding-right: 10px;">Категория </label>
        <select name="categoryId" class="categoryId">
            <?php foreach ($categories['results'] as $category) { ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php } ?>
        </select>
        <select name="subcategoryId" class="subcategoryId">

        </select>
    </div>

    <div class="form-group">
        <label for="publicationDate" style="padding-right: 20px">Дата публикации</label>
        <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required=""
               maxlength="10" value="<?= date('Y-m-d'); ?>">
    </div>

    <div style="padding: 0px 20px 20px 0px">
        <label for="authors">Автор(-ы):</label>
        <br>
        <select name="authors[]" multiple size="4" style="width: 400px" class="authors">
            <?php foreach ($usernames['results'] as $username) { ?>
                <option value="<?= $username->id ?>"><?= $username->login ?></option>
            <?php } ?>
        </select>
    </div>

    <div style="padding-bottom: 20px">
        <label for="access_id">Модификатор доступа</label>
        <select name="access_id">
            <option value=
                    "0" selected> Закрыт для просмотра
            </option>
            <option value=
                    "1"> Открыт для просмотра
            </option>
            <option value=
                    "2"> Открыт для редактирование / просмотра
            </option>
        </select>
    </div>

    <input type="submit" class="btn btn-primary" name="saveNewArticle" value="Сохранить" style="margin-right: 10px">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>    
