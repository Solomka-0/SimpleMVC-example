<?php

namespace application\controllers;

use application\models\Article;
use application\models\Category;
use ItForFree\SimpleMVC\Config;

class CategoriesController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /**
     * @var Article Объект статьи
     */
    public $article = null;

    /**
     * @var Category Объект категории
     */
    public $category = null;

    /**
     * @var string Пусть к файлу макета
     */
    public $layoutPath = 'main.php';

    /**
     * Выводит на экран страницу со статьей
     */
    public function getAction() {
        $article_id =$_GET['id'];
        if (isset($article_id)) {
            $this->article = Config::getObject('core.article.class')->getById($article_id);
        }

        $this->view->addVar('article', $this->article); // передаём переменную по view
        $this->view->render('article/article.php'); // визуализация страницы
    }

    /**
     * Выводит сведения о категории
     */
    public function getCategoryAction() {
        $category_id =$_GET['id'];
        if (isset($category_id)) {
            $this->category = Config::getObject('core.category.class')->getById($category_id);
        }
        $this->view->addVar('category', $this->category); // передаём переменную по view
        $this->view->render('article/subcategory.php'); // визуализация страницы
    }
}