<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\AgreementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-agreement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) ?>

    <?= $form->field12md($model, 'is_required')->checkbox() ?>

    <?= $form->field12md($model, 'is_cancel')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
