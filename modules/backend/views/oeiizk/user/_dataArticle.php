<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->articles,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'title',
        'content:ntext',
        'slug',
        'excerpt:ntext',
        'language',
        'created_on',
        'updated_on',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
                [
                'attribute' => 'parent.title',
                'label' => Yii::t('app', 'Parent')
            ],
        [
                'attribute' => 'category.name',
                'label' => Yii::t('app', 'Category')
            ],
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
        'order',
        'promoted',
        'custom:ntext',
        'type',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'article'
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
