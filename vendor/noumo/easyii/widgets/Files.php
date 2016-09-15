<?php
namespace yii\easyii\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\easyii\modules\file\models\File;
use yii\easyii\models\Photo;

class Files extends Widget
{
    public $model;

    public function init()
    {
        parent::init();

        if (empty($this->model)) {
            throw new InvalidConfigException('Required `model` param isn\'t set.');
        }
    }

    public function run()
    {
        $files = File::find()->where([
          'item_id' => $this->model->primaryKey
        ])->sort()->all();

        echo $this->render('files', [
            'files' => $files,
            'item_id' => $this->model->primaryKey
        ]);
    }

}
