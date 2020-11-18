<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\NewsletterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-newsletter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'header')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'footer')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'add_incoming_training_info')->checkbox() ?>

    <?php /* echo $form->field12md($model, 'status')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('status')]) */ ?>

    <?php /* echo $form->field($model, 'group_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Group::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Group')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field12md($model, 'keywords')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'date_sent')->textInput(['placeholder' => $model->getAttributeLabel('date_sent')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_required_answer')->checkbox() */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
