<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use app\models\db\TrainingTemplate;
use app\models\db\Training;

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
\mootensai\components\JsBlock::widget(['viewFile' => '_scriptAddParticipant', 'pos' => \yii\web\View::POS_END,
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

  <div class="row">
    <?=
    $form->field12md($model, 'training_template_id')->widget(\kartik\widgets\Select2::classname(),
        [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\db\TrainingTemplate::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'options' => ['placeholder' => Yii::t('app', 'Choose Training template')],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'pluginEvents' => [
                "change" => "selectTemplate",
            ]
    ]);

    ?>
  </div>



  <? if ($model->trainingTemplate): ?>
    <div class="row">

      <?= $form->field6md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

      <?= $form->field6md($model, 'code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code')]) ?>

      <?= $form->field6md($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subtitle')]) ?>

      <?=
      $form->field6md($model, 'visibility')->dropDownList(array_combine(TrainingTemplate::VISIBILITIES, TrainingTemplate::VISIBILITIES))

      ?>

      <?= $form->field3md($model, 'status')->dropDownList(array_combine(Training::STATUSES, Training::STATUSES)) ?>

      <?= $form->field3md($model, 'is_login_required')->switchInput() ?>

      <?= $form->field3md($model, 'is_card_required')->switchInput() ?>

      <?= $form->field3md($model, 'is_certificate_issued')->switchInput() ?>

      <?= $form->field4md($model, 'sign_status')->dropDownList(app\models\db\Training::SIGN_STATUSES) ?>

      <?= $form->field4md($model, 'minimal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('minimal_participants_number')]) ?>

      <?= $form->field6md($model, 'maximal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('maximal_participants_number')]) ?>

      <?= $form->field4md($model, 'final_maximal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('final_maximal_participants_number')]) ?>

      <?= $form->field4md($model, 'is_promoted_oeiizk')->switchInput() ?>

      <?= $form->field4md($model, 'is_promoted_pos')->switchInput() ?>

      <?= $form->field4md($model, 'is_display_on_screen')->switchInput() ?>

      <?= $form->field6md($model, 'meeting_number')->textInput(['placeholder' => $model->getAttributeLabel('meeting_number')]) ?>

      <?= $form->field6md($model, 'module_number')->textInput(['placeholder' => $model->getAttributeLabel('module_number')]) ?>

      <?= $form->field6md($model, 'date_start')->datePicker() ?>

      <?= $form->field6md($model, 'date_end')->datePicker() ?>

      <?=
      $form->field6md($model, 'group_id')->widget(\kartik\widgets\Select2::classname(),
          [
              'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Group::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
              'options' => ['placeholder' => Yii::t('app', 'Choose Group')],
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]);

      ?>



      <?= $form->field12md($model, 'price_category')->tinyMce() ?>


      <?= $form->field12md($model, 'certificate_lines')->tinyMce(['rows' => 6]) ?>


      <?= $form->field12md($model, 'additional_information')->textarea(['rows' => 6]) ?>

      <?= $form->field12md($model, 'comments')->textarea(['rows' => 6]) ?>

      <?= $form->field6md($model, 'delegacy')->dropdownFromSettings('delegatura') ?>

      <?= $form->field6md($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) ?>

      <?=
      $form->field6md($model, 'file_id')->widget(\kartik\widgets\Select2::classname(),
          [
              'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('origin_name')->asArray()->all(), 'id',
                  'origin_name'),
              'options' => ['placeholder' => Yii::t('app', 'Choose File')],
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]);

      ?>



      <?= $form->field6md($model, 'link_to_materials')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('link_to_materials')]) ?>

      <?=
      $form->field6md($model, 'article_id')->widget(\kartik\widgets\Select2::classname(),
          [
              'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Article::find()->orderBy('title')->asArray()->all(), 'id',
                  'title'),
              'options' => ['placeholder' => Yii::t('app', 'Choose Article')],
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]);

      ?>

      <?=
      $form->field6md($model, 'subject_id')->widget(\kartik\widgets\Select2::classname(),
          [
              'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Subject::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
              'options' => ['placeholder' => Yii::t('app', 'Choose Subject')],
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]);

      ?>

      <?= $form->field6md($model, 'project')->dropdownFromSettings('szkolenie - projekty', true) ?>


      <?=
      $form->field6md($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(),
          [
              'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('name')->all(), 'id', 'shorterName'),
              'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]);

      ?>

      <?=
      $form->field6md($model, 'certificate_template')->dropDownList( MgHelpers::arrayCombineFromOneArray(MgHelpers::getSettingOptionArray('szablony zaświadczeń')),['prompt' => '']);

      ?>


    </div>


    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Lectors')),
            'content' => $this->render('_formTrainingLector',
                [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->trainingLectors),
            ]),
        ],
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
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Workshops')),
            'content' => $this->render('_formWorkshop',
                [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->workshops),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trainings Required')),
            'content' => $this->render('_formTrainingRequired',
                [
                    'row' => \yii\helpers\ArrayHelper::toArray($model->trainingRequireds),
            ]),
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
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> Wysyłka',
            'content' => Html::a('<i class="fa glyphicon glyphicon-envelope"></i> ' . Yii::t('app', 'Wyślij maila do uczestników'), ['mgcms/message/create-for-training', 'trainingId' => $model->id], [
                'class' => 'btn btn-info',
                'target' => '_blank',
                ]
            ) . ' ' .
            Html::a('<i class="fa glyphicon glyphicon-phone"></i> ' . Yii::t('app', 'Wyślij sms do uczestników'), ['mgcms/message/send-sms', 'trainingId' => $model->id], [
                'class' => 'btn btn-info',
                'target' => '_blank',
                ]
            )
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
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

        ?>
      <?php endif; ?>
      <?php if (Yii::$app->controller->action->id != 'create'): ?>
        <?=
        Html::submitButton(Yii::t('app', 'Save As New'),
            ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew'])

        ?>
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
</script>
