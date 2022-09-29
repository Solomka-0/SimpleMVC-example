<?php

use application\assets\DemoJavascriptAsset;
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

DemoJavascriptAsset::add();
$user_id = $_SESSION['user']['id'] ?? null;
$user_login = $_SESSION['user']['userName'];
$User = Config::getObject('core.user.class');

?>

<style>
    .like[is-active="true"] {
        /*background: black;*/
        content: url("<?= \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/like_filled.png' ?>");
    }

    .like[is-active="false"] {
        /*height: 10px;*/
        /*width: 10px;*/
        content: url("<?= \ItForFree\SimpleAsset\SimpleAssetManager::$assetsPath . '/../images/like_empty.png' ?>");
    }

    img.like:hover ~ div.like-label {
        visibility: visible;
        position: absolute;
        color: white;
        margin-left: 94%;
        margin-top: -5%;
        background: grey;
        padding: 10px;
        border-radius: 8px;
    }

    img.like ~ div.like-label {
        visibility: hidden;
        position: absolute;

    }

</style>
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
        let url = "<?=\ItForFree\SimpleMVC\Url::link('ajax/like')?>";

        let user_role = "<?=$_SESSION['user']['role']?>";
        $('.like').click(function () {
            if (user_role != "guest") {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {article_id: this.parentElement.parentElement.id, user_id: <?=$user_id?>},
                    dataType: 'html',
                })
                let counterTag = this.parentElement.getElementsByClassName("likes-counter").item(0);
                let usersTag = this.parentElement.getElementsByClassName("like-label").item(0);
                let counterText = counterTag.textContent;
                if (this.getAttribute("is-active") == "true") {
                    usersTag.innerHTML = usersTag.innerHTML.replace("<?=$user_login?><br>", "");
                    if (usersTag.textContent.trim() == '') {
                        usersTag.setAttribute("hidden", "true");
                    }
                    counterTag.textContent = Number(counterText) - 1;
                    this.setAttribute("is-active", "false");
                } else {
                    usersTag.innerHTML = "<?=$user_login?><br>" + usersTag.textContent;
                    if (usersTag.textContent.trim() != '') {
                        usersTag.removeAttribute("hidden");
                    }
                    counterTag.textContent = Number(counterText) + 1;
                    this.setAttribute("is-active", "true");
                }
            }
        });
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
            <?php echo $paginationPanel ?>
            <br>
            <?php foreach ($articles['results'] as $index => $article) { ?>
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
                                <a href="<?= $article->subcategory->link ?>"
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
                    <?php $like_source = in_array($user_id, $article->likes) ?
                        'is-active=true'
                        : 'is-active=false';; ?>
                    <div>
                        <div class="likes-counter"
                             style="position: absolute; margin-left: 90%; margin-top: 10px"><?= count($article->likes) ?></div>
                        <img class="like" <?= $like_source ?>
                             style="height: 25px; z-index: <?= count($articles['results']) - $index + 1 ?>; margin: 10px; margin-left: 94% ">
                        <div class="like-label bg-dark" <?php
                        $result = '>';
                        $counter = 0;
                        foreach ($article->likes as $article_user_id) {
                            if ($counter < 8) {
                                $counter++;
                            } else {
                                $result .= "...";
                                break;
                            }
                            echo $article_user_id;
                            $result .= $User->getById($article_user_id)->login . "<br>";
                        }

                        $result = $counter == 0 ? 'hidden' . $result : $result;
                        echo $result;
                        ?>
                    </div>
            </div>
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
        <?php }
        ?>
        <br>
        <?php echo $paginationPanel ?>
        <a href="<?= Url::link('homepage/index&archive') ?>"
           style="padding: 10px 20px 20px 10px; align-self: start">Архив записей</a>
    </div>
</div>
</div>