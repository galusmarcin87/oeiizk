<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $form app\components\mgcms\yii\ActiveForm */

/* @var $this yii\web\View */
/* @var $model app\models\db\Lesson */

$this->title = 'Generuj zajęcia';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="lesson-create">

  <h1><?= Html::encode($this->title) ?></h1>


  <div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

      <?= $form->errorSummary($model); ?>
      <?= $form->field6md($model, 'date_start')->dateTimePicker() ?>


      <?=
      $form->field6md($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(),
          [
              'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->all(), 'id', 'shorterName'),
              'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]);

      ?>

      <? // $form->field12md($model, 'hours_count')->textInput(['placeholder' => $model->getAttributeLabel('hours_count')])  ?>

      <?= $form->field6md($model, 'lessonsCount')->textInput(['placeholder' => $model->getAttributeLabel('lessonsCount')]) ?>

      <?= $form->field6md($model, 'interval')->textInput(['placeholder' => $model->getAttributeLabel('interval')]) ?>

      <?= $form->field6md($model, 'generateHours')->textInput(['placeholder' => $model->getAttributeLabel('generateHours')]) ?>

    </div>

    <div class="form-group">
      <?= Html::submitButton(Yii::t('app', 'Generuj'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  </div>

</div>
