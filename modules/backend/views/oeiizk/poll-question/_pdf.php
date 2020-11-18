<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\PollQuestion */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poll Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-question-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Poll Question').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'type',
        'question:ntext',
        'options_json:ntext',
        'is_individual',
        'is_required',
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
if($providerPollPollQuestion->totalCount){
    $gridColumnPollPollQuestion = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'poll.name',
                'label' => Yii::t('app', 'Poll')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerPollPollQuestion,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll Poll Question')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPollPollQuestion
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
                'attribute' => 'pollTemplate.name',
                'label' => Yii::t('app', 'Poll Template')
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
