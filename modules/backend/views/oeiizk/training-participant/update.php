<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingParticipant */

$this->title = Yii::t('app', 'Update Training Participant') . ' ' . $model->training_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Participants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->training_id, 'url' => ['view', 'training_id' => $model->training_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="training-participant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
