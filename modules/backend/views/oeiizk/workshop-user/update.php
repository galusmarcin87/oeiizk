<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\WorkshopUser */

$this->title = Yii::t('app', 'Update Workshop User') . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshop Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="workshop-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
