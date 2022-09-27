<?php

use ItForFree\SimpleMVC\Config;

$article_id =  $_POST['article_id'];
$user_id =  $_POST['user_id'];

Config::getObject('core.likes.class')->setLike($article_id, $user_id);

