<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainingParticipants,
        'key' => 'id',
        'modelClass' => 'app\models\db\TrainingParticipant'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'order',
        'surname',
        'workplace',
        'status',
        'is_reserve:boolean',
        'is_paid:boolean',
        'paid_missing',
        'is_passed:boolean',
        'is_print_certificate:boolean',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'training-participant'
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
