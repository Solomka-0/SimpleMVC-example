<?php

use ItForFree\SimpleMVC\Config;

?>
<br>
<div class="row">
    <div class="col">
        <article style="box-shadow: 0px 0px 5px grey; border-radius: 8px">
            <div style="padding-left: 10%; border-radius: 8px 8px 4px 4px; padding: 12px; background: #343a40; display: flex;
                    flex-direction: column;font-family: 'sans-serif'" class="article-header">
                <h2 style="align-self: start; padding-left: 20px; color: whitesmoke"><?= $article->title ?></h2>
                <div style="display: flex; justify-content: space-between; padding-left: 10px; padding-right: 20px">
                    <div style="float: left; color: lightgoldenrodyellow">
                        <a href="<?= $article->category->link ?>"
                           style="color: lightgrey"><?= $article->category->name ?></a> ->
                        <a href="" style="color: lightgrey">subcategoryId: <?= $article->subcategoryId ?></a>
                    </div>
                    <div style="font-size: 14px; color: #ffffff"><?= $article->publicationDate ?></div>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; justify-content: end; padding: 4px; padding-right: 10px;">
                <div style="color: grey; padding-right: 10px;">Под редакторством:</div>
                <div style="color: dimgrey;">
                    <?php
                    $User = Config::getObject('core.user.class');
                    if(isset($article->authors)) {
                        $authors = array_map(function ($item) use ($User) {
                            return $item ? $User->getById($item)->login : '';
                        },$article->authors);
                        $authors = implode(', ', $authors);
                        print $authors == '' ? "---" : $authors;
                    } else {
                        print '---';
                    }
                    ?>
                </div>
            </div>
            <div style="padding: 0px 10px 10px 10px">
                <p style="padding-left: 20px; font-size: 18px; margin-bottom: 6px; font-style: italic"><?= $article->summary ?></p>
                <hr style="margin: 0; margin-bottom: 8px">
                <p style="padding-left: 10px; text-indent: 2em; padding-right: 2%; font-size: 20px;"><?= $article->content ?></p>
            </div>
        </article>
    </div>
</div>