<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workshop */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'WorkshopLector',
        'relID' => 'workshop-lector',
        'value' => \yii\helpers\Json::encode($model->workshopLectors),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'WorkshopUser',
        'relID' => 'workshop-user',
        'value' => \yii\helpers\Json::encode($model->workshopUsers),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="workshop-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

  <div class="row">
    <?= $form->field12md($model, 'title')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('title')]) ?>

    <?= $form->field12md($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field6md($model, 'date_start')->dateTimePicker() ?>

    <?= $form->field6md($model, 'date_end')->dateTimePicker() ?>

    <?=
    $form->field6md($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->all(), 'id', 'toString'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?=
    $form->field6md($model, 'training_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>

    <?= $form->field6md($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) ?>

  </div>
  <?php
  $forms = [
      [
          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Lectors')),
          'content' => $this->render('_formWorkshopLector', [
              'row' => \yii\helpers\ArrayHelper::toArray($model->workshopLectors),
          ]),
      ],
      [
          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Participants')),
          'content' => $this->render('_formWorkshopUser', [
              'row' => \yii\helpers\ArrayHelper::toArray($model->workshopUsers),
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
