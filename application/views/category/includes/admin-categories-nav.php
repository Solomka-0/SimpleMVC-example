<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');

?>

<ul class="nav">
    
    <?php  if ($User->isAllowed("admin/adminCategories/index")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/adminCategories/index") ?>">Список</a>
    </li>
    <?php endif; ?>
    
    <?php  if ($User->isAllowed("admin/adminCategories/add")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/adminCategories/add") ?>"> + Добавить категорию</a>
    </li>
    <?php endif; ?>  
</ul>