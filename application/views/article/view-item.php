<?php
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-articles-nav.php'); ?>

<h2><?= $viewArticle->title ?>
    <span>
        <?php
        $User->returnIfAllowed("admin/adminArticles/edit",
            "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/adminArticles/edit&id=". $viewArticle->id)
            . ">[Редактировать]</a>");?>
    </span>
</h2>
<p>Дата: <?= $viewArticle->publicationDate?></p>
<p>
    Автор(-ы):
    <?php
    $User = Config::getObject('core.user.class');
    if(isset($viewArticle->authors)) {
        $authors = array_map(function ($item) use ($User) {
            return $item ? $User->getById($item)->login : '';
        },$viewArticle->authors);
        $authors = implode(', ', $authors);
        print $authors == '' ? "---" : $authors;
    } else {
        print '---';
    }
    ?>
</p>
<p>Предисловие: <?= $viewArticle->summary ?></p>
<p>Категория (id): <?= $viewArticle->categoryId ?></p>
<p>Подкатегория (id): <?= $viewArticle->subcategoryId ?></p>
<p>Текст: <?= $viewArticle->content ?></p>