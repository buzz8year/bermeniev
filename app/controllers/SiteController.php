<?php
namespace app\controllers;

use yii\easyii\modules\carousel\models\Carousel as CarouselModel;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\text\api\Text;
use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $page = Page::get('index');

        $bgs = CarouselModel::find()->status(CarouselModel::STATUS_ON)->sort()->all();

        Yii::$app->view->title = $page->seo('title');

        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Html::decode($page->seo('description'))]);
        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Html::decode($page->seo('keywords'))]);

        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => Html::decode($page->seo('title'))]);
        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => Html::decode($page->seo('description'))]);
        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Url::base('http') . $bgs[0]->image]);

        $js = "
            $('.header-logo').addClass('m');
            $('.navbar-nav, .header-pre, .header-post').addClass('animated fadeIn');
            setTimeout(function(){ $('.bg-body').addClass('fbg'); }, 1000);
            setTimeout(function(){ $('.bg-body').css({'-webkit-transition': '1s all'}).removeClass('fbg fsm'); }, 1500);
        ";

        Yii::$app->view->registerJs($js, yii\web\View::POS_READY);

        Yii::$app->view->registerCss('
            .bg-body {
              background-image: url(' . $bgs[0]->image . ');
              opacity: 0.2;
            }
            main {
              position: initial;
            }
            header {
              position: absolute; top: 50%; left: 0; width: 100%;
            }
            .header-strp, #navbar-menu .navbar-nav {
              display: none;
            }
            #navbar-menu .navbar-nav.animated {
              display: block;
            }
            #navbar-menu .navbar-nav li:nth-of-type(3):after {
              z-index: 100; background-color: #fff; height: 1px; margin-top: -1px;
            }
            #navbar-menu .navbar-nav li {
              border-top: 1px solid rgba(255,255,255,0.1);
            }
        ');

        return $this->render('index');
    }
}
