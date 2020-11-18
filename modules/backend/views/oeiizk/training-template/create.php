<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingTemplate */

$this->title = Yii::t('app', 'Create Training Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
