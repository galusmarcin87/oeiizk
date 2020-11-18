<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

$this->title = 'Logowanie/rejestracja';


$agreements = \app\models\db\Agreement::find()->andWhere(['or', ['!=', 'is_cancel', 1], ['IS', 'is_cancel', null]])->all();

?>

<div class="container">
  <article class="main">
    <div class="register-block">

      <div class="row">
        <div class="col-md-12 col-lg-5">
          <div class="bg-white p-4">
           <h3 class="border-bottom border-primary-light pb-3 mb-3">Zakładanie konta</h3>

            <?php
            $form = ActiveForm::begin([
                    'id' => 'register-form',
//                    'layout' => 'horizontal',
                    'options' => [
                        'class' => 'register-form form-light'
                    ],
                    'fieldConfig' => [
                    ],
            ]);

            ?>
            <?= $form->errorSummary($modelRegister); ?>

            <?= $form->field($modelRegister, 'first_name')->textInput() ?>

            <?= $form->field($modelRegister, 'last_name')->textInput() ?>

            <?= $form->field($modelRegister, 'username')->textInput() ?>

            <?= $form->field($modelRegister, 'email')->textInput() ?>

            <?= $form->field($modelRegister, 'password')->passwordInput() ?>

            <?= $form->field($modelRegister, 'passwordRepeat')->passwordInput() ?>

            <?=
                $form->field($modelRegister, 'gender')
                ->dropDownList(MgHelpers::arrayTranslateValues(User::GENDERS), ['maxlength' => true, 'prompt' => '-wybierz płeć-', 'class' => 'custom-select'])

            ?>

            <?= $form->field($modelRegister, 'birthdate')->textInput(['type' => 'date']) ?>
            
            <?= $form->field($modelRegister, 'birth_place')->textInput() ?>
            <div class="row form-group">
              <div class="col">


                <? foreach ($agreements as $index => $agreement): ?>
                  <?=
                  $form->field($modelRegister, "acceptTerms[$agreement->id]")->checkbox([
                      'template' => '<div class="">
                        <input type="hidden" name="RegisterForm[acceptTerms][' . $agreement->id . '] value="0"/>
                  <input type="checkbox" id="register-agree-' . $agreement->id . '" '
                      . 'name="RegisterForm[acceptTerms][' . $agreement->id . ']" '
                      . (isset($modelRegister->acceptTerms[$agreement->id]) && $modelRegister->acceptTerms[$agreement->id] ? 'checked="checked"' : '') . ' value="1">
                  <label for="register-agree-' . $agreement->id . '">' . $agreement->text . ($agreement->is_required ? ' *' : '') . '</label>
                </div>',
                  ]);

                  ?>
                <? endforeach ?>
              </div>
            </div>

            <div class="row align-items-center form-group ">
              <div class="col">

              </div>
              <div class="col">
                <button type="submit" class="btn btn-danger btn-block">Załóż konto</button>
              </div>
            </div>

            <?php ActiveForm::end(); ?>

          </div>
        </div>

        <div class="col-md-12 mt-3 mt-lg-0 col-lg-5 ml-auto d-flex flex-column justify-content-between">
          <div class="bg-white p-4">
            <h3 class="border-bottom border-primary-light pb-3 mb-3">Zaloguj się</h3>
            <?php
            $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => [
                        'class' => 'login-form form-light'
                    ],
//                    'layout' => 'horizontal',
                    'fieldConfig' => [
                    ],
            ]);

            ?>
            <form action="#" method="POST" class="login-form form-light">
              <div class="row form-group">




                <div class="col-12 col-sm">
                  <?= $form->field($model, 'username')->textInput()->label('Nazwa użytkownika/e-mail') ?>
                </div>
                <div class="col-12 col-sm">
                  <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
              </div>
              <div class="border-bottom border-primary-light">
                <div class="row align-items-center form-group ">
                  <div class="col-12 col-sm">
                    <?=
                    $form->field($model, 'rememberMe')->checkbox([
                        'template' => '<div class="">
                      <input type="checkbox" id="login-remember" name="LoginForm[rememberMe]">
                      <label for="login-remember">Zapamiętaj mnie</label>
                    </div>',
                    ])
                    ?>

                  </div>
                  <div class="col-12 col-sm">
                    <button type="submit" class="btn btn-danger btn-block">Zaloguj się</button>
                  </div>
                </div>
              </div>

              <div class="row align-items-center pt-3">
                <div class="col-12 col-sm">

                </div>
                <div class="col-12 col-sm">
                  <?= Html::a('Zapomniałeś hasła?', ['site/forgot-password']) ?>         
                </div>
              </div>

              <?php ActiveForm::end(); ?>
          </div>

          <div class="clause mt-3 mt-lg-0">
            <a href="<?= MgHelpers::getSetting('login - link do treści regulaminu')?>" target="_blank">Regulamin organizacji form doskonalenia</a>
            <br>
            <a href="<?= MgHelpers::getSetting('login - link do treści klauzuli')?>" target="_blank">Klauzula informacyjna dla użytkowników Platformy Obsługi Szkoleń oraz uczestników form doskonalenia w OEIiZK.</a>
        
          </div>
        </div>
      </div>

    </div>
  </article>
</div>
