<?php
namespace app\controllers;

use yii\easyii\modules\bio\api\News;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class BioController extends \yii\web\Controller
{
    public function actionIndex($tag = null)
    {
        $news = News::last();
        $page = Page::get('bio');
        $years = News::items();

        Yii::$app->view->title = $news->seo('title', $news->seo('title') ? $news->seo('title') : $page->seo('title'));

        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode( $news->seo('title') ? $news->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode( $page->seo('keywords') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode( $news->seo('title') ? $news->seo('title') : $page->seo('title') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode( $news->seo('title') ? $news->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => count($news->photos) ? Url::base('http') . $news->photos[0]->image : '']);

        foreach ($years as $key => $year) if ($year->slug == $news->slug) $k = $key;

        return $this->render('view', [
            'news' => $news,
            'years' => $years,
            'k' => $k,
            'plugin' => News::plugin(),
        ]);
    }

    public function actionYear($slug)
    {
        $news = News::get($slug);

        $page = Page::get('bio');
        $years = News::items();

        Yii::$app->view->title = $news->seo('title', $news->seo('title') ? $news->seo('title') : $page->seo('title'));

        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode( $news->seo('title') ? $news->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode( $page->seo('keywords') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode( $news->seo('title') ? $news->seo('title') : $page->seo('title') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode( $news->seo('title') ? $news->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => count($news->photos) ? Url::base('http') . $news->photos[0]->image : '']);

        foreach ($years as $key => $year) if ($year->slug == $news->slug) $k = $key;

        return $this->render('view', [
            'news' => $news,
            'years' => $years,
            'k' => $k,
            'plugin' => News::plugin(),
        ]);
    }
}
