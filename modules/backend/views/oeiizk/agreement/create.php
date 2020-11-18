<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Agreement */

$this->title = Yii::t('app', 'Create Agreement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
