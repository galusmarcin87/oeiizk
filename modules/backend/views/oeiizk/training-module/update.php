<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingModule */

$this->title = Yii::t('app', 'Update Training Module') . ' ' . $model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="training-module-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
