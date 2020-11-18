<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingDirection */

$this->title = Yii::t('app', 'Create Training Direction');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
