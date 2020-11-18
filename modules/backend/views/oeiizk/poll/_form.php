<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Poll */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'PollPollQuestion', 
        'relID' => 'poll-poll-question', 
        'value' => \yii\helpers\Json::encode($model->pollPollQuestions),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
//\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//    'viewParams' => [
//        'class' => 'Training', 
//        'relID' => 'training', 
//        'value' => \yii\helpers\Json::encode($model->trainings),
//        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//    ]
//]);
//\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//    'viewParams' => [
//        'class' => 'TrainingTemplate', 
//        'relID' => 'training-template', 
//        'value' => \yii\helpers\Json::encode($model->trainingTemplates),
//        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//    ]
//]);
?>

<div class="poll-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'poll_template_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\PollTemplate::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Poll template')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Questions')),
            'content' => $this->render('_formPollPollQuestion', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->pollPollQuestions),
                'model' => $model
            ]),
        ],
//        [
//            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Training')),
//            'content' => $this->render('_formTraining', [
//                'row' => \yii\helpers\ArrayHelper::toArray($model->trainings),
//            ]),
//        ],
//        [
//            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TrainingTemplate')),
//            'content' => $this->render('_formTrainingTemplate', [
//                'row' => \yii\helpers\ArrayHelper::toArray($model->trainingTemplates),
//            ]),
//        ],
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
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
