<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingParticipant */

$this->title = Yii::t('app', 'Create Training Participant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Participants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-participant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
