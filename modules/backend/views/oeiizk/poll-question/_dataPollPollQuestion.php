<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->pollPollQuestions,
        'key' => function($model){
            return ['poll_id' => $model->poll_id, 'poll_question_id' => $model->poll_question_id];
        },
        'modelClass' => 'app\models\db\PollPollQuestion'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'poll.name',
                'label' => Yii::t('app', 'Poll')
            ],
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'poll-poll-question'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
