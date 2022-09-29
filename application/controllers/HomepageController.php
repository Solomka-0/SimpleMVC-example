<?php

namespace application\controllers;

use application\models\Article;
use ItForFree\SimpleMVC\Config;

/**
 * Контроллер для домашней страницы
 */
class HomepageController extends \ItForFree\SimpleMVC\mvc\Controller
{

    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Статьи";

    /**
     * @var string Название страницы архива
     */
    public $archiveTitle = "Архив статей";

    /**
     * @var array Список статей
     */
    public $articles = [];
    
    /**
     * @var string Пусть к файлу макета 
     */
    public $layoutPath = 'main.php';
      
    /**
     * Выводит на экран страницу отображает главную страницу
     */
    public function indexAction()
    {
        $currentRole = Config::getObject('core.user.class');
        $page = $_GET['page'] ?? "1";
        include($this->view->templateBasepath . 'homepage/includes/paginationPanel.php');
        $Article = Config::getObject('core.article.class');
        $count = $Article->getCount();
        if (isset($_GET['archive'])) {
            $offset = 8;
            $paginationPanel = paginationPanel($count, $offset, $page);
            $this->articles = $Article->getListByAccess($numRows = $offset, ($page - 1) * $offset);
            $this->view->addVar('homepageTitle', $this->archiveTitle); // передаём переменную по view
            $this->view->addVar('articles', $this->articles); // передаём переменную по view
            $this->view->addVar('paginationPanel', $paginationPanel); // передаём переменную по view
            $this->view->render('homepage/archive.php');
        } else {
            $offset = 5;
            $paginationPanel = paginationPanel($count, $offset ,$page);
            $this->articles = $Article->getListByAccess($numRows = $offset, ($page - 1) * $offset);
            $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
            $this->view->addVar('articles', $this->articles); // передаём переменную по view
            $this->view->addVar('paginationPanel', $paginationPanel); // передаём переменную по view
            $this->view->render('homepage/index.php');
        }
    }
}

