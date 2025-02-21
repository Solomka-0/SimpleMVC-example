
<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//ppre($User->explainAccess("admin/adminusers/index"));

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Меню оформленное с помощью  twitter bootstrap -->
 <a class="navbar-brand" href="/" title="aka Самый Лучший Сайт ;)">SimpleMVC</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="/">Главная</a>
        </li>
        <?php  if ($User->isAllowed("login/login")): ?>
        <li class="nav-item ">
            <a class="nav-link" href="<?= Url::link("login/login") ?>">[Вход]</a>
        </li>
        <?php endif; ?>
        <?php  if ($User->isAllowed("admin/adminusers/index")): ?>
        <li class="nav-item ">
            <a class="nav-link" href="<?= Url::link("admin/adminusers/index") ?>"> Пользователи </a>
        </li>
        <?php endif; ?>

        <?php  if ($User->isAllowed("admin/adminArticles/index")): ?>
            <li class="nav-item ">
                <a class="nav-link" href="<?= Url::link("admin/adminArticles/index") ?>"> Статьи </a>
            </li>
        <?php endif; ?>

        <?php  if ($User->isAllowed("admin/adminCategories/index")): ?>
            <li class="nav-item ">
                <a class="nav-link" href="<?= Url::link("admin/adminCategories/index") ?>"> Категории </a>
            </li>
        <?php endif; ?>

        <?php  if ($User->isAllowed("admin/adminSubcategories/index")): ?>
            <li class="nav-item ">
                <a class="nav-link" href="<?= Url::link("admin/adminSubcategories/index") ?>"> Подкатегории </a>
            </li>
        <?php endif; ?>

        <?php  if ($User->isAllowed("admin/adminusers/index")): ?>
        <li class="nav-item ">
            <a class="nav-link" href="<?= Url::link("admin/notes/index") ?>"> Заметки </a>
        </li>
        <?php endif; ?>
        
        <?php  if ($User->isAllowed("login/logout")): ?>
        <li class="nav-item ">
            <a class="nav-link" href="<?= Url::link("login/logout") ?>">Выход (<?= $User->userName ?>)</a>
        </li>
        <?php endif; ?>
    </ul>
   </div>
</nav>

