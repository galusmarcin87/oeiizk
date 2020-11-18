<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->userEducationalLevels,
        'key' => function($model){
            return ['user_id' => $model->user_id, 'educational_level_id' => $model->educational_level_id];
        },
        'modelClass' => 'app\models\mgcms\db\UserEducationalLevel'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'educationalLevel.name',
                'label' => Yii::t('app', 'Educational Level')
            ],
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'user-educational-level'
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
