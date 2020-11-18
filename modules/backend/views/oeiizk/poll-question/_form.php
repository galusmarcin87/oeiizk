<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\PollQuestion */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'PollPollQuestion',
        'relID' => 'poll-poll-question',
        'value' => \yii\helpers\Json::encode($model->pollPollQuestions),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'PollTemplateQuestion',
        'relID' => 'poll-template-question',
        'value' => \yii\helpers\Json::encode($model->pollTemplateQuestions),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="poll-question-form">

  <?php $form = ActiveForm::begin(); ?>

  <div class="row">
    <?= $form->errorSummary($model); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'type')->dropDownList(\app\models\db\PollQuestion::TYPES) ?>

    <?= $form->field12md($model, 'question')->textarea(['rows' => 6]) ?>

    <? if (!$model->is_individual): ?>
      <?= $form->field6md($model, 'is_required')->switchInput() ?>
    <? endif ?>

  </div>
  <?php
//  $forms = [
//      [
//          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'PollPollQuestion')),
//          'content' => $this->render('_formPollPollQuestion', [
//              'row' => \yii\helpers\ArrayHelper::toArray($model->pollPollQuestions),
//          ]),
//      ],
//      [
//          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'PollTemplateQuestion')),
//          'content' => $this->render('_formPollTemplateQuestion', [
//              'row' => \yii\helpers\ArrayHelper::toArray($model->pollTemplateQuestions),
//          ]),
//      ],
//  ];
//  echo kartik\tabs\TabsX::widget([
//      'items' => $forms,
//      'position' => kartik\tabs\TabsX::POS_ABOVE,
//      'encodeLabels' => false,
//      'pluginOptions' => [
//          'bordered' => true,
//          'sideways' => true,
//          'enableCache' => false,
//      ],
//  ]);

  ?>

  <div class="row " id="questionOptions">
    <div class="col-md-12">
      <? $options = $model->getModelAttribute('option', true) ?>
      <legend>Opcje</legend>
      <ol class="options">
        <? if ($options): ?>
          <? foreach ($options as $index => $option): ?>
            <? if (isset($option['text'])): ?>
              <li>
                <input type="text" name="PollQuestion[option][<?= $index + 1 ?>][text]" class="form-control" value="<?= $option['text'] ?>"/>
                <label>Poprawna odpowiedź?</label>
                <input type="checkbox" name="PollQuestion[option][<?= $index + 1 ?>][is_correct]" class="" <? if (isset($option['is_correct']) && $option['is_correct']): ?>checked="checked"<? endif ?>/>
                <button class="btn btn-danger" type="button" onclick="$(this).parent().remove();">Usuń</button>
                <hr/>
              </li>
            <? endif ?>
          <? endforeach ?>
        <? endif ?>
      </ol>

      <?= Html::button('Dodaj opcję', ['class' => 'btn btn-success addOption']) ?>
      <hr/>
    </div>

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


<script type="text/javascript">
  $(document).ready(function () {
    $('.addOption').click(addOption);
    optionsIndex = $('#questionOptions .options li').length + 1;
    $('#pollquestion-type').change(function () {
      if ($(this).val() == '<?= \app\models\db\PollQuestion::TYPE_OPEN ?>') {
        $('#questionOptions').hide();
        $('#questionOptions .options li').remove();
      } else {
        $('#questionOptions').show();
      }
    });
    $('#pollquestion-type').change();
  });

  var optionsIndex = 1;

  function addOption() {
    $('#questionOptions .options').append('<li>\n\
<input type="text" name="PollQuestion[option][' + optionsIndex + '][text]" class="form-control" value=""/>\n\
<label>Poprawna odpowiedź? <input type="checkbox" name="PollQuestion[option][' + optionsIndex + '][is_correct]" class=""/></label>\n\
\n\
<button class="btn btn-danger" type="button" onclick="$(this).parent().remove();">Usuń</button><hr/></li>');
    optionsIndex++;
  }
</script>