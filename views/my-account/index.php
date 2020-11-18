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
      <div class="col-lg-6">

        <?= $this->render('_myData', ['model' => $model]) ?>

        <div class="row align-items-center form-group ">
          <div class="col">
            <?= Html::a('Pobierz swoje dane', ['pdf'], ['class' => 'btn btn-danger', 'target' => '_blank']) ?>
          </div>
        </div>



      </div>
    </div>
  </div>

</section>
