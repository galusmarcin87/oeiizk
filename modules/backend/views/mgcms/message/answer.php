<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Message */
/* @var $form app\components\mgcms\yii\ActiveForm */


/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Message */

$this->title = Yii::t('app', 'Answer Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="message-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <h3>Pierwotny temat:<?= $model->messageParent->subject ?></h3>
  <?= $model->messageParent->message ?>


  <div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>


    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Answer') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  </div>


</div>
