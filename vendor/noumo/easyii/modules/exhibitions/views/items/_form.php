<?php
use yii\easyii\helpers\Image;
use yii\easyii\widgets\DateTimePicker;
use yii\easyii\widgets\TagsInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;

$module = $this->context->module->id;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>

<?php if($this->context->module->settings['enableShort']) : ?>
    <?= $form->field($model, 'short') ?>
    <iframe width="600" height="350" src="https://player.vimeo.com/video/<?= $model->short ?>?byline=0&portrait=0" frameborder="0" allowfullscreen></iframe>
<?php endif; ?>

<?= $form->field($model, 'time')->widget(DateTimePicker::className()); ?>

<?php if($this->context->module->settings['enableTags']) : ?>
    <?= $form->field($model, 'tagNames')->widget(TagsInput::className()) ?>
<?php endif; ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
<?php endif; ?>

<?//= $form->field($model, 'text')->widget(Redactor::className(),[
    // 'options' => [
    //     'minHeight' => 200,
    //     'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'article'], true),
    //     'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => 'article'], true),
    //     'plugins' => ['fullscreen']
    // ]
//]) ?>

<?= SeoForm::widget(['model' => $model]) ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
