<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingParticipant */
/* @var $form app\components\mgcms\yii\ActiveForm */

?>

<div class="training-participant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field12md($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="row">
    <?= $form->field6md($model, 'training_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field6md($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field6md($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) ?>

    <?= $form->field6md($model, 'surname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('surname')]) ?>

    <?= $form->field6md($model, 'workplace')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('workplace')]) ?>

    <?= $form->field6md($model, 'status')->dropdownFromSettings('uczestnik - status') ?>

    <?= $form->field3md($model, 'is_reserve')->switchInput() ?>

    <?= $form->field3md($model, 'is_paid')->switchInput() ?>

    <?= $form->field3md($model, 'paid_missing')->textInput(['placeholder' => $model->getAttributeLabel('paid_missing')]) ?>

    <?= $form->field3md($model, 'is_passed')->switchInput() ?>

    <?= $form->field3md($model, 'is_print_certificate')->switchInput() ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
