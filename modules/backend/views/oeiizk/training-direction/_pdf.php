<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingDirection */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-direction-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Training Direction').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'order',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingTrainingDirection->totalCount){
    $gridColumnTrainingTrainingDirection = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingTrainingDirection,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Training Direction')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingTrainingDirection
    ]);
}
?>
    </div>
</div>
