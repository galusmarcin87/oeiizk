<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->newsletterUsers,
        'key' => function($model){
            return ['newsletter_id' => $model->newsletter_id, 'user_id' => $model->user_id];
        },
        'modelClass' => 'app\models\db\NewsletterUser'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'status',
        'info:ntext',
        'email:email',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'newsletter-user'
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
