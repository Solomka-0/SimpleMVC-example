<?php

namespace application\models;

use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

class Category extends \ItForFree\SimpleMVC\mvc\Model
{
    /**
     * @var String $name Название категории
     */
    public $name = null;

    /**
     * @var String $description описание категории
     */
    public $description = null;

    /**
     * @param String $link ссылка на категорию
     */
    public $link = null;

    public function __construct($data = null)
    {
        $data = isset($data) ? array_merge($data, Config::get('core.category.construct')) : Config::get('core.category.construct');

        parent::__construct($data);

        $this->link = Url::link('article/getCategory&id='. $this->id);
    }

    /**
     * @param type $route
     * @param type $elementHTML
     */
    public function returnIfAllowed($route, $elementHTML)
    {
        if($this->isAllowed($route)) {
            echo $elementHTML;
        };
    }

    /**
     * @return void
     * Добавляет новую категорию в БД
     */
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (name, description) 
            VALUES (:name, :description)";
        $st = $this->pdo->prepare ($sql);
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR);
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->execute();

        $this->id = $this->pdo->lastInsertId();
    }

    /**
     * @return void
     * Обновляет поле в БД
     */
    public function update()
    {
        $sql = "UPDATE $this->tableName SET 
                 name=:name, 
                 description=:description
             WHERE id = :id";
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
}