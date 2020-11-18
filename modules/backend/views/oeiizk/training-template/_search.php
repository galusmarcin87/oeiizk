<?php

use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-training-template-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field12md($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field12md($model, 'name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name')]) ?>

    <?= $form->field12md($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('subtitle')]) ?>

    <?= $form->field12md($model, 'type')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('type')]) ?>

    <?= $form->field12md($model, 'code_start')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('code_start')]) ?>

    <?php /* echo $form->field12md($model, 'educational_level')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('educational_level')]) */ ?>

    <?php /* echo $form->field12md($model, 'training_gruop')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_gruop')]) */ ?>

    <?php /* echo $form->field12md($model, 'training_path')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_path')]) */ ?>

    <?php /* echo $form->field($model, 'category_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Category')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'subcategory_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Category')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field12md($model, 'hours_local')->textInput(['placeholder' => $model->getAttributeLabel('hours_local')]) */ ?>

    <?php /* echo $form->field12md($model, 'hours_online')->textInput(['placeholder' => $model->getAttributeLabel('hours_online')]) */ ?>

    <?php /* echo $form->field12md($model, 'meeting_default_number')->textInput(['placeholder' => $model->getAttributeLabel('meeting_default_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'modules_default_number')->textInput(['placeholder' => $model->getAttributeLabel('modules_default_number')]) */ ?>

    <?php /* echo $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('app', 'Choose User')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field12md($model, 'created_on')->textInput(['placeholder' => $model->getAttributeLabel('created_on')]) */ ?>

    <?php /* echo $form->field12md($model, 'lead')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'program_file_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose File')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field12md($model, 'date_program_submission')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app',Yii::t('app', 'Choose Date Program Submission')),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field12md($model, 'date_last_program_modification')->textInput(['placeholder' => $model->getAttributeLabel('date_last_program_modification')]) */ ?>

    <?php /* echo $form->field12md($model, 'preliminary_recommendations')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'default_technical_requirements')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'default_social_requirements')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'image_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose File')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'image_2_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose File')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field12md($model, 'keywords')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'default_price_category')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('default_price_category')]) */ ?>

    <?php /* echo $form->field12md($model, 'visibility')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('visibility')]) */ ?>

    <?php /* echo $form->field12md($model, 'default_certificate_lines')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'default_minimal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('default_minimal_participants_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'default_maximal_participants_number')->textInput(['placeholder' => $model->getAttributeLabel('default_maximal_participants_number')]) */ ?>

    <?php /* echo $form->field12md($model, 'is_login_required')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'is_card_required')->checkbox() */ ?>

    <?php /* echo $form->field12md($model, 'is_certificate_issued')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'additional_information')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field12md($model, 'comments')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'poll_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Poll::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Poll')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'article_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Article::find()->orderBy('id')->asArray()->all(), 'id', 'title'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Article')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'subject_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Subject::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Subject')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
