<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//vpre($User->explainAccess("admin/adminusers/index"));
?>

<ul class="nav">
    
    <?php  if ($User->isAllowed("admin/notes/index")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/adminArticles/index") ?>">Список</a>
    </li>
    <?php endif; ?>
    
    <?php  if ($User->isAllowed("admin/notes/add")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/adminArticles/add") ?>"> + Добавить статью</a>
    </li>
    <?php endif; ?>  
</ul>