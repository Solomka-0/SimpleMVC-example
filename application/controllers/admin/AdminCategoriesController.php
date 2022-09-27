<?php

namespace application\controllers\admin;
use application\models\Article;
use application\models\Category;
use application\models\Subcategory;
use application\models\ExampleUser;
use ItForFree\SimpleMVC\Config;

class AdminCategoriesController  extends \ItForFree\SimpleMVC\mvc\Controller
{
    public $layoutPath = 'admin-main.php';

    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        ['allow' => true, 'roles' => ['admin']],
        ['allow' => false, 'roles' => ['?', '@']],
    ];

    /**
     * @var Category $editCategory редактируемая категория
     */
    public $editCategory = null;
    /**
     * Основное действие контроллера
     */
    public function indexAction()
    {
        $category_id = $_GET['id'] ?? null;

        if ($category_id) { // если указан конктреный пользователь
            $viewCategory = Config::getObject('core.category.class')->getById($_GET['id']);
            $this->view->addVar('viewCategory', $viewCategory);
            $this->view->render('category/view-item.php');

        } else { // выводим полный список

            $categories = Config::getObject('core.category.class')->getList()['results'];
            $this->view->addVar('categories', $categories);
            $this->view->render('category/index.php');
        }
    }

    /**
     * Создание новой категории
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewCategory'])) {
                $category = new Category();
                $newCategory = $category->loadFromArray($_POST);
                $newCategory->insert();
                $this->redirect($Url::link("admin/adminCategories/index"));
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/adminCategories/index"));
            }
        } else {
            $this->view->addVar('adminCategoryTitle', "Создание новой категории");

            $this->view->render('category/add.php');
        }
    }

    /**
     * Редактирование категории
     */
    public function editAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveEditCategory'])) {
                $category = new Category();
                $category = $category->loadFromArray($_POST);
                $category->update();
            }
            elseif(!empty($_POST['deleteCategory'])) {
                $category = new Category();
                $category->id = $_POST['id'];
                $category->delete();
            }
            $this->redirect($Url::link("admin/adminCategories/index"));
        } else {
            $id_param = $_GET['id'];
            if (isset($id_param)) {
                $this->editCategory = Config::getObject('core.category.class')->getById($id_param);
                $this->view->addVar('adminCategoryTitle', "Редактирование");
                $this->view->addVar('category', $this->editCategory);

                $this->view->render('category/edit.php');
            }
        }
    }

}