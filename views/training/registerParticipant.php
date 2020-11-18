<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

$this->title = 'Logowanie/rejestracja';

?>

<div class="container">
  <article class="main">
    <div class="register-block">

      <div class="row">
        <div class="col-md-12 col-lg-5">
          <div class="bg-white p-4">
            <h3 class="border-bottom border-primary-light pb-3 mb-3">Zapis</h3>

            <?php
            $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'encodeErrorSummary' => false,
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

            <?= $form->field($modelRegister, 'email')->textInput()->error($modelRegister->accountExist ? false : []) ?>

            <?= $form->field($modelRegister, 'phone')->textInput() ?>


            <div class="row align-items-center form-group ">
              <div class="col">

              </div>
              <div class="col">
                <button type="submit" class="btn btn-danger btn-block">Zapisz</button>
              </div>
            </div>

            <?php ActiveForm::end(); ?>

          </div>
        </div>


      </div>

    </div>
  </article>
</div>
