<?php
namespace yii\easyii\modules\bio;

class NewsModule extends \yii\easyii\components\Module
{
    public $settings = [
        'enableThumb' => true,
        'enablePhotos' => true,
        'enableShort' => true,
        'shortMaxLength' => 256,
        'enableTags' => true
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Bio',
            'ru' => 'Биография',
        ],
        'icon' => 'bullhorn',
        'order_num' => 70,
    ];
}
