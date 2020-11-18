<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\Workplace */

$this->title = Yii::t('app', 'Create Workplace');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workplaces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workplace-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
