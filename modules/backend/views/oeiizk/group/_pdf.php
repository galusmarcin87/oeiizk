<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Group').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerNewsletter->totalCount){
    $gridColumnNewsletter = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'header:ntext',
        'footer:ntext',
        'text:ntext',
        'add_incoming_training_info',
        'status',
                'keywords:ntext',
        'date_sent',
        'is_required_answer',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerNewsletter,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Newsletter')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnNewsletter
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserGroup->totalCount){
    $gridColumnUserGroup = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUserGroup,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Group')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserGroup
    ]);
}
?>
    </div>
</div>
