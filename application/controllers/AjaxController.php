<?php
namespace application\controllers;

/**
 * Можно использовать для обработки ajax-запросов.
 */
class AjaxController extends \ItForFree\SimpleMVC\mvc\Controller 
{
    /**
     * Подгрузка "лайков" статей или товаров
     */
    public function likeAction()
    {
        include($this->view->templateBasepath . 'ajax/like.php');
    }

    public function getSubcategoryAction() {
        include($this->view->templateBasepath . 'ajax/getSubcategory.php');
    }
}

