<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->lessonPresences,
        'key' => function($model){
            return ['training_lesson_id' => $model->training_lesson_id, 'user_id' => $model->user_id];
        },
        'modelClass' => 'app\models\db\LessonPresence'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'user',
                'label' => Yii::t('app', 'User')
            ],
        'note',
//        [
//            'class' => app\components\mgcms\yii\ActionColumn::className(),
//            'controller' => 'lesson-presence'
//        ],
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
