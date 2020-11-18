<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\PollQuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-poll-question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'type')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('type')]) ?>

    <?= $form->field12md($model, 'question')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'options_json')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'is_individual')->checkbox() ?>

    <?php /* echo $form->field12md($model, 'is_required')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
