<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingModule */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-module-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Training Module').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'subject',
        'date_start',
        'date_end',
        'description:ntext',
        'hours',
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingModulePresence->totalCount){
    $gridColumnTrainingModulePresence = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'note',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingModulePresence,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Module Presence')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingModulePresence
    ]);
}
?>
    </div>
</div>
