<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<?php
$form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
        ],
        'options' => [
            'class' => 'login-form form-light',
        ]
    ]);

?>


<div class="row form-group">
  <div class="col-12 col-sm">
    <?= $form->field($modelLogin, 'username')->textInput()->label('Nazwa użytkownika/e-mail') ?>
  </div>
  <div class="col-12 col-sm">
    <?= $form->field($modelLogin, 'password')->passwordInput() ?>
  </div>
</div>
<div class="border-bottom border-primary-light">
  <div class="row align-items-center form-group ">
    <div class="col-12 col-sm">

      <?=
      $form->field($modelLogin, 'rememberMe')->checkbox([
          'template' => '<div class="">
                          <input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1">
                          <label for="loginform-rememberme">Zapamiętaj mnie</label>
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
    <div class="">
      <a href="<?= Url::to(['site/login']) ?>" class="">Załóż konto</a>
    </div>
  </div>
  <div class="col-12 col-sm">
    <a href="<?= Url::to(['site/forgot-password']) ?>" class="">Zapomniałeś hasła?</a>            
  </div>
</div>





<?php ActiveForm::end(); ?>
