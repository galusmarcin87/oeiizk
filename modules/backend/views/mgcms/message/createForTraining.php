<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Message */
/* @var $form app\components\mgcms\yii\ActiveForm */

$this->title = Yii::t('app', 'Create Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$usersQuery = \app\models\mgcms\db\User::find()->orderBy('id')->orderBy(['first_name' => SORT_ASC, 'username' => SORT_ASC]);
if (isset($this->params['userIds'])) {
  $usersQuery->andWhere(['in', 'id', $this->params['userIds']]);
}

?>
<div class="message-create">

  <h1><?= Html::encode($this->title) ?></h1>


  <div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subject')]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'template')->dropdownFromSettings('wiadomość do uczestników - szablony', true) ?>

    <?=
    $form->field($model, 'recipient_id')->widget(\kartik\widgets\Select2::classname(),
        [
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
      <?=
      Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
          ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

      ?>
      <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  </div>


</div>
<script type="text/javascript">
  var templateText = [];
  $('#message-template').change(function () {
    if ($(this).val()) {
      $('#message-subject').val(templateText[$(this).val()].subject);
      $('#message-message').val(templateText[$(this).val()].template);
    } else {
      $('#message-subject').val('');
      $('#message-message').val('');
    }
  })

  
<?
foreach (MgHelpers::getSettingOptionArray('wiadomość do uczestników - szablony') as $templateName) {
  $template = MgHelpers::getSetting($templateName, true);
  $topic = MgHelpers::getSetting($templateName);
  ?>
    templateText['<?= $templateName ?>'] = {'subject' :'<?= $topic ?>','template':'<?= str_replace(array("\r\n", "\n", "\r"), '', $template) ?>'};
  <?
}
?>
</script>

