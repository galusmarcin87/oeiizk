<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->pollTemplateQuestions,
        'key' => function($model){
            return ['poll_template_id' => $model->poll_template_id, 'poll_question_id' => $model->poll_question_id];
        },
        'modelClass' => 'app\models\db\PollTemplateQuestion'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'pollTemplate.name',
                'label' => Yii::t('app', 'Poll Template')
            ],
        'order',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'poll-template-question'
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
