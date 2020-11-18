<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */
/* @var $form app\components\mgcms\yii\ActiveForm */


\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'SqlQuery', 
        'relID' => 'sql-query', 
        'value' => \yii\helpers\Json::encode($model->sqlQueries),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

//\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//    'viewParams' => [
//        'class' => 'UserGroup', 
//        'relID' => 'user-group', 
//        'value' => \yii\helpers\Json::encode($model->userGroups),
//        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//    ]
//]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'UserRole', 
        'relID' => 'user-role', 
        'value' => \yii\helpers\Json::encode($model->userRoles),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

//\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//    'viewParams' => [
//        'class' => 'Workplace', 
//        'relID' => 'workplace', 
//        'value' => \yii\helpers\Json::encode($model->workplaces),
//        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//    ]
//]);

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('password')]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('first_name')]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('last_name')]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('role')]) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => $model->getAttributeLabel('status')]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

    <?= $form->field($model, 'created_on')->textInput(['placeholder' => $model->getAttributeLabel('created_on')]) ?>

    <?= $form->field($model, 'last_login')->textInput(['placeholder' => $model->getAttributeLabel('last_login')]) ?>

    <?= $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('address')]) ?>

    <?= $form->field($model, 'postcode')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('postcode')]) ?>

    <?= $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Birthdate')),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('auth_key')]) ?>

    <?= $form->field($model, 'is_password_change_accepted')->checkbox() ?>

    <?= $form->field($model, 'other_names')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('other_names')]) ?>

    <?= $form->field($model, 'gender')->textInput(['placeholder' => $model->getAttributeLabel('gender')]) ?>

    <?= $form->field($model, 'date_email_confirmation')->textInput(['placeholder' => $model->getAttributeLabel('date_email_confirmation')]) ?>

    <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('birth_place')]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('position')]) ?>

    <?= $form->field($model, 'educational_level')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('educational_level')]) ?>

    <?= $form->field($model, 'employment_card_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose File')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'date_card_verification')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date Card Verification')),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_card_submission')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date Card Submission')),
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'academic_title')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('academic_title')]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone')]) ?>

    <?= $form->field($model, 'is_special_account')->checkbox() ?>

    <?= $form->field($model, 'credibility')->textInput(['placeholder' => $model->getAttributeLabel('credibility')]) ?>

    <?= $form->field($model, 'is_newsletter')->checkbox() ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_not_logged_account')->checkbox() ?>

    <?= $form->field($model, 'training_preferences')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'training_preferences_keywords')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_preferences_keywords')]) ?>

    <?= $form->field($model, 'date_last_password_change')->textInput(['placeholder' => $model->getAttributeLabel('date_last_password_change')]) ?>

    <?php
    $forms = [
        

        
//        [
//            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'UserGroup')),
//            'content' => $this->render('_formUserGroup', [
//                'row' => \yii\helpers\ArrayHelper::toArray($model->userGroups),
//            ]),
//        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'UserRole')),
            'content' => $this->render('_formUserRole', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->userRoles),
            ]),
        ],

//        [
//            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Workplace')),
//            'content' => $this->render('_formWorkplace', [
//                'row' => \yii\helpers\ArrayHelper::toArray($model->workplaces),
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
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
