<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\OeiizkHelpers;
use app\models\mgcms\db\User;

/* @var $this yii\web\View */
/* @var $model app\models\db\Lesson */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'LessonPresence',
        'relID' => 'lesson-presence',
        'value' => \yii\helpers\Json::encode($model->lessonPresences),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="lesson-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
    <div class="row">


        <?= $form->field6md($model, 'date_start')->dateTimePicker() ?>

        <?= $form->field6md($model, 'date_end')->dateTimePicker() ?>

        <?=
        $model->isNewRecord ?
            $form->field6md($model, 'training_id')->widget(\kartik\widgets\Select2::classname(),
                [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) : '';

        ?>

        <?=
        $form->field6md($model, 'lab_id')->widget(\kartik\widgets\Select2::classname(),
            [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->all(), 'id', 'shorterName'),
            'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        ?>

        <?= $form->field6md($model, 'hours_count')->textInput(['placeholder' => $model->getAttributeLabel('hours_count'), 'disabled' => OeiizkHelpers::isRole(User::ROLE_DOS)]) ?>

        <?= $form->field12md($model, 'subject')->textarea(['placeholder' => $model->getAttributeLabel('subject'),'rows' => 10,  'disabled' => OeiizkHelpers::isRole(User::ROLE_DOS)]) ?>

    </div>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Lesson Presence')),
            'content' => $this->render('_formLessonPresence',
                [
                'row' => \yii\helpers\ArrayHelper::toArray($model->lessonPresences),
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
