<?php

namespace application\models;

use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

class Likes extends \ItForFree\SimpleMVC\mvc\Model
{
    /**
     * @var int $article_id id статьи
     */
    public $article_id = null;

    /**
     * @var int $user_id id пользователя
     */
    public $user_id = null;

    public function __construct($data = null)
    {
        $data = isset($data) ? array_merge($data, Config::get('core.likes.construct')) : Config::get('core.likes.construct');

        parent::__construct($data);
    }

    /**
     * @param type $route
     * @param type $elementHTML
     */
    public function returnIfAllowed($route, $elementHTML)
    {
        if ($this->isAllowed($route)) {
            echo $elementHTML;
        };
    }

    /**
     * @param string $article_id
     * @param string $user_id
     * Ставит / удаляет лайкнувшего пользователя
     */
    public function setLike($article_id, $user_id)
    {
        $tableName = !empty($tableName) ? $tableName : $this->tableName;

        $sql = "SELECT * FROM $tableName where article_id = :article_id AND user_id = :user_id;";
        $st = $this->pdo->prepare($sql);

        $st->bindValue(":article_id", $article_id, \PDO::PARAM_INT);
        $st->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
        $st->execute();
        if ($st->fetch()) {
            $sql = "DELETE FROM likes WHERE article_id = :article_id AND user_id = :user_id;";
        } else {
            $sql = "INSERT INTO likes (article_id, user_id) value (:article_id, :user_id);";
        }
        $st = $this->pdo->prepare($sql);
        $st->bindValue(":article_id", $article_id, \PDO::PARAM_INT);
        $st->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
        $st->execute();
    }
}