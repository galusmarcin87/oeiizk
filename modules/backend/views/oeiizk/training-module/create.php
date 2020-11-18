<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingModule */

$this->title = Yii::t('app', 'Create Training Module');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-module-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
