<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Agreement */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserAgreement',
        'relID' => 'user-agreement',
        'value' => \yii\helpers\Json::encode($model->userAgreements),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="agreement-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

  <div class="row">
    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field4md($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) ?>

    <?= $form->field4md($model, 'is_required')->switchInput() ?>

    <?= $form->field4md($model, 'is_cancel')->switchInput() ?>

  </div>
  <?php
  $forms = [
      [
          'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'UserAgreement')),
          'content' => $this->render('_formUserAgreement', [
              'row' => \yii\helpers\ArrayHelper::toArray($model->userAgreements),
          ]),
      ],
  ];
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
