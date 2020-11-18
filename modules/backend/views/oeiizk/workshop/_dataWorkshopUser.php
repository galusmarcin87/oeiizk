<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->workshopUsers,
        'key' => function($model){
            return ['user_id' => $model->user_id, 'workshop_id' => $model->workshop_id];
        },
        'modelClass' => 'app\models\db\WorkshopUser'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'status',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'workshop-user'
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
