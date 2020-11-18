<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainingModulePresences,
        'key' => function($model){
            return ['training_module_id' => $model->training_module_id, 'user_id' => $model->user_id];
        },
        'modelClass' => 'app\models\db\TrainingModulePresence'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'user',
                'label' => Yii::t('app', 'User')
            ],
        'note',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'training-module-presence'
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
