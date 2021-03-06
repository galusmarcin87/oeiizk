<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\ModificationHistory */
/* @var $form app\components\mgcms\yii\ActiveForm */

?>

<div class="modification-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

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

    <?= $form->field($model, 'previous_model')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'model')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
