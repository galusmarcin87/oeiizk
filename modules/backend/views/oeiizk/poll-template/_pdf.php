<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\PollTemplate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poll Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-template-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Poll Template').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'text:ntext',
        'type',
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
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
if($providerPoll->totalCount){
    $gridColumnPoll = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerPoll,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPoll
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPollTemplateQuestion->totalCount){
    $gridColumnPollTemplateQuestion = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'pollQuestion.name',
                'label' => Yii::t('app', 'Poll Question')
            ],
        'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPollTemplateQuestion,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll Template Question')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPollTemplateQuestion
    ]);
}
?>
    </div>
</div>
