<?php

namespace application\models;

use ItForFree\SimpleMVC\Config;

class Article extends \ItForFree\SimpleMVC\mvc\Model
{
    /**
     * @var \Date $publicationDate Дата публикации
     */
    public $publicationDate = null;

    /**
     * @var int $categoryId Id категории
     */
    public $categoryId = null;

    /**
     * @var String $title Заголовок статьи
     */
    public $title = null;

    /**
     * @var String $summary Предисловие
     */
    public $summary = null;

    /**
     * @var String $content Текст статьи
     */
    public $content = null;

    /**
     * @var String $subcategoryId Id подкатегории
     */
    public $subcategoryId = null;

    public function __construct($data = null)
    {
        $data = isset($data) ? array_merge($data, Config::get('core.article.construct')) : Config::get('core.article.construct');

        parent::__construct($data);
    }
}