<?php
use yii\easyii\modules\file\models\File;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$file_model = new File;
?>

<?php if (count($files) < 1) : ?>

<?php $form = ActiveForm::begin([
    'action' => ['/admin/file/a/create?item_id=' . $item_id],
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($file_model, 'title') ?>
<?= $form->field($file_model, 'file')->fileInput() ?>
<?php if(!$file_model->isNewRecord) : ?>
    <div><a href="<?= $file_model->file ?>" target="_blank"><?= basename($file_model->file) ?></a> (<?= Yii::$app->formatter->asShortSize($file_model->size, 2) ?>)</div>
    <br>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

<?php else : ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th width="100">Заголовок</th>
            <th width="150">Файл</th>
            <th width="50">Размер</th>
            <!-- <th width="30"><i class="glyphicon glyphicon-save-file"></i></th> -->
            <th width="80">Дата</th>
            <th width="80"></th>
        </tr>
    </thead>
    <tbody>
    <?//php foreach($files as $file) : ?>
    <?php $file = $files[0]; ?>
        <tr data-id="<?= $file->primaryKey ?>">
            <td><?= $file->title ?></td>
            <td style="overflow:hidden"><?= $file->file ?></td>
            <td><?= Yii::$app->formatter->asShortSize($file->size, 2) ?></td>
            <!-- <td><?//= $file->downloads ?></td> -->
            <td><?= Yii::$app->formatter->asDatetime($file->time, 'short') ?></td>
            <td class="control">
                  <div class="btn-group btn-group-sm" role="group">
                      <!-- <a href="/admin/file/a/up/<?//= $file->primaryKey ?>" class="btn btn-default move-up" title="Переместить выше"><span class="glyphicon glyphicon-arrow-up"></span></a> -->
                      <!-- <a href="/admin/file/a/down/<?//= $file->primaryKey ?>" class="btn btn-default move-down" title="Переместить ниже"><span class="glyphicon glyphicon-arrow-down"></span></a> -->
                      <a href="/admin/file/a/delete/<?= $file->primaryKey ?>" class="btn btn-default confirm-delete" title="Удалить запись"><span class="glyphicon glyphicon-remove"></span></a>
                  </div>
            </td>
        </tr>
    <?//php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
