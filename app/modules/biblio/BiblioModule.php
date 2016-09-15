<?php
namespace app\modules\biblio;

class BiblioModule extends \yii\easyii\components\Module
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
            'en' => 'Biblio',
            'ru' => 'Книги',
        ],
        'icon' => 'bullhorn',
        'order_num' => 70,
    ];
}
