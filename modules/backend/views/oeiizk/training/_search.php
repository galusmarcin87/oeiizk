<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use \app\components\mgcms\OeiizkHelpers;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="form-training-search">

  <?php
  $form = ActiveForm::begin([
          'action' => ['index'],
          'method' => 'get',
  ]);

  ?>

  <div class="row">
    <?= $form->field12md($model, 'schoolYear')
      ->dropDownList(array_combine(OeiizkHelpers::generateSchoolYears(5), OeiizkHelpers::generateSchoolYears(5)),[
          'prompt' => ''
      ]) ?>

    <? // $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')])  ?>

    <? // $form->field12md($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subtitle')]) ?>

    <?
//  $form->field($model, 'training_template_id')->widget(\kartik\widgets\Select2::classname(), [
//      'data' => \yii\helpers\ArrayHelper::map(\app\models\db\TrainingTemplate::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
//      'options' => ['placeholder' => Yii::t('app', 'Choose Training template')],
//      'pluginOptions' => [
//          'allowClear' => true
//      ],
//  ]);

    ?>

    <? // $form->field12md($model, 'code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code')]) ?>

    <? // $form->field12md($model, 'meeting_number')->textInput(['placeholder' => $model->getAttributeLabel('meeting_number')]) ?>

    <?php /* echo $form->field12md($model, 'module_number')->textInput(['placeholder' => $model->getAttributeLabel('module_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'date_start')->textInput(['placeholder' => $model->getAttributeLabel('date_start')]) */ ?>

    <?php /* echo $form->field12md($model, 'date_end')->textInput(['placeholder' => $model->getAttributeLabel('date_end')]) */ ?>

    <?php /* echo $form->field12md($model, 'technical_requirements')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'social_requirements')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'visibility')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('visibility')]) */ ?>

    <?php /* echo $form->field12md($model, 'certificate_lines')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'minimal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('minimal_participants_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'maximal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('maximal_participants_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'final_maximal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('final_maximal_participants_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_login_required')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'status')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('status')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_card_required')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'is_certificate_issued')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'additional_information')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'comments')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'sign_status')->textInput(['placeholder' => $model->getAttributeLabel('sign_status')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_promoted_oeiizk')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'is_promoted_pos')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'file_id')->widget(\kartik\widgets\Select2::classname(), [
      'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
      'options' => ['placeholder' => Yii::t('app', 'Choose File')],
      'pluginOptions' => [
      'allowClear' => true
      ],
      ]); */ ?>

    <?php /* echo $form->field($model, 'poll_id')->widget(\kartik\widgets\Select2::classname(), [
      'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Poll::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
      'options' => ['placeholder' => Yii::t('app', 'Choose Poll')],
      'pluginOptions' => [
      'allowClear' => true
      ],
      ]); */ ?>

    <?php /* echo $form->field12md($model, 'link_to_materials')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('link_to_materials')]) */ ?>

    <?php /* echo $form->field($model, 'article_id')->widget(\kartik\widgets\Select2::classname(), [
      'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Article::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
      'options' => ['placeholder' => Yii::t('app', 'Choose Article')],
      'pluginOptions' => [
      'allowClear' => true
      ],
      ]); */ ?>

    <?php /* echo $form->field($model, 'subject_id')->widget(\kartik\widgets\Select2::classname(), [
      'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Subject::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
      'options' => ['placeholder' => Yii::t('app', 'Choose Subject')],
      'pluginOptions' => [
      'allowClear' => true
      ],
      ]); */ ?>

    <?php /* echo $form->field12md($model, 'project')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('project')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_display_on_screen')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(), [
      'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
      'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
      'pluginOptions' => [
      'allowClear' => true
      ],
      ]); */ ?>
  </div>

  <div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
