<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Poll */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' =>  Yii::t('app', 'Poll'),
]). ' ' . $model->name;


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="poll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
