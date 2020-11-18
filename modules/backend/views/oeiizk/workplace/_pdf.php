<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workplace */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workplaces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workplace-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Workplace').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'position',
        'school_type',
        'educational_level',
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
        [
                'attribute' => 'institution.name',
                'label' => Yii::t('app', 'Institution')
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
if($providerWorkplaceEducationalLevel->totalCount){
    $gridColumnWorkplaceEducationalLevel = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'educationalLevel.name',
                'label' => Yii::t('app', 'Educational Level')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplaceEducationalLevel,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workplace Educational Level')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkplaceEducationalLevel
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkplaceSubject->totalCount){
    $gridColumnWorkplaceSubject = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'subject.name',
                'label' => Yii::t('app', 'Subject')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplaceSubject,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workplace Subject')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkplaceSubject
    ]);
}
?>
    </div>
</div>
