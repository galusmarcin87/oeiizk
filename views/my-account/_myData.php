<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

/* @var $model User */
$agreements = \app\models\db\Agreement::find()->andWhere(['or', ['!=', 'is_cancel', 1], ['IS', 'is_cancel', null]])->andWhere(['or', ['!=', 'is_required', 1], ['IS', 'is_required', null]])->all();

?>


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

<?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'first_name')->textInput() ?>

<?= $form->field($model, 'last_name')->textInput() ?>

<?= $form->field($model, 'email')->textInput() ?>

<a href="<?= \yii\helpers\Url::to(['resend-activation']) ?>" class="btn btn-success">Wyślij mail aktywacyjny ponownie</a>

<?= $form->field($model, 'gender')->dropDownList(MgHelpers::arrayTranslateValues(User::GENDERS), ['maxlength' => true, 'prompt' => '']) ?>

<?= $form->field($model, 'birthdate')->textInput(['type' => 'date', 'pattern' => '[0-9]{2}.[0-9]{2}.[0-9]{4}']) ?>

<?= $form->field($model, 'birth_place')->textInput() ?>

<div class="form-group field-user-createdby">
  <label class="control-label" for="user-createdby">Założenie konta</label>
  <input type="text" id="user-createdby" class="form-control" name="User[create_account_additional_data]" value="<?= $model->create_account_additional_data?>" disabled="true" >
</div>


<h4>Moje zgody</h4>
<div class="row form-group">
  <div class="col">


    <? foreach ($agreements as $index => $agreement): ?>
      <h5><?= $agreement->name ?></h5>
      <?=
      $form->field($model, "acceptTerms[$agreement->id]")->checkbox([
          'template' => '<div class="">
                        <input type="hidden" name="User[acceptTerms][' . $agreement->id . '] value="0"/>
                  <input type="checkbox" id="register-agree-' . $agreement->id . '" '
          . 'name="User[acceptTerms][' . $agreement->id . ']" '
          . ($model->hasAgreementAccepted($agreement->id) ? 'checked="checked"' : '') . ' value="1">
                  <label for="register-agree-' . $agreement->id . '">' . $agreement->text . ($agreement->is_required ? ' *' : '') . '</label>
                </div>',
      ]);

      ?>
    <? endforeach ?>
  </div>
</div>



<div class="row align-items-center form-group ">
  <div class="col-8">

  </div>
  <div class="col-4">
    <button type="submit" class="btn btn-danger btn-block">Zapisz</button>
  </div>
</div>

<?php ActiveForm::end(); ?>