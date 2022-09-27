<?php

namespace application\models;

use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

class Access extends \ItForFree\SimpleMVC\mvc\Model
{
    /**
     * @var String $name Наименование модификатора доступа
     */
    public $name = null;

    /**
     * @var String $description Описание модификатора доступа
     */
    public $description = null;

    public function __construct($data = null)
    {
        $data = isset($data) ? array_merge($data, Config::get('core.access.construct')) : Config::get('core.access.construct');

        parent::__construct($data);
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
}