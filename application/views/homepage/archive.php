<?php

use application\assets\DemoJavascriptAsset;
use ItForFree\SimpleMVC\Url;

DemoJavascriptAsset::add();

?>
<script>
    $(document).ready(function () {
        $('div.article-header').click(function () {
            // console.log(this.attributes.href);
            document.location.href = this.attributes.href.value;
        });
        $('article>div.label').bind('click', function () {
            let lbl_text = this.parentElement.getElementsByClassName('label-text').item(0);
            if (lbl_text.hasAttribute('hidden')) {
                lbl_text.removeAttribute('hidden', 'hidden');
                this.getElementsByTagName('img').item(0).setAttribute("src", "<?= \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/navigate-up-arrow.png' ?>");
            } else {
                lbl_text.setAttribute('hidden', true);
                this.getElementsByTagName('img').item(0).setAttribute("src", "<?= \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/navigate-down-arrow.png' ?>");
            }
        })
    });
</script>
<br>
<div class="row">
    <div class="col"><h1 class="callAlert" style="margin-bottom: 30px"><?php echo $homepageTitle ?></h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <div style="display: flex; align-items: center;flex-direction: column; row-gap: 12px">
            <?php echo $paginationPanel?>
            <br>

            <?php foreach ($articles['results'] as $index=>$article) { ?>
                <div style="width: 100%; margin: -12px; z-index: <?= count($articles['results']) - $index ?>; display: flex; flex-direction: column">
                    <article
                            style="box-shadow: 0px 0px 5px grey; border-radius: 4px; z-index: <?= count($articles['results']) - $index + 1 ?>; "
                            id="<?= $article->id ?>">
                        <div style="padding-left: 10%; border-radius: 4px; padding: 12px; background: #343a40; display: flex;
                    flex-direction: column;font-family: 'sans-serif'" class="article-header" href="
                    <?= Url::link('article/get&id=' . $article->id) ?>">
                            <h2 style="align-self: start; padding-left: 20px; color: whitesmoke"><?= $article->title ?></h2>
                            <div style="display: flex; justify-content: space-between; padding-left: 10px; padding-right: 20px">
                                <div style="float: left; color: lightgoldenrodyellow">
                                    <a href="<?= $article->category->link ?>"
                                       style="color: lightgrey"><?= $article->category->name ?></a> ->
                                    <a href="<?=$article->subcategory->link?>"
                                       style="color: lightgrey"><?= $article->subcategory->name ?></a>
                                </div>
                                <div style="font-size: 14px; color: #ffffff"><?= $article->publicationDate ?></div>
                            </div>
                        </div>
                        <div style="margin: 1%; margin-bottom: 0; font-family: 'sans-serif'; font-size: 18px; padding: 10px; display: flex; justify-content: space-between">
                            <?= $article->summary ?>
                        </div>
                        <div class="label-text" hidden
                             style="font-family: 'sans-serif'; font-size: 18px; padding: 10px;"><?= $article->content ?></div>
                        <div class="label" state="close"
                             style="background: white; height: 20px; width: 40px; margin-left: auto; margin-right: auto;
                                     left: 0; margin-top: -8px; right: 0; z-index: <?= -$index + 1 ?>; position: absolute; text-align: center">
                            <img
                                    src="<?= \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '\..\images\navigate-down-arrow.png' ?>"
                                    style="height: 20px; z-index: <?= count($articles['results']) - $index + 3 ?>; margin-bottom: -4px">
                        </div>

                    </article>
                    <div>
                        <div
                                style="background: white; height: 20px; width: 40px; margin: auto; box-shadow: 0px 0px 5px grey; z-index: <?= count($articles['results']) - $index ?>; border-radius: 10px">
                        </div>
                    </div>
                </div>
            <?php } ?>
            <br>
            <?php echo $paginationPanel?>
            <a href="<?= Url::link('homepage/index') ?>" style="padding: 10px 20px 20px 10px; align-self: start">На главную</a>
        </div>
    </div>
</div>