<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Subject */
/* @var $form app\components\mgcms\yii\ActiveForm */



\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'UserSubject', 
        'relID' => 'user-subject', 
        'value' => \yii\helpers\Json::encode($model->userSubjects),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field($model, 'status')->dropDownList(MgHelpers::arrayTranslateValues(\app\models\db\Subject::STATUSES), ['maxlength' => true]) ?>

    <?= $form->field($model, 'group')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('group')]) ?>

    <?php
//    $forms = [
//        [
//            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'UserSubject')),
//            'content' => $this->render('_formUserSubject', [
//                'row' => \yii\helpers\ArrayHelper::toArray($model->userSubjects),
//            ]),
//        ],
//    ];
//    echo kartik\tabs\TabsX::widget([
//        'items' => $forms,
//        'position' => kartik\tabs\TabsX::POS_ABOVE,
//        'encodeLabels' => false,
//        'pluginOptions' => [
//            'bordered' => true,
//            'sideways' => true,
//            'enableCache' => false,
//        ],
//    ]);
    ?>
    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
