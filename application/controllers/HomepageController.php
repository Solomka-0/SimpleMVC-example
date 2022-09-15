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
        $this->articles = Config::getObject('core.article.class')->getList();

        $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
        $this->view->addVar('articles', $this->articles); // передаём переменную по view
        $this->view->render('homepage/index.php');
    }
}

