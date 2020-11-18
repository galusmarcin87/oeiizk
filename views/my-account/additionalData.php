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
    <div class="row header">
      <div class="col-12 col-lg order-3 order-lg-1 mt-4 mt-lg-0">
        <h1>Twoje konto</h1>
      </div>
      <div class="col-12 col-lg text-right order-2 order-lg-2">
        Ostatnie logowanie: <strong><?= $model->last_login ?></strong>
      </div>
    </div>

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
            
            <? echo $form->errorSummary($model); ?>

            <?= $form->field($model, 'other_names')->textInput() ?>

            <?= $form->field($model, 'address')->textInput()->label('Adres (do korespondencji)') ?>

            <?= $form->field($model, 'postcode')->textInput()->label('Kod pocztowy (do korespondencji)') ?>

            <?= $form->field($model, 'city')->textInput()->label('Miasto (do korespondencji)') ?>

            <?= $form->field($model, 'phone')->textInput() ?>
              
            <?= $model->is_special_account ? 
                $form->field($model, "is_password_change_accepted")->checkbox([
                    'template' => '<div class="">
                      <input type="hidden" name="User[is_password_change_accepted] value="0"/>
                <input type="checkbox" id="user-is_password_change_accepted"'
                    . 'name="User[is_password_change_accepted]]" '
                    . ($model->is_password_change_accepted ? 'checked="checked"' : '') . ' value="1">
                <label for="user-is_password_change_accepted">Wyłącz cykliczną zmianę hasła.</label>
              </div>',
                ]) : '';

            ?>

            


            <div class="row align-items-center form-group ">
              <div class="col-6">

              </div>
              <div class="col-6">
                <button type="submit" class="btn btn-danger btn-block">Zapisz</button>
              </div>
            </div>

            <?php ActiveForm::end(); ?>


          </div>
        </div>
      </div>
    </div>
  </div>

</section>
