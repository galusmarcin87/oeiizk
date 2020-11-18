<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->lessons,
        'key' => 'id',
        'modelClass' => 'app\models\db\Lesson'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'subject:ntext',
        'date_start',
        'date_end',
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
