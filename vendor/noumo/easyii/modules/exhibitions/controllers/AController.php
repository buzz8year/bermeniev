<?php
namespace yii\easyii\modules\exhibitions\controllers;

use yii\easyii\components\CategoryController;

class AController extends CategoryController
{
    /** @var string  */
    public $categoryClass = 'yii\easyii\modules\exhibitions\models\Category';

    /** @var string  */
    public $moduleName = 'exhibitions';
}
