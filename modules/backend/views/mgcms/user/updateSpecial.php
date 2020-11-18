<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */
/* @var $form app\components\mgcms\yii\ActiveForm */



$this->title = Yii::t('app', 'Update User') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model); ?>

        <? if (\app\components\mgcms\OeiizkHelpers::isRole(app\models\mgcms\db\User::ROLE_LECTOR)): ?>
          <div class="row">
              <div class="col-md-4">
                  <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username'), 'disabled' => true]) ?>
              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>
              </div>
          </div>

        <? else: ?>

          <div class="row">
              <div class="col-md-4">
                  <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('first_name')]) ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('last_name')]) ?>

              </div>

              <div class="col-md-4">
                  <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'birthdate')->datePicker(); ?>
              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'other_names')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('other_names')]) ?>

              </div>
              <div class="col-md-4">
                  <?=
                  $form->field($model, 'gender')->dropDownList(MgHelpers::arrayTranslateValues(\app\models\mgcms\db\User::GENDERS),
                      ['maxlength' => true, 'prompt' => ''])

                  ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('birth_place')]) ?>

              </div>


              <div class="col-md-8">
                  <div class="form-group field-user-employmentCard">
                      <label class="control-label" for="user-employmentCard">Karta zatrudnienia</label>
                      <div>
                          <? if ($model->employmentCard): ?>
                            <?= $model->employmentCard->link ?>
                          <? endif ?>
                          <br/><br/>
                      </div>
                      <div class="help-block"></div>
                  </div>
              </div>


              <div class="col-md-4">
                  <?= $form->field($model, 'date_card_verification')->datePicker() ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'academic_title')->dropdownFromSettings('tytuły naukowe') ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone')]) ?>

              </div>


              <div class="col-md-4">
                  <?= $form->field($model, 'create_account_additional_data')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('create_account_additional_data')]) ?>

              </div>
              <div class="col-md-4">
                  <?= $form->field($model, 'training_preferences_keywords')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_preferences_keywords')]) ?>

              </div>
              <div class="col-md-6">
                  <?= $form->field($model, 'comments')->textarea() ?>

              </div>

              <div class="col-md-6">
                  <?= $form->field($model, 'training_preferences')->textarea() ?>

              </div>



          </div>

        <? endif ?>


        <div class="form-group">
            <?=
            Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

            ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
