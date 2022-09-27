<?php
/**
 * Конфигурационной файл приложения
 */
$config = [
    'core' => [ // подмассив используемый самим ядром фреймворка
        'db' => [
            'dns' => 'mysql:host=localhost;dbname=dbname',
            'username' => 'root',
            'password' => '1234'
        ],
        'router' => [ // подсистема маршрутизация
            'class' => \ItForFree\SimpleMVC\Router::class,
            'alias' => '@router'
        ],
        'url' => [
            'class' => \ItForFree\SimpleMVC\Url::class
        ],
        'mvc' => [ // настройки MVC
            'views' => [
                'base-template-path' => '../application/views/',
                'base-layouts-path' => '../application/views/layouts/',
                'footer-path' => '',
                'header-path' => ''
            ]
        ],
        'handlers' => [ // подсистема перехвата исключений
            'ItForFree\SimpleMVC\exceptions\SmvcAccessException'
            => \application\handlers\UserExceptionHandler::class,
            'ItForFree\SimpleMVC\exceptions\SmvcRoutingException'
            => \application\handlers\UserExceptionHandler::class
        ],
        'article' => [
            'class' => \application\models\Article::class,
            'construct' => [
                'tableName' => 'articles',
                'orderBy' => 'id',
            ],
        ],
        'category' => [
            'class' => \application\models\Category::class,
            'construct' => [
                'tableName' => 'categories',
                'orderBy' => 'id',
            ]
        ],
        'subcategory' => [
            'class' => \application\models\Subcategory::class,
            'construct' => [
                'tableName' => 'subcategories',
                'orderBy' => 'id',
            ]
        ],
        'access' => [
            'class' => \application\models\Access::class,
            'construct' => [
                'tableName' => 'access',
                'orderBy' => 'id',
            ]
        ],
        'user' => [ // подсистема авторизации
            'class' => \application\models\ExampleUser::class,
            'construct' => [
                'session' => '@session',
                'router' => '@router'
            ],
        ],
        'likes' => [ // подсистема авторизации
            'class' => \application\models\Likes::class,
            'construct' => [
                'tableName' => 'likes',
                'orderBy' => 'access_id',
            ],
        ],
        'session' => [ // подсистема работы с сессиями
            'class' => ItForFree\SimpleMVC\Session::class,
            'alias' => '@session'
        ]
    ]
];

return $config;