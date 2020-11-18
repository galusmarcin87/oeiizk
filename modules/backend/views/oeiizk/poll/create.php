<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Poll */

$this->title = Yii::t('app', 'Create Poll');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
