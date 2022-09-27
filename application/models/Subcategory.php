<?php

namespace application\models;

use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;
use PDO;

class Subcategory extends \ItForFree\SimpleMVC\mvc\Model
{
    /**
     * @var String $name Название подкатегории
     */
    public $name = null;

    /**
     * @var String $description описание подкатегории
     */
    public $description = null;

    /**
     * @var int $category_id id подкатегории
     */
    public $category_id = null;

    /**
     * @param String $link ссылка на подкатегорию
     */
    public $link = null;

    public function __construct($data = null)
    {
        $data = isset($data) ? array_merge($data, Config::get('core.subcategory.construct')) : Config::get('core.subcategory.construct');

        parent::__construct($data);

        $this->link = Url::link('article/getSubcategory&id='. $this->id);
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
     * Получает из БД все объекты подкатегории по id категории
     * Возвращает объект класса модели.
     *
     * @param int    $id         id строки (кортежа)
     * @param string $tableName  имя таблицы (необязатлеьный параметр)
     *
     * @return array
     */
    public function getListByCategoryId($category_id) {
        $tableName = !empty($tableName) ? $tableName : $this->tableName;

        $sql = "SELECT * FROM $tableName where category_id = :category_id";
        $modelClassName = static::class;

        $st = $this->pdo->prepare($sql);

        $st->bindValue(":category_id", $category_id, \PDO::PARAM_INT);
        $st->execute();
        $rows = $st->fetchAll(mode: PDO::FETCH_CLASS);

        $result = [];
        if ($rows) {
            foreach ($rows as $row) {
                $result[] = new $modelClassName((array)$row);
            }
            return $result;
        } else {
            return null;
        }
    }

    /**
     * @return void
     * Добавляет новую подкатегорию в БД
     */
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (name, description, category_id) 
            VALUES (:name, :description, :category_id)";
        $st = $this->pdo->prepare ($sql);
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR);
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":category_id", $this->category_id, \PDO::PARAM_STR );
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
                 description=:description,
                 category_id=:category_id
             WHERE id = :id";
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":category_id", $this->category_id, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
}