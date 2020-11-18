<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\PollTemplate */

$this->title = Yii::t('app', 'Create Poll Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poll Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
