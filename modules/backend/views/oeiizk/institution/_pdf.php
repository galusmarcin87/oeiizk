<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Institution */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Institutions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Institution').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_name',
        'code',
        'created_on',
        [
                'attribute' => 'createdBy.username',
                'label' => Yii::t('app', 'Created By')
            ],
        'patron',
        'city',
        'community',
        'county',
        'province',
        'street',
        'house_no',
        'postcode',
        'post',
        'phone',
        'www',
        'type',
        'is_verified',
        'territory',
        'school_group_name',
        'delegacy',
        'NIP',
        'email:email',
        'school_governing_body',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerLab->totalCount){
    $gridColumnLab = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_headquarter_name',
                'long_name:ntext',
        'floor',
        'is_our',
        [
                'attribute' => 'createdBy.username',
                'label' => Yii::t('app', 'Created By')
            ],
        'created_on',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLab,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Lab')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnLab
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkplace->totalCount){
    $gridColumnWorkplace = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'position',
        'school_type',
        'educational_level',
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplace,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workplace')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkplace
    ]);
}
?>
    </div>
</div>
