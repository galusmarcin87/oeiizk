<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Event */
/* @var $form app\components\mgcms\yii\ActiveForm */

?>

<div class="event-form">

  <?php $form = ActiveForm::begin(); ?>

  <div class="row">
    <?= $form->errorSummary($model); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field6md($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subtitle')]) ?>

    <?= $form->field6md($model, 'code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code')]) ?>

    <?= $form->field12md($model, 'type')->dropDownList(MgHelpers::dropdownDataFromSettings('Typy wydarzeń'), ['maxlength' => true, 'prompt' => '']) ?>

    <?= $form->field12md($model, 'info')->tinyMce() ?>

    <?= $form->field6md($model, 'link')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('link')]) ?>

    <?= $form->field6md($model, 'link_to_registration')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('link_to_registration')]) ?>

    <?= $form->field6md($model, 'date_from')->dateTimePicker() ?>

    <?= $form->field6md($model, 'date_to')->dateTimePicker() ?>

    <div class="col-md-4">
      <?= $form->field($model, 'file_id')->fileInputRelatedModal(); ?>
    </div>
    

    <?= $form->field4md($model, 'promoted_oeiizk')->switchInput() ?>

    <?= $form->field4md($model, 'promoted_pos')->switchInput() ?>

    <?= $form->field12md($model, 'coments')->textarea(['rows' => 6]) ?>



    <?= $form->field12md($model, 'is_display_on_screen')->switchInput() ?>

    <?=
    $form->field12md($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->all(), 'id', 'shorterName'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>
  </div>

  <div class="form-group">
    <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if (Yii::$app->controller->action->id != 'create'): ?>
      <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
    <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
