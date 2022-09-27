<?php

use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>
<?php
include('includes/admin-articles-nav.php');
function cropText($text, $count = 80) {
    $result = strlen($text) > $count ? trim(mb_substr($text, 0, $count), " ") . "..." : $text;

    return $result;
}
?>

<h2>Список статей</h2>
<?php if (!empty($articles)): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Оглавление</th>
            <th scope="col">Предисловие</th>
            <th scope="col">Категория</th>
            <th scope="col">Модификатор доступа</th>
            <th scope="col">Дата</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/adminArticles/index&id='
                        . $article->id . ">{$article->title}</a>") ?> </td>
                <td> <?= cropText($article->summary) ?> </td>
                <td><a href="<?= $article->category->link ?>"><?= $article->category->name ?></a></td>
                <td> <?= $article->access->description ?> </td>
                <td> <?= $article->publicationDate ?> </td>
                <td><?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/adminArticles/edit&id='
                        . $article->id) . ">" . "<img src='". \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/edit-pancil.png' ."' style='height: 20px;'>" ."</a></td>" ?>
                <td>
                    <form method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminArticles/edit") ?>">
                        <input name="id" value="<?=$article->id?>" hidden>
                        <input type="hidden" name="deleteArticle" value="Удалить" style="margin-right: 10px">
                        <button type="submit" style="background-color: rgba(0, 0, 0, 0); border-color: rgba(0,0,0,0)"><img src='<?=\ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/delete.png'?>' style='height: 20px;'></button>
                    </form>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

<?php else: ?>
    <p> Список заметок пуст</p>
<?php endif; ?>

