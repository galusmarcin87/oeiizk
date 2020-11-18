<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\WorkshopUser */

$this->title = Yii::t('app', 'Create Workshop User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshop Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
