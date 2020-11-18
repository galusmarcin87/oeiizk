<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingModule */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingModulePresence',
        'relID' => 'training-module-presence',
        'value' => \yii\helpers\Json::encode($model->trainingModulePresences),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="training-module-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

  <div class="row">
    <?// $form->field12md($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subject')]) ?>

    <?=
    $form->field6md($model, 'date_start')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', Yii::t('app', 'Choose Date Start')),
                'autoclose' => true
            ]
        ],
    ]);

    ?>

    <?=
    $form->field6md($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', Yii::t('app', 'Choose Date End')),
                'autoclose' => true
            ]
        ],
    ]);

    ?>
      
    <?= $form->field6md($model, 'hours')->textInput(['placeholder' => $model->getAttributeLabel('hours')]) ?>

    <?= $form->field12md($model, 'description')->textarea(['rows' => 6]) ?>

    

    <?= $model->isNewRecord ? 
    $form->field6md($model, 'training_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) : '';

    ?>
  </div>

  <?php
  $forms = [
      [
          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Presence')),
          'content' => $this->render('_formTrainingModulePresence', [
              'row' => \yii\helpers\ArrayHelper::toArray($model->trainingModulePresences),
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
  <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<?php endif; ?>
<?php if (Yii::$app->controller->action->id != 'create'): ?>
  <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
<?php endif; ?>
<?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
  </div>

<?php ActiveForm::end(); ?>

</div>
