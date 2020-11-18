<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subtitle')]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code')]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('link')]) ?>

    <?php /* echo $form->field($model, 'link_to_registration')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('link_to_registration')]) */ ?>

    <?php /* echo $form->field($model, 'date_from')->textInput(['placeholder' => $model->getAttributeLabel('date_from')]) */ ?>

    <?php /* echo $form->field($model, 'date_to')->textInput(['placeholder' => $model->getAttributeLabel('date_to')]) */ ?>

    <?php /* echo $form->field($model, 'file_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose File')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'promoted_oeiizk')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'promoted_pos')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'coments')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'type')->textInput(['placeholder' => $model->getAttributeLabel('type')]) */ ?>

    <?php /* echo $form->field($model, 'is_display_on_screen')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
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
