<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Message */
/* @var $form app\components\mgcms\yii\ActiveForm */

$usersQuery = \app\models\mgcms\db\User::find()->orderBy('id')->orderBy(['first_name' => SORT_ASC, 'username' => SORT_ASC]);
if(isset($this->params['userIds'])){
  $usersQuery->andWhere(['in','id',$this->params['userIds']]);
}
?>

<div class="message-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

  <?= $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subject')]) ?>

  <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

  <?=
  $form->field($model, 'recipient_id')->widget(\kartik\widgets\Select2::classname(), [
      'data' => \yii\helpers\ArrayHelper::map($usersQuery->all(), 'id', 'toString'),
      'options' => [
          'placeholder' => Yii::t('app', 'Choose User'),
          'multiple' => true
          ],
      'pluginOptions' => [
          'allowClear' => true
      ],
  ])->label('Odbiorcy');

  ?>


  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
