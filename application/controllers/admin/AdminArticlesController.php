<?php

namespace application\controllers\admin;
use application\models\Article;
use application\models\ExampleUser;
use ItForFree\SimpleMVC\Config;

class AdminArticlesController  extends \ItForFree\SimpleMVC\mvc\Controller
{
    public $layoutPath = 'admin-main.php';

    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        ['allow' => true, 'roles' => ['admin']],
        ['allow' => false, 'roles' => ['?', '@']],
    ];

    /**
     * @var Article $editArticle редактируемая статья
     */
    public $editArticle = null;
    /**
     * Основное действие контроллера
     */
    public function indexAction()
    {
        $article_id = $_GET['id'] ?? null;

        if ($article_id) { // если указан конктреный пользователь
            $viewArticle = Config::getObject('core.article.class')->getById($_GET['id']);
            $this->view->addVar('viewArticle', $viewArticle);
            $this->view->render('article/view-item.php');

        } else { // выводим полный список

            $articles = Config::getObject('core.article.class')->getList()['results'];
            $this->view->addVar('articles', $articles);
            $this->view->render('article/index.php');
        }
    }

    /**
     * Создание новой статьи
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewArticle'])) {
                $article = new Article();
                $newArticle = $article->loadFromArray($_POST);
                $newArticle->insert();
                $this->redirect($Url::link("admin/adminArticles/index"));
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/adminArticles/index"));
            }
        } else {
            $this->view->addVar('adminArticleTitle', "Создание новой статьи");

            $this->view->render('article/add.php');
        }
    }

    /**
     * Редактирование статьи
     */
    public function editAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveEditArticle'])) {
                $article = new Article();
                $article = $article->loadFromArray($_POST);
                $article->update();
            }
            elseif(!empty($_POST['deleteArticle'])) {
                $article = new Article();
                $article->id = $_POST['id'];
                $article->delete();
            }
            $this->redirect($Url::link("admin/adminArticles/index"));
        } else {
            $id_param = $_GET['id'];
            if (isset($id_param)) {
                $this->editArticle = Config::getObject('core.article.class')->getById($id_param);
                $this->view->addVar('adminArticleTitle', "Редактор статей");
                $this->view->addVar('article', $this->editArticle);

                $this->view->render('article/edit.php');
            }
        }
    }

}