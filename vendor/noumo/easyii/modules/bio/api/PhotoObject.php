<?php
namespace yii\easyii\modules\bio\api;

use Yii;
use yii\easyii\components\API;
use yii\helpers\Html;
use yii\helpers\Url;

class PhotoObject extends \yii\easyii\components\ApiObject
{
    public $image;
    public $description;
    public $rel;

    public function box($width, $height, $rel = null){
        $img = Html::img($this->thumb($width, $height));
        $a = Html::a($img, $this->image, [
            'class' => 'easyii-box',
            'rel' => $rel ? $rel : 'bio-' . ($this->rel ? $this->rel : $this->model->item_id),
            'title' => $this->description
        ]);
        return LIVE_EDIT ? API::liveEdit($a, $this->editLink) : $a;
    }

    public function getEditLink(){
        return Url::to(['/admin/bio/a/photos', 'id' => $this->model->item_id]).'#photo-'.$this->id;
    }
}
