<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Institution */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Lab',
        'relID' => 'lab',
        'value' => \yii\helpers\Json::encode($model->labs),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Workplace',
        'relID' => 'workplace',
        'value' => \yii\helpers\Json::encode($model->workplaces),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="institution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="row">
        <?= $form->field12md($model, 'is_verified')->switchInput() ?>
        
        <?= $form->field6md($model, 'code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code')]) ?>
        
        <?= $form->field6md($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('short_name')]) ?>
        
        <?= $form->field6md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

        <?= $form->field6md($model, 'patron')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('patron')]) ?>

        <?= $form->field6md($model, 'city')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('city')]) ?>

        <?= $form->field6md($model, 'community')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('community')]) ?>

        <?= $form->field6md($model, 'county')->dropdownFromSettings('powiat') ?>

        <?= $form->field6md($model, 'province')->dropdownFromSettings('województwo') ?>
        
        <legend>Adres do korespondencji</legend>

        <?= $form->field6md($model, 'street')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('street')]) ?>

        <?= $form->field6md($model, 'house_no')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('house_no')]) ?>

        <?= $form->field6md($model, 'postcode')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('postcode')]) ?>

        <?= $form->field6md($model, 'post')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('post')]) ?>

        <?= $form->field12md($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('phone')]) ?>
        
         <?= $form->field6md($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form->field6md($model, 'www')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('www')]) ?>
        
        <legend>Pozostałe dane</legend>

        <?= $form->field6md($model, 'type')->dropdownFromSettings('typ placówki') ?>
        
        <?= $form->field6md($model, 'school_group_name')->textInput() ?>

        <?= $form->field6md($model, 'delegacy')->dropdownFromSettings('delegatura') ?>

        <?= $form->field6md($model, 'territory')->dropdownFromSettings('Obszary instytucji') ?>

        <?= $form->field6md($model, 'school_governing_body')->dropdownFromSettings('organ prowadzący') ?>
        
        <?= $form->field6md($model, 'NIP')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('NIP')]) ?>
    </div>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Lab')),
            'content' => $this->render('_formLab', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->labs),
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

    <?php ActiveForm::end(); ?>

</div>
