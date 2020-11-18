<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\ModificationHistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-modification-history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'created_on')->textInput(['placeholder' => $model->getAttributeLabel('created_on')]) ?>

    <?= $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'model_class')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('model_class')]) ?>

    <?= $form->field($model, 'model_id')->textInput(['placeholder' => $model->getAttributeLabel('model_id')]) ?>

    <?php /* echo $form->field($model, 'previous_model')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'model')->textarea(['rows' => 6]) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
