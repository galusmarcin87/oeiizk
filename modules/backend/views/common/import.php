<?
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
?>

<h1><?=$importClass?> Import</h1>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => 'import']); ?>

<?= $form->field($modelImport, 'fileImport')->fileInput() ?>

<?= Html::submitButton('Import', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end(); ?>