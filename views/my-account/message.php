<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

/* @var $model User */

$this->title = 'Moje konto';
$this->getAssetManager()->getBundle('yii\web\JqueryAsset')->jsOptions['position'] = \yii\web\View::POS_END;

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
                    'id' => 'register-form',
                    'options' => ['enctype' => 'multipart/form-data'],
//        'layout' => 'horizontal',
                    'fieldConfig' => [
                    ],
            ]);

            ?>
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subject')]) ?>

            <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

            <?=
            $form->field($model, 'recipient_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::findDosUsers(), 'id', 'toString'),
                'options' => ['placeholder' => Yii::t('app', 'Choose User')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);

            ?>

            <div class="form-group field-user-acceptterms-12">
              <div class="">
                <input type="hidden" name="rodo" value="0">
                <input type="checkbox" id="rodo" name="rodo"  value="1">
                <label for="rodo"><?= MgHelpers::getSetting('checkbox - formułka RODO', false, 'Administratorem danych osobowych jest Ośrodek Edukacji Informatycznej i Zastosowań Komputerów w Warszawie, ul. Raszyńska 8/10,02-226 Warszawa. Dane wpisane w formularzu kontaktowym będą przetwarzane w celu udzielenia odpowiedzi na przesłane zapytanie.') ?></label>
              </div>
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-danger">Wyślij wiadomość</button>
            </div>



            <?php ActiveForm::end(); ?>


          </div>
        </div>
      </div>
    </div>
  </div>

</section>
