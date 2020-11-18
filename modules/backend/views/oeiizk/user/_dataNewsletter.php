<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->newsletters,
        'key' => 'id',
        'modelClass' => 'app\models\mgcms\db\Newsletter'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'created_on',
        'header:ntext',
        'footer:ntext',
        'text:ntext',
        'add_incoming_training_info',
        'status',
        [
                'attribute' => 'group.name',
                'label' => Yii::t('app', 'Group')
            ],
        'is_deleted',
        'keywords:ntext',
        'date_sent',
        'is_required_answer',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'newsletter'
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
