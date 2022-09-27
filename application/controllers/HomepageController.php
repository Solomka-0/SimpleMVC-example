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
        if (isset($_GET['archive'])) {
            $this->articles = Config::getObject('core.article.class')->getListByAccess();
            $this->view->addVar('homepageTitle', $this->archiveTitle); // передаём переменную по view
            $this->view->addVar('articles', $this->articles); // передаём переменную по view
            $this->view->render('homepage/archive.php');
        } else {
            $this->articles = Config::getObject('core.article.class')->getListByAccess($numRows = 5);
            $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
            $this->view->addVar('articles', $this->articles); // передаём переменную по view
            $this->view->render('homepage/index.php');
        }
    }
}

