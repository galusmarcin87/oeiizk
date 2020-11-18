<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use app\models\db\TrainingTemplate;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingTemplate */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingRequired',
        'relID' => 'training-required',
        'value' => \yii\helpers\Json::encode($model->trainingRequireds),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingTemplateEducationalLevel',
        'relID' => 'training-template-educational-level',
        'value' => \yii\helpers\Json::encode($model->trainingTemplateEducationalLevels),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="training-template-form">

  <?php
  $form = ActiveForm::begin([
          'options' => ['enctype' => 'multipart/form-data'] // important
  ]);

  ?>

  <div class="row">
    <?= $form->errorSummary($model); ?>

    <?= $form->field12md($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field6md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field6md($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subtitle')]) ?>

    <?= $form->field6md($model, 'type')->dropDownList(MgHelpers::dropdownDataFromSettings('Typy szkoleń')) ?>

    <?= $form->field6md($model, 'code_start')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code_start')]) ?>

    <?= $form->field3md($model, 'visibility')->dropDownList(array_combine(TrainingTemplate::VISIBILITIES, TrainingTemplate::VISIBILITIES)) ?>

    <?= $form->field3md($model, 'is_login_required')->switchInput() ?>

    <?= $form->field3md($model, 'is_card_required')->switchInput() ?>
      
    <?= $form->field3md($model, 'is_certificate_issued')->switchInput() ?>
      
    <?= $form->field6md($model, 'sign_status')->dropDownList(TrainingTemplate::SIGN_STATUSES) ?>
      
    <?= $form->field6md($model, 'default_minimal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('default_minimal_participants_number')]) ?>

    <?= $form->field6md($model, 'default_maximal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('default_maximal_participants_number')]) ?>




    <?= $form->field6md($model, 'training_gruop')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_gruop')]) ?>

    <?= $form->field6md($model, 'training_path')->dropdownFromSettings('szablon szkolenia - ścieżki szkoleniowe', true) ?>

    <?=
    $form->field6md($model, 'category_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->training()->withParent()->orderBy('id')->all(), 'id', 'name', 'parent.name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Category')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>



    <?= $form->field6md($model, 'hours_local')->textInput(['placeholder' => $model->getAttributeLabel('hours_local')]) ?>

    <?= $form->field6md($model, 'hours_online')->textInput(['placeholder' => $model->getAttributeLabel('hours_online')]) ?>

    <?= $form->field6md($model, 'meeting_default_number')->textInput(['placeholder' => $model->getAttributeLabel('meeting_default_number')]) ?>

    <?= $form->field6md($model, 'modules_default_number')->textInput(['placeholder' => $model->getAttributeLabel('modules_default_number')]) ?>

    <div class="col-md-6">
      <?= $form->field($model, 'program_file_id')->fileInputRelatedModal() ?>
    </div>


    <?=
    $form->field6md($model, 'date_program_submission')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', Yii::t('app', 'Choose Date Program Submission')),
                'autoclose' => true
            ]
        ],
    ]);

    ?>

    <?= $form->field12md($model, 'lead')->tinyMce() ?>
      
    <?= $form->field12md($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field12md($model, 'keywords')->textInput(['placeholder' => $model->getAttributeLabel('keywords')]) ?>

    <?= $form->field12md($model, 'preliminary_recommendations')->tinyMce(['rows' => 6]) ?>

    <?= $form->field12md($model, 'default_technical_requirements')->tinyMce(['rows' => 6]) ?>

    <?= $form->field12md($model, 'default_social_requirements')->tinyMce(['rows' => 6]) ?>

    <div class="col-md-6">
      <?= $form->field($model, 'image_id')->fileInputRelatedModal() ?>
    </div>
    
    <div class="col-md-6">
      <?= $form->field($model, 'image_2_id')->fileInputRelatedModal() ?>
    </div>



    <?= $form->field6md($model, 'default_price_category')->tinyMce() ?>


    <?= $form->field12md($model, 'default_certificate_lines')->textarea(['rows' => 6]) ?>

   


    <?= $form->field12md($model, 'additional_information')->textarea(['rows' => 6]) ?>


    
    <?=
    $form->field6md($model, 'poll_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Poll::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Poll')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?=
    $form->field6md($model, 'article_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Article::find()->orderBy('id')->asArray()->all(), 'id', 'title'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Article')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?=
    $form->field6md($model, 'subject_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Subject::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Subject')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>
  </div>
  <?php
  $forms = [
      [
          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trainings Required')),
          'content' => $this->render('_formTrainingRequired', [
              'row' => \yii\helpers\ArrayHelper::toArray($model->trainingRequireds),
          ]),
      ],
      [
          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Educational Levels')),
          'content' => $this->render('_formTrainingTemplateEducationalLevel', [
              'row' => \yii\helpers\ArrayHelper::toArray($model->trainingTemplateEducationalLevels),
          ]),
      ],
  ];
  echo kartik\tabs\TabsX::widget([
      'items' => $forms,
      'position' => kartik\tabs\TabsX::POS_ABOVE,
      'encodeLabels' => false,
      'pluginOptions' => [
          'bordered' => true,
          'sideways' => true,
          'enableCache' => false,
      ],
  ]);

  ?>
  <div class="form-group">
    <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
      <?=
      Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

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
  $('#RelatedModal_program_file_id .modal-footer .btn-success').click(function(){
    var today = new Date();
    var phpDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    $('#trainingtemplate-date_program_submission').val(phpDate);
    $('#trainingtemplate-date_program_submission-disp').val(phpDate);
  });
</script>