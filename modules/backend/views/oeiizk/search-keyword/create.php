<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\db\SearchKeyword */

$this->title = Yii::t('app', 'Create Search Keyword');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Search Keywords'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-keyword-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
