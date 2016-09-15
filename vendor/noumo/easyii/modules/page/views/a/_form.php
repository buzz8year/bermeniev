<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>
<br/>

<?//= $form->field($model, 'text')->widget(Redactor::className(),[
//     'options' => [
//         'minHeight' => 200,
//         'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
//         'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'pages']),
//         'plugins' => ['fullscreen']
//     ]
// ]) ?>



<?= Html::submitButton(Yii::t('easyii','Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
