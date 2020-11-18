<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\components\mgcms\MgHelpers;

$this->title = 'Contact';

?>

<div class="container">
  <article class="main">
    <div class="text-block">
      <h3>Telefonicznie</h3>
      <?= MgHelpers::getSetting('text - kontakt - góra', true, '<p class="text-center">
        Telefonicznie można kontaktować się z Działem Organizacji Szkoleń:<br/>
        <br />
        <strong>22 579 41 22</strong>   |  <strong> 22 579 41 80</strong>
      </p>') ?>


      <h3>Formularz zapytania do Działu Organizacji Szkoleń</h3>

      <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['class' => 'contact-form form-light']]); ?>
      <? // echo $form->errorSummary($model); ?>
      <div class="row form-group">
        <div class="col-12">
          <?= $form->field($model, 'email')->textInput(['placeholder' => 'Adres e-mail'])->label(false) ?>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12">

          <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Treść wiadomości'])->label(false) ?>
        </div>
      </div>

      <div class="row align-items-center form-group ">
        <div class="col">
          <div class="">
            <?=
            $form->field($model, 'acceptTerm')->checkbox([
                'template' => '<div class="">
                          <input type="checkbox" id="contactform-acceptterm" 
                          name="ContactForm[acceptTerm]" value="1" ' . ($model->acceptTerm ? 'checked="checked"' : '') . '>
                          <label for="contactform-acceptterm">' .
                MgHelpers::getSetting('text - kontakt - akceptacja tekst', true, '<strong>Akceptacja regulaminu oraz <a href="#">RODO</a></strong>') .
                '</label>
                            {error}
                        </div>',
            ])

            ?>
          </div>
        </div>
        <div class="col text-right">
          <button type="submit" class="btn btn-danger">Wyślij wiadomość</button>
        </div>

      </div>

      <?php ActiveForm::end(); ?>


    </div>
  </article>
</div>

</div>
