<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\InstitutionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-institution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('short_name')]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code')]) ?>

    <?= $form->field($model, 'created_on')->textInput(['placeholder' => $model->getAttributeLabel('created_on')]) ?>

    <?php /* echo $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'patron')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('patron')]) */ ?>

    <?php /* echo $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) */ ?>

    <?php /* echo $form->field($model, 'community')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('community')]) */ ?>

    <?php /* echo $form->field($model, 'county')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('county')]) */ ?>

    <?php /* echo $form->field($model, 'province')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('province')]) */ ?>

    <?php /* echo $form->field($model, 'street')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('street')]) */ ?>

    <?php /* echo $form->field($model, 'house_no')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('house_no')]) */ ?>

    <?php /* echo $form->field($model, 'postcode')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('postcode')]) */ ?>

    <?php /* echo $form->field($model, 'post')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('post')]) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone')]) */ ?>

    <?php /* echo $form->field($model, 'www')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('www')]) */ ?>

    <?php /* echo $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('type')]) */ ?>

    <?php /* echo $form->field($model, 'is_verified')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'territory')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('territory')]) */ ?>

    <?php /* echo $form->field($model, 'school_group_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('school_group_name')]) */ ?>

    <?php /* echo $form->field($model, 'delegacy')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('delegacy')]) */ ?>

    <?php /* echo $form->field($model, 'NIP')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('NIP')]) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) */ ?>

    <?php /* echo $form->field($model, 'school_governing_body')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('school_governing_body')]) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
