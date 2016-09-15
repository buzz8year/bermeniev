<?php
namespace yii\easyii\modules\feedback;

class FeedbackModule extends \yii\easyii\components\Module
{
    public $settings = [
        'mailAdminOnNewFeedback' => true,
        'subjectOnNewFeedback' => 'Новый отзыв/сообщение',
        'templateOnNewFeedback' => '@easyii/modules/feedback/mail/ru/new_feedback',

        'answerTemplate' => '@easyii/modules/feedback/mail/ru/answer',
        'answerSubject' => 'Ответ на Ваш отзыв/сообщение',
        'answerHeader' => 'Здравствуйте,',
        'answerFooter' => 'С наилучшими пожеланиями.',

        'enableTitle' => false,
        'enablePhone' => false,
        'enableCaptcha' => false,
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Feedback',
            'ru' => 'Обратная связь',
        ],
        'icon' => 'earphone',
        'order_num' => 60,
    ];
}
