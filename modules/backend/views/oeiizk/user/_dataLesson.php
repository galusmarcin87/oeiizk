<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->lessons,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'subject:ntext',
        'date_start',
        'date_end',
        'created_on',
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        'hours_count',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'lesson'
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
