<?php
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-categories-nav.php'); ?>

<h2><?= $viewCategory->name ?>
    <span>
        <?php
        $User->returnIfAllowed("admin/adminCategories/edit",
            "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/adminCategories/edit&id=". $viewCategory->id)
            . ">[Редактировать]</a>");?>
    </span>
</h2>
<p>Предисловие: <?= $viewCategory->description ?></p>