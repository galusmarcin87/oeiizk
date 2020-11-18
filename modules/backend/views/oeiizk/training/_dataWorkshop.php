<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->workshops,
        'key' => 'id',
        'modelClass' => 'app\models\db\Workshop'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'description:ntext',
        'date_start',
        'date_end',
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        'order',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'workshop'
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
