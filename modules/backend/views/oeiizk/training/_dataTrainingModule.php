<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainingModules,
        'key' => 'id',
        'modelClass' => 'app\models\db\TrainingModule'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'subject',
        'date_start',
        'date_end',
        'description:ntext',
        'hours',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'training-module'
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
