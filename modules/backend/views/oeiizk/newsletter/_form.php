<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use \app\models\db\Training;

/* @var $this yii\web\View */
/* @var $model app\models\db\Newsletter */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'NewsletterUser',
        'relID' => 'newsletter-user',
        'value' => \yii\helpers\Json::encode($model->newsletterUsers),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="newsletter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

        <?= $form->field12md($model, 'text')->tinyMce(['rows' => 6]) ?>

        <div class="col-md-12 field-newsletter-add_incoming_training_info">
            <? $incomingTrainings = yii\helpers\Json::decode(Training::getIncomingTrainingsJSON()) ?>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Dodaj informację o nadchodzących szkoleniach
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <? if ($incomingTrainings): ?>

                              <? foreach ($incomingTrainings as $incomingTraining): ?>
                                <div class="col-md-6">
                                    <?=
                                    \kartik\helpers\Html::checkbox('incomingTrainings[]', '',
                                        ['value' => yii\helpers\Json::encode($incomingTraining), 'class' => 'incomingTrainings'])

                                    ?> 
                                    <?= $incomingTraining['name'] ?>
                                </div>

                              <? endforeach; ?>
                              <?=
                              Html::button('Dodaj do edytora',
                                  ['class' => 'btn btn-info', 'onclick' => 'addIncomingTrainingsToEditor()'])

                              ?>
                            <? else: ?>
                              Brak szkoleń spełniających kryteria
                            <? endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?= $form->field6md($model, 'status')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('status')]) ?>

        <?=
        $form->field6md($model, 'group_id')->widget(\kartik\widgets\Select2::classname(),
            [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Group::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
            'options' => ['placeholder' => Yii::t('app', 'Choose Group'), 'prompt' => 'Wszyscy'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);

        ?>

        <?= $form->field12md($model, 'keywords')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('keywords')]) ?>




    </div>
    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
          <?=
          Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
              ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

          ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id != 'create'): ?>
          <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">

  function addIncomingTrainingsToEditor() {
      var incomingTrainings = [];
      let incomingTrainingCheckboxes = $('.incomingTrainings').each(function () {
          if ($(this).is(':checked')) {
              incomingTrainings.push(JSON.parse($(this).val()));
          }
      });

      if (incomingTrainings.length == 0) {
          alert('Brak szkoleń spełniających kryteria');
          return false;
      }
      var tinyMceEditorText = tinymce.get('newsletter-text');
      tinyMceEditorText.insertContent('<h3>Nadchodzące szkolenia</h3>');
      tinyMceEditorText.insertContent('<ul>');
      for (i = 0; i < incomingTrainings.length; i++) {
          tinyMceEditorText.insertContent('<li>' + incomingTrainings[i].link + '</li>');
      }
      tinyMceEditorText.insertContent('</ul>');
  }
</script>
