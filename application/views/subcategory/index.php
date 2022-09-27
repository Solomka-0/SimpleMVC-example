<?php

use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>
<?php
include('includes/admin-subcategories-nav.php');
function cropText($text, $count = 80) {
    $result = strlen($text) > $count ? trim(mb_substr($text, 0, $count), " ") . "..." : $text;

    return $result;
}
?>

<h2>Список категорий</h2>
<?php if (!empty($subcategories)): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название категории</th>
            <th scope="col">Описание</th>
            <th scope="col">Категория</th>
            <th scope="col" style="max-width: 20px"></th>
            <th scope="col" style="max-width: 20px"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($subcategories as $subcategory): ?>
            <tr>
                <td> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/adminSubcategories/index&id='
                        . $subcategory->id . ">{$subcategory->name}</a>") ?> </td>
                <td> <?= cropText($subcategory->description) ?> </td>
                <td> <?= Config::getObject('core.category.class')->getById($subcategory->category_id)->name ?> </td>

                <td><?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/adminSubcategories/edit&id='
                        . $subcategory->id) . ">" . "<img src='". \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/edit-pancil.png' ."' style='height: 20px;'>" ."</a></td>" ?>
                <td>
                    <form method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminSubcategories/edit") ?>">
                        <input name="id" value="<?=$subcategory->id?>" hidden>
                        <input type="hidden" name="deleteSubcategory" value="Удалить" style="margin-right: 10px">
                        <button type="submit" style="background-color: rgba(0, 0, 0, 0); border-color: rgba(0,0,0,0)"><img src='<?=\ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/delete.png'?>' style='height: 20px;'></button>
                    </form>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

<?php else: ?>
    <p> Список заметок пуст</p>
<?php endif; ?>

