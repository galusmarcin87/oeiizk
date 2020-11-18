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
          <div class="col-lg-12">
            <h3>Wiadomość od <?= $model->messageParent->sender ?></h3>
            <h4>Temat: <?= $model->messageParent->subject ?></h4>
            <h4>Treść</h4>
            <div>
              <?= $model->messageParent->message ?>
            </div>

            <br/>
            <?php
//            $form = ActiveForm::begin([
//                    'id' => 'register-form',
//                    'options' => ['enctype' => 'multipart/form-data'],
////        'layout' => 'horizontal',
//                    'fieldConfig' => [
//                    ],
//            ]);

            ?>


            <? // $form->field($model, 'message')->textarea(['rows' => 6])->label('Odpowiedź') ?>






            <?php // ActiveForm::end(); ?>


          </div>
        </div>
      </div>
    </div>
  </div>

</section>
