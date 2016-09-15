<?php

namespace app\controllers;

use yii\easyii\modules\exhibitions\api\Article;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class ExhibitionsController extends \yii\web\Controller
{
    public function actionIndex()
    {
      $article = Article::last();
      $cat = Article::cat($article->category_id);
      $items = $cat->items();

      $page = Page::get('exhibitions');

      Yii::$app->view->title = $cat->seo('title', $cat->seo('title') ? $cat->seo('title') : $page->seo('title'));

      Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode( $cat->seo('title') ? $cat->seo('description') : $page->seo('description') )]);

      Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode( $page->seo('keywords') )]);

      Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode( $cat->seo('title') ? $cat->seo('title') : $page->seo('title') )]);

      Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode( $cat->seo('title') ? $cat->seo('description') : $page->seo('description') )]);

      Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Url::base('http') . $items[0]->photos[0]->image]);

      Yii::$app->view->registerCss('.bg-body { background-image: url(' . (count($items[0]->photos) ? $items[0]->photos[0]->image : '') . '); }');

      return $this->render('cat', [
          'cat' => $cat,
          'items' => $items,
          'years' => Article::cats(),
          'plugin' => Article::plugin(),
      ]);
    }

    public function actionYear($slug, $tag = null)
    {
        $cat = Article::cat($slug);
        $items = $cat->items();

        $page = Page::get('exhibitions');

        Yii::$app->view->title = $cat->seo('title', $cat->seo('title') ? $cat->seo('title') : $page->seo('title'));

        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode( $cat->seo('title') ? $cat->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode( $page->seo('keywords') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode( $cat->seo('title') ? $cat->seo('title') : $page->seo('title') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode( $cat->seo('title') ? $cat->seo('description') : $page->seo('description') )]);

        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Url::base('http') . $items[0]->photos[0]->image]);

        Yii::$app->view->registerCss('.bg-body { background-image: url(' . (count($items[0]->photos) ? $items[0]->photos[0]->image : '') . '); }');

        return $this->render('cat', [
            'cat' => $cat,
            'items' => $cat->items(['tags' => $tag]),
            'years' => Article::cats(),
            'plugin' => Article::plugin(),
        ]);
    }

    public function actionView($slug)
    {
        $article = Article::get($slug);
        $cat = $article->category_id;
        if(!$article){
            throw new \yii\web\NotFoundHttpException('Article not found.');
        }

        return $this->render('view', [
            'article' => $article,
            'cat' => $cat,
            'items' => Article::cat($cat)->items(),
        ]);
    }

}
