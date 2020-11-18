<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\PollQuestion */

$this->title = Yii::t('app', 'Create Poll Question');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poll Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
