<?php
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-subcategories-nav.php'); ?>

<h2><?= $viewSubcategory->name ?>
    <span>
        <?php
        $User->returnIfAllowed("admin/adminSubcategories/edit",
            "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/adminSubcategories/edit&id=". $viewSubcategory->id)
            . ">[Редактировать]</a>");?>
    </span>
</h2>
<p>Описание: <?= $viewSubcategory->description ?></p>