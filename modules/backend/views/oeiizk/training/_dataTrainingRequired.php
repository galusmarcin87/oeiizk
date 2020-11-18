<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainingRequireds,
        'key' => function($model){
            return ['training_2_id' => $model->training_2_id, 'training_id' => $model->training_id];
        },
        'modelClass' => 'app\models\db\TrainingRequired'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'training2',
                'label' => Yii::t('app', 'Training Template')
            ],
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'training-required'
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
