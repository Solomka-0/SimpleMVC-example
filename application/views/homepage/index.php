<?php

use application\assets\DemoJavascriptAsset;
use ItForFree\SimpleMVC\Config;

DemoJavascriptAsset::add();

?>
<br>
<div class="row">
    <div class="col"><h1 class="callAlert"><?php echo $homepageTitle ?></h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <div>
            <?php foreach ($articles['results'] as $article) { ?>
                <article style="box-shadow: 0px 0px 5px grey; border-radius: 4px">
                    <div style="padding-left: 10%; border-radius: 4px; padding: 12px; background: #343a40; display: flex; flex-direction: column;font-family: 'Abyssinica SIL'">
                        <h1 style="align-self: start; padding-left: 20px; color: whitesmoke"><?=$article->title?></h1>
                        <div style="display: flex; justify-content: space-between">
                            <div style="float: left; color: #ffffff">categoryId: <?=$article->categoryId?></div>
                            <div style="font-size: 12px; color: #ffffff"><?=$article->publicationDate?></div>
                        </div>
                    </div>
                    <div style="margin: 1%; font-family: 'Abyssinica SIL'; font-size: 14px; padding: 10px">
                        <?=$article->content?>
                    </div>
                </article>
            <?php }
            ?>
        </div>
    </div>
</div>