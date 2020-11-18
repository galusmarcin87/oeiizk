<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

$this->getAssetManager()->getBundle('yii\web\JqueryAsset')->jsOptions['position'] = \yii\web\View::POS_END;

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

            <?php
            $form = ActiveForm::begin([
                    'id' => 'add-institution-form',
                    'options' => ['enctype' => 'multipart/form-data'],
//        'layout' => 'horizontal',
                    'fieldConfig' => [
                    ],
            ]);

            ?>

            <? echo $form->errorSummary($model); ?>
            <div class="row">

              <?= $form->field6md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

              <?= $form->field6md($model, 'patron')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('patron')]) ?>

              <?= $form->field6md($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) ?>

              <?= $form->field6md($model, 'community')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('community')]) ?>

              <?= $form->field6md($model, 'county')->dropdownFromSettings('powiat') ?>

              <?= $form->field6md($model, 'province')->dropdownFromSettings('województwo') ?>

              <legend>Adres</legend>

              <?= $form->field6md($model, 'street')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('street')]) ?>

              <?= $form->field6md($model, 'house_no')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('house_no')]) ?>

              <?= $form->field6md($model, 'postcode')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('postcode')]) ?>

              <?= $form->field6md($model, 'post')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('post')]) ?>

              <?= $form->field12md($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone')]) ?>

              <?= $form->field6md($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

              <?= $form->field6md($model, 'www')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('www')]) ?>

              <legend>Pozostałe dane</legend>

              <?= $form->field6md($model, 'type')->dropdownFromSettings('typ placówki') ?>

              <?= $form->field6md($model, 'school_group_name')->textInput() ?>

              <?= $form->field6md($model, 'delegacy')->dropdownFromSettings('delegatura') ?>

              <?= $form->field6md($model, 'territory')->dropdownFromSettings('Obszary instytucji') ?>

              <?= $form->field6md($model, 'school_governing_body')->dropdownFromSettings('organ prowadzący') ?>

              <?= $form->field6md($model, 'NIP')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('NIP')]) ?>

            </div>


            <div class="row align-items-center form-group marginTop15">
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


<script type="text/javascript">
  var isFormTouched = false;
  function canGenerateEmployeCard() {
    if (isFormTouched) {
      alert("Zmieniłeś dane bez zapisania - najpierw zapisz, aby wygenerować potwierdzenie.");
      return false;
    } else {
      return true;
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    $('#workspace-form :input').change(function () {
      isFormTouched = true;
    })

  }, false);


</script>