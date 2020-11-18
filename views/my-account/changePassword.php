<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

/* @var $model User */

$this->title = 'Moje konto';

?>

<section class="profile">
  <div class="container">
    
    <?= $this->render('_header') ?>

    <div class="row">
      <div class="col-lg-3">
        <?= $this->render('_menu') ?>
      </div>
      <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-6">

            <?php
            $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'options' => ['enctype' => 'multipart/form-data'],
//        'layout' => 'horizontal',
                    'fieldConfig' => [
                    ],
            ]);

            ?>
              
            <?= $form->field($model, 'oldPassword')->passwordInput(['value' => '']) ?>

            <?= $form->field($model, 'password')->passwordInput(['value' => '']) ?>

            <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>




            <div class="row align-items-center form-group ">
              <div class="col-6">

              </div>
              <div class="col-6">
                <button type="submit" class="btn btn-danger btn-block">Zmień hasło</button>
              </div>
            </div>

            <?php ActiveForm::end(); ?>


          </div>
        </div>
      </div>
    </div>
  </div>

</section>
