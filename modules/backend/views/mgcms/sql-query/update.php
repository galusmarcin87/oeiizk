<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\SqlQuery */

$this->title = Yii::t('app', 'Update Sql Query') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sql Query'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'hash' => $model->hash]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>
<div class="sql-query-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?=
  $this->render('_form', [
      'model' => $model,
  ])

  ?>

</div>
