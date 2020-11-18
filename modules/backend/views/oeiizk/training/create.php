<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

$this->title = Yii::t('app', 'Create Training');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
