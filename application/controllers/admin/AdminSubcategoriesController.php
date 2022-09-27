<?php

namespace application\controllers\admin;
use application\models\Article;
use application\models\Category;
use application\models\ExampleUser;
use application\models\Subcategory;
use ItForFree\SimpleMVC\Config;

class AdminSubcategoriesController  extends \ItForFree\SimpleMVC\mvc\Controller
{
    public $layoutPath = 'admin-main.php';

    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        ['allow' => true, 'roles' => ['admin']],
        ['allow' => false, 'roles' => ['?', '@']],
    ];

    /**
     * @var Subcategory $editSubcategory редактируемая подкатегория
     */
    public $editSubcategory = null;
    /**
     * Основное действие контроллера
     */
    public function indexAction()
    {
        $subcategory_id = $_GET['id'] ?? null;

        if ($subcategory_id) { // если указан конктреный пользователь
            $viewSubcategory = Config::getObject('core.subcategory.class')->getById($_GET['id']);
            $this->view->addVar('viewSubcategory', $viewSubcategory);
            $this->view->render('subcategory/view-item.php');

        } else { // выводим полный список

            $subcategories = Config::getObject('core.subcategory.class')->getList()['results'];
            $this->view->addVar('subcategories', $subcategories);
            $this->view->render('subcategory/index.php');
        }
    }

    /**
     * Создание новой категории
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewSubcategory'])) {
                $subcategory = new Subcategory();
                $newSubcategory = $subcategory->loadFromArray($_POST);
                $newSubcategory->insert();
                $this->redirect($Url::link("admin/adminSubcategories/index"));
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/adminSubcategories/index"));
            }
        } else {
            $this->view->addVar('adminSubcategoryTitle', "Создание новой категории");

            $this->view->render('subcategory/add.php');
        }
    }

    /**
     * Редактирование подкатегории
     */
    public function editAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveEditSubcategory'])) {
                $subcategory = new Subcategory();
                $subcategory = $subcategory->loadFromArray($_POST);
                $subcategory->update();
            }
            elseif(!empty($_POST['deleteSubcategory'])) {
                $subcategory = new Subcategory();
                $subcategory->id = $_POST['id'];
                $subcategory->delete();
            }
            $this->redirect($Url::link("admin/adminSubcategories/index"));
        } else {
            $id_param = $_GET['id'];
            if (isset($id_param)) {
                $this->editSubcategory = Config::getObject('core.subcategory.class')->getById($id_param);
                $this->view->addVar('adminSubcategoryTitle', "Редактирование");
                $this->view->addVar('subcategory', $this->editSubcategory);

                $this->view->render('subcategory/edit.php');
            }
        }
    }

}