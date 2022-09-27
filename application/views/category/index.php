<?php

use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>
<?php
include('includes/admin-categories-nav.php');
function cropText($text, $count = 80) {
    $result = strlen($text) > $count ? trim(mb_substr($text, 0, $count), " ") . "..." : $text;

    return $result;
}
?>

<h2>Список категорий</h2>
<?php if (!empty($categories)): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название категории</th>
            <th scope="col">Описание</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/adminCategories/index&id='
                        . $category->id . ">{$category->name}</a>") ?> </td>
                <td> <?= cropText($category->description) ?> </td>

                <td><?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/adminCategories/edit&id='
                        . $category->id) . ">" . "<img src='". \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/edit-pancil.png' ."' style='height: 20px;'>" ."</a></td>" ?>
                <td>
                    <form method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminCategories/edit") ?>">
                        <input name="id" value="<?=$category->id?>" hidden>
                        <input type="hidden" name="deleteCategory" value="Удалить" style="margin-right: 10px">
                        <button type="submit" style="background-color: rgba(0, 0, 0, 0); border-color: rgba(0,0,0,0)"><img src='<?=\ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/delete.png'?>' style='height: 20px;'></button>
                    </form>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

<?php else: ?>
    <p> Список заметок пуст</p>
<?php endif; ?>

