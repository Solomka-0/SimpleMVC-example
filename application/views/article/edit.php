<style>
    textarea {
        height: 200%;
        width: 100%;
        color: #003300;
    }
</style>

<script>
    let onChange = function (object = null) {
        object = object != null ? object.currentTarget : this.currentTarget;

        let url = "<?=\ItForFree\SimpleMVC\Url::link('ajax/getSubcategory')?>";
        let subcategory_id = null;
        try {
            subcategory_id = object.attributes.getNamedItem("subcategory_id").value;
        } catch (e) {
            console.log("error");
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: {category_id: object.value ?? $('.categoryId').children()[0].value, subcategory_id: subcategory_id},
            dataType: 'html',
            success: function (data) {
                $('.subcategoryId').html(data);
            }
        })
    };
    $(function () {
            let a = "<?=$_SESSION['user']['id']?>";
            $('.authors').children('[value=' + a + ']').attr('selected', 'selected');
            let object = new Object();
            object.currentTarget = $('.categoryId')[0];

            onChange(object);
            $('.categoryId').bind('change', onChange);
        }
    );
</script>

<?php use ItForFree\SimpleMVC\Config;

include('includes/admin-articles-nav.php');
$categories = Config::getObject('core.category.class')->getList();
$usernames = Config::getObject('core.user.class')->getUsernameList();
?>

<form id="addNote" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminArticles/edit") ?>">
    <div class="form-group">
        <label for="title">Название новой статьи</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Заголовок статьи"
               value="<?= $article->title; ?>">
    </div>
    <div class="form-group">
        <label for="content">Предисловие</label><br>
        <textarea type="description" name="summary" placeholder="Краткое описание"
                  rows="<?= intval(strlen($article->summary) / 200) ?>"><?= $article->summary; ?></textarea>
    </div>
    <div class="form-group">
        <label for="content">Контент</label><br>
        <textarea type="description" name="content" placeholder="Текст статьи" value=""
                  rows="<?= intval(strlen($article->content) / 200) ?>"><?= $article->content; ?></textarea>
    </div>
    <div class="form-group">

    </div>

    <div class="form-group">
        <label for="categoryId" style="padding-right: 10px;">Категория </label>
        <select name="categoryId" class="categoryId" subcategory_id="<?= $article->subcategoryId ?>">
            <?php foreach ($categories['results'] as $category) { ?>
                <option value="<?= $category->id ?>" <?= $article->categoryId == $category->id ? "selected" : "" ?>><?= $category->name ?></option>
            <?php } ?>
        </select>
        <select name="subcategoryId" class="subcategoryId">
        </select>
    </div>

    <div class="form-group">
        <label for="publicationDate" style="padding-right: 20px">Дата публикации</label>
        <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required=""
               maxlength="10" value="<?= $article->publicationDate ?>">
    </div>

    <div style="padding: 0px 20px 20px 0px">
        <label for="authors">Автор(-ы):</label>
        <br>
        <select name="authors[]" multiple size="4" style="width: 400px" class="authors">
            <?php foreach ($usernames['results'] as $username) { ?>
                <option value="<?= $username->id ?>"<?=in_array($username->id, $article->authors) ? "selected" : ""?>><?= $username->login ?></option>
            <?php } ?>
        </select>
    </div>

    <div style="padding-bottom: 20px">
        <?php $article?>
        <label for="access_id">Модификатор доступа</label>
        <select name="access_id">
            <option value=
                    "0" <?=$article->access_id == 0 ? "selected" : ""?>> Закрыт для просмотра
            </option>
            <option value=
                    "1" <?=$article->access_id == 1 ? "selected" : ""?>> Открыт для просмотра
            </option>
            <option value=
                    "2" <?=$article->access_id == 2 ? "selected" : ""?>> Открыт для редактирование / просмотра
            </option>
        </select>
    </div>
    <input name="id" value="<?=$article->id?>" hidden>
    <input type="submit" class="btn btn-primary" name="saveEditArticle" value="Сохранить" style="margin-right: 10px">
    <input type="submit" class="btn btn-danger" name="deleteArticle" value="Удалить" style="margin-right: 10px">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>
