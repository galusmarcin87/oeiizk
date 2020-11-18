<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->institutions,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_name',
        'code',
        'created_on',
        'patron',
        'city',
        'community',
        'county',
        'province',
        'street',
        'house_no',
        'postcode',
        'post',
        'phone',
        'www',
        'type',
        'is_verified',
        'territory',
        'school_group_name',
        'delegacy',
        'NIP',
        'email:email',
        'school_governing_body',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'institution'
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
