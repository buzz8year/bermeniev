<?php
namespace app\controllers;

use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class GalleryController extends \yii\web\Controller
{
    public function actionIndex() {

        $page = Page::get('gallery');
        $cats = Gallery::cats();
        $photos = [];
        $ratio = [];
        $allwidth = 1;

        foreach($cats as $cat){
            $cata = Gallery::cat($cat->category_id);
            foreach($cata->photos() as $photo){
                $photos[] = $photo;
            }
        }

        Yii::$app->view->title = $page->seo('title');

        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode($page->seo('description'))]);
        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode($page->seo('keywords'))]);

        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode($page->seo('title'))]);
        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode($page->seo('description'))]);
        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Url::base('http') . $photos[0]->image]);

        Yii::$app->view->registerCss('
            .bg-body {
              background-image: url(' . $photos[0]->image . ');
            }
            .main-wrap.port-wrap {
              padding-top: 60px;
            }
            .cat-wrap a:first-of-type {
              margin-top: 60px;
            }
        ');

        if(count($photos)){
            $allwidth = 0;
            foreach($photos as $key => $photo){
                if($key < 4 && file_exists(Yii::getAlias('@webroot').$photo->image)){
                    $allwidth += getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1];
                    $ratio[$key] = getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1];
                }
            }
        }

        Gallery::plugin();
        if(count($photos) > 1) Gallery::slideshow();

        return $this->render('all', [
            'photos' => $photos,
            'years' => $cats,
            'allwidth' => $allwidth,
            'ratio' => $ratio,
        ]);
    }

    public function actionYear($slug) {

        $page = Page::get('gallery');
        $album = Gallery::cat($slug);
        $years = Gallery::cats();
        $photos = $album->photos();
        $allwidth = 1;
        $ratio = [];
        $k = 0;

        Yii::$app->view->title = $album->seo('title', $album->seo('title') ? $album->seo('title') : $page->seo('title') );

        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode( $album->seo('title') ? $album->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode( $page->seo('keywords') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode( $album->seo('title') ? $album->seo('title') : $page->seo('title') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode( $album->seo('title') ? $album->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Url::base('http') . $photos[0]->image]);

        if(count($photos)){

            $allwidth = 0;

            foreach($photos as $key => $photo){

                if($key < 4 && file_exists(Yii::getAlias('@webroot').$photo->image)){

                    $allwidth += getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1];

                    $ratio[$key] = getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1];
                }
            }
        }

        foreach ($years as $key => $year) if ($year->slug == $album->slug) $k = $key;

        Yii::$app->VIEW->registerCss('
            .bg-body {
              background-image: url(' . $photos[0]->image . ');
            }
            .main-wrap.port-wrap {
              padding-top: 60px;
            }
            .cat-wrap a:first-of-type {
              margin-top: 60px;
            }
        ');

        Gallery::plugin();
        if(count($photos) > 1) Gallery::slideshow();

        return $this->render('view', [
            'album' => $album,
            'photos' => $photos,
            'years' => $years,
            'k' => $k,
            'allwidth' => $allwidth,
            'ratio' => $ratio,
        ]);
    }

    public function actionAll() {
        return $this->actionIndex();
    }
}
