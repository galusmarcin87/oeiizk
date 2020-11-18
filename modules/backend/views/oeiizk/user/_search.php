<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('password')]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('first_name')]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('last_name')]) ?>

    <?php /* echo $form->field($model, 'role')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('role')]) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => $model->getAttributeLabel('status')]) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) */ ?>

    <?php /* echo $form->field($model, 'created_on')->textInput(['placeholder' => $model->getAttributeLabel('created_on')]) */ ?>

    <?php /* echo $form->field($model, 'last_login')->textInput(['placeholder' => $model->getAttributeLabel('last_login')]) */ ?>

    <?php /* echo $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('address')]) */ ?>

    <?php /* echo $form->field($model, 'postcode')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('postcode')]) */ ?>

    <?php /* echo $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Birthdate')),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) */ ?>

    <?php /* echo $form->field($model, 'auth_key')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('auth_key')]) */ ?>

    <?php /* echo $form->field($model, 'is_password_change_accepted')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'other_names')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('other_names')]) */ ?>

    <?php /* echo $form->field($model, 'gender')->textInput(['placeholder' => $model->getAttributeLabel('gender')]) */ ?>

    <?php /* echo $form->field($model, 'date_email_confirmation')->textInput(['placeholder' => $model->getAttributeLabel('date_email_confirmation')]) */ ?>

    <?php /* echo $form->field($model, 'birth_place')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('birth_place')]) */ ?>

    <?php /* echo $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('position')]) */ ?>

    <?php /* echo $form->field($model, 'educational_level')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('educational_level')]) */ ?>

    <?php /* echo $form->field($model, 'employment_card_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose File')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'date_card_verification')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date Card Verification')),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'date_card_submission')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date Card Submission')),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'academic_title')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('academic_title')]) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone')]) */ ?>

    <?php /* echo $form->field($model, 'is_special_account')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'credibility')->textInput(['placeholder' => $model->getAttributeLabel('credibility')]) */ ?>

    <?php /* echo $form->field($model, 'is_newsletter')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'comments')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'is_not_logged_account')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'training_preferences')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'training_preferences_keywords')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_preferences_keywords')]) */ ?>

    <?php /* echo $form->field($model, 'date_last_password_change')->textInput(['placeholder' => $model->getAttributeLabel('date_last_password_change')]) */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
