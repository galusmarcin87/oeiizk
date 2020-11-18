<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workshop */

$this->title = Yii::t('app', 'Update Workshop') . ' ' . $model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="workshop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
