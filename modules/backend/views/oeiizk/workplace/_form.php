<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workplace */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'WorkplaceEducationalLevel',
        'relID' => 'workplace-educational-level',
        'value' => \yii\helpers\Json::encode($model->workplaceEducationalLevels),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'WorkplaceSubject',
        'relID' => 'workplace-subject',
        'value' => \yii\helpers\Json::encode($model->workplaceSubjects),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="workplace-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= $form->field6md($model, 'position')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('position')]) ?>

        <?= $form->field6md($model, 'school_type')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('school_type')]) ?>


        <?=
        $model->isNewRecord ? $form->field6md($model, 'user_id')->widget(\kartik\widgets\Select2::classname(),
                [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
                'options' => ['placeholder' => Yii::t('app', 'Choose User')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) : false;

        ?>

        <?=
        $form->field6md($model, 'institution_id')->widget(\kartik\widgets\Select2::classname(),
            [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Institution::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
            'options' => ['placeholder' => Yii::t('app', 'Choose Institution')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>
    </div>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Educational Levels')),
            'content' => $this->render('_formWorkplaceEducationalLevel',
                [
                'row' => \yii\helpers\ArrayHelper::toArray($model->workplaceEducationalLevels),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Subjects')),
            'content' => $this->render('_formWorkplaceSubject',
                [
                'row' => \yii\helpers\ArrayHelper::toArray($model->workplaceSubjects),
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
  <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
      ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
<?php endif; ?>
<?php if (Yii::$app->controller->action->id != 'create'): ?>
  <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
<?php endif; ?>
<?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
