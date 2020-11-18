<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\SqlQuery */

$this->title = Yii::t('app', 'Create Sql Query');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sql Query'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sql-query-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
