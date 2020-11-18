<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use app\models\db\TrainingTemplate;
use app\models\db\Training;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Lesson',
        'relID' => 'lesson',
        'value' => \yii\helpers\Json::encode($model->lessons),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingLector',
        'relID' => 'training-lector',
        'value' => \yii\helpers\Json::encode($model->trainingLectors),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingModule',
        'relID' => 'training-module',
        'value' => \yii\helpers\Json::encode($model->trainingModules),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingParticipant',
        'relID' => 'training-participant',
        'value' => \yii\helpers\Json::encode($model->trainingParticipants),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
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
        'class' => 'TrainingTrainingDirection',
        'relID' => 'training-training-direction',
        'value' => \yii\helpers\Json::encode($model->trainingTrainingDirections),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Workshop',
        'relID' => 'workshop',
        'value' => \yii\helpers\Json::encode($model->workshops),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="training-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>
  <p>
  <?= Html::a('Zobacz szkolenie', ['view', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
  </p>

  <? if ($model->trainingTemplate): ?>

      <?php
      $gridColumn = [
          'code',
          'status',
          'date_start',
          'date_end',
          'trainingTemplate.hours_local',
          'trainingTemplate.hours_online',
          'lectorsStr'
          
      ];
      echo DetailView::widget([
          'model' => $model,
          'attributes' => $gridColumn
      ]);

      ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Zajęcia')),
            'content' => $this->render('_formLesson',
                [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->lessons),
                    'parentModel' => !$model->isNewRecord ? $model : false
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Modules')),
            'content' => $this->render('_formTrainingModule',
                [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->trainingModules),
            ]),
            'visible' => !app\components\mgcms\OeiizkHelpers::isRole(app\models\mgcms\db\User::ROLE_DOS)
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Kierunki polityki')),
            'content' => $this->render('_formTrainingTrainingDirection',
                [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->trainingTrainingDirections),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Dokumentacja')),
            'content' => $this->render('_buttonsDocs', ['model' => $model,]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Ankieta')),
            'content' => $this->render('_buttonsPoll', ['model' => $model, 'form' => $form]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> Lista obecności',
            'content' => $this->render('_formPresenceList', ['model' => $model,]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> Wymagania',
            'content' => $form->field12md($model, 'technical_requirements')->tinyMce() . $form->field12md($model, 'social_requirements')->tinyMce(),
        ],
    ];
    
    if (\app\components\mgcms\OeiizkHelpers::isRole(\app\models\mgcms\db\User::ROLE_DIRECTOR)) {
      $forms = [
          [
              'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Dokumentacja')),
              'content' => $this->render('_buttonsDocs', ['model' => $model,]),
          ],
      ];
    }
    
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
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

        ?>
      <?php endif; ?>
      <?php if (Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
      <?php endif; ?>
      <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>
  <? endif ?>

  <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
  function selectTemplate(e) {
    window.location.href = '/backend/oeiizk/training/<? if ($model->isNewRecord): ?>create?<? else: ?>update?id=<?= $model->id ?>&<? endif ?>templateId=' + $(this).val();
  }
  ;
</script>