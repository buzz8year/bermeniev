<?php
use yii\easyii\helpers\Image;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-gallery');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;

header('/gallery/view/2016');
?>

<div class="cat-wrap"></div>
<div class="main-wrap">
<?php foreach(array_reverse(Gallery::cats()) as $album) : ?>
    <a class="center-block" href="<?= Url::to(['gallery/view', 'slug' => $album->slug]) ?>">
        <?= $album->title ?>
    </a>
    <br/>
<?php endforeach; ?>
</div>
