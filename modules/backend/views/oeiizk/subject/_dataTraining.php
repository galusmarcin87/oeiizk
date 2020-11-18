<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainings,
        'key' => 'id',
        'modelClass' => app\models\db\Training::className()
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'subtitle',
        'code',
        'date_start',
        'date_end',
    
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
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
