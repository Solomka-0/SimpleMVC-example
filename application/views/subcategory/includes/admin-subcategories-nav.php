<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');

?>

<ul class="nav">
    
    <?php  if ($User->isAllowed("admin/adminSubcategories/index")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/adminSubcategories/index") ?>">Список</a>
    </li>
    <?php endif; ?>
    
    <?php  if ($User->isAllowed("admin/adminSubcategories/add")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/adminSubcategories/add") ?>"> + Добавить подкатегорию</a>
    </li>
    <?php endif; ?>  
</ul>