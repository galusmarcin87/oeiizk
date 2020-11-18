<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\EducationalLevel */

$this->title = Yii::t('app', 'Create Educational Level');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Educational Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="educational-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
