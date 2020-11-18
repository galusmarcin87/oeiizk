<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ChangePasswordForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Change password');
$this->params['breadcrumbs'][] = $this->title;

$agreements = \app\models\db\Agreement::find()->andWhere(['or', ['!=', 'is_cancel', 1], ['IS', 'is_cancel', null]])->all();

?>
<div class="container">
  <article class="main">
    <div class="register-block">

      <div class="row">
        <div class="col-md-12 col-lg-5">
          <div class="bg-white p-4">
            <h3 class="border-bottom border-primary-light pb-3 mb-3">Zmiana hasła</h3>

            <div class="article-form">
              <?php
              $form = ActiveForm::begin();

              ?>
              
              <?= $form->errorSummary($model); ?>

              <?= $form->field($model, 'oldPassword')->passwordInput(['autofocus' => true]) ?>

              <?= $form->field($model, 'password')->passwordInput() ?>
              <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>


              <? if ($model->user && $model->user->is_special_account): ?>
                <?=
                $form->field($model, 'is_password_change_accepted')->checkbox([
                    'template' => '<div class="">
                      <input type="checkbox" id="changepasswordform-is_password_change_accepted" name="ChangePasswordForm[is_password_change_accepted]" value="1">
                      {label}
                    </div>',
                ])

                ?>
              <? endif ?>

              <? if ($model->scenario == 'firstLogin'): ?>
                <? foreach ($agreements as $index => $agreement): ?>
                  <?=
                  $form->field($model, "acceptTerms[$agreement->id]")->checkbox([
                      'template' => '<div class="">
                        <input type="hidden" name="ChangePasswordForm[acceptTerms][' . $agreement->id . '] value="0"/>
                  <input type="checkbox" id="register-agree-' . $agreement->id . '" '
                      . 'name="ChangePasswordForm[acceptTerms][' . $agreement->id . ']" '
                      . (isset($model->acceptTerms[$agreement->id]) && $model->acceptTerms[$agreement->id] ? 'checked="checked"' : '') . ' value="1">
                  <label for="register-agree-' . $agreement->id . '">' . $agreement->text . ($agreement->is_required ? ' *' : '') . '</label>
                </div>',
                  ]);

                  ?>
                <? endforeach ?>
              <? endif ?>

              <div class="form-group">
                <div class="col-lg-12">
                  <?= Html::submitButton(Yii::t('app', 'Change password'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
              </div>

              <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</div>