<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Institution */

$this->title = Yii::t('app', 'Create Institution');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Institutions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
