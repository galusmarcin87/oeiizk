<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Sieci współpracy - OEIIZK';

?>


<section class="events-list list">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Sieci współpracy</h1>
      </div>

    </div>
    <?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'list-view row'],
        'itemOptions' => ['class' => 'item'],
        'emptyTextOptions' => ['class' => 'col-md-12'],
        'itemView' => function ($model, $key, $index, $widget) {
          return $this->render('/training/_index2', ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this, 'type' => 'cn']);
        },
    ])

    ?>  
  </div>
</section>
