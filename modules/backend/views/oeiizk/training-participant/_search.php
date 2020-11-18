<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingParticipantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-training-participant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field12md($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'training_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field12md($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) ?>

    <?= $form->field12md($model, 'surname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('surname')]) ?>

    <?php /* echo $form->field12md($model, 'workplace')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('workplace')]) */ ?>

    <?php /* echo $form->field12md($model, 'status')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('status')]) */ ?>

    <?php /* echo $form->field12md($model, 'created_on')->textInput(['placeholder' => $model->getAttributeLabel('created_on')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_reserve')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'is_paid')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'paid_missing')->textInput(['placeholder' => $model->getAttributeLabel('paid_missing')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_passed')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'is_print_certificate')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
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
