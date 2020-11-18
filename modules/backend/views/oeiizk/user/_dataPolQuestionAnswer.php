<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->polQuestionAnswers,
        'key' => function($model){
            return ['poll_poll_question_poll_id' => $model->poll_poll_question_poll_id, 'poll_poll_question_poll_question_id' => $model->poll_poll_question_poll_question_id, 'user_id' => $model->user_id];
        }
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'pollPollQuestionPoll.poll_id',
                'label' => Yii::t('app', 'Poll Poll Question Poll')
            ],
        'poll_poll_question_poll_question_id',
        'answer',
        'answer_open:ntext',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'pol-question-answer'
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
