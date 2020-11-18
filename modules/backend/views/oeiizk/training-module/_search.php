<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingModuleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-training-module-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field12md($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subject')]) ?>

    <?= $form->field12md($model, 'date_start')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date Start')),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field12md($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date End')),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field12md($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'hours')->textInput(['placeholder' => $model->getAttributeLabel('hours')]) ?>

    <?php /* echo $form->field($model, 'training_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
