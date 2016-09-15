<?php
$this->title = Yii::t('easyii/exhibitions', 'Create exhibition');
?>
<?= $this->render('_menu', ['category' => $category]) ?>
<?= $this->render('_form', ['model' => $model]) ?>