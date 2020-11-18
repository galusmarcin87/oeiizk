<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\models\db\Training;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

$this->title = Yii::t('app', 'Update Training') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="training-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <div class="training-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
      <?= $form->field6md($model, 'status')->dropDownList(array_combine(Training::STATUSES, Training::STATUSES)) ?>
    </div>
    <div class="form-group">
      <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

        ?>
      <?php endif; ?>

    </div>

    <?php ActiveForm::end(); ?>

  </div>


</div>
