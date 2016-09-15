<?php
namespace yii\easyii\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

use yii\easyii\assets\FancyboxAsset;

class Slideshow extends Widget
{
    public $options = [];
    public $selector;

    public function init()
    {
        parent::init();

        if (empty($this->selector)) {
            throw new InvalidConfigException('Required `selector` param isn\'t set.');
        }
    }

    public function run()
    {
        $clientOptions = (count($this->options)) ? Json::encode($this->options) : '';

        $this->view->registerAssetBundle(FancyboxAsset::className());
        $this->view->registerJs('$("'.$this->selector.'").fancybox({
      		helpers: {
        			thumbs: {
          				width: 50,
          				height: 50
        			}
      		},
          autoPlay: true,
          afterShow: function () {
              $(".fancybox-wrap").on("mouseover", function () {
                  $.fancybox.play(false);
              }).on("mouseleave", function () {
                  $.fancybox.play(true);
              });

              $(".fancybox-nav").on("click", function () {
                  $.fancybox.play(true);
              });
          }
        });');
    }
}
