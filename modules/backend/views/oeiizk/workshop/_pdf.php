<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workshop */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Workshop').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'title',
        'description:ntext',
        'date_start',
        'date_end',
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
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
if($providerWorkshopLector->totalCount){
    $gridColumnWorkshopLector = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkshopLector,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workshop Lector')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkshopLector
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkshopUser->totalCount){
    $gridColumnWorkshopUser = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
                'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkshopUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workshop User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkshopUser
    ]);
}
?>
    </div>
</div>
