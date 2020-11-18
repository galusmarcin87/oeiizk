<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->userAgreements,
    'key' => function($model) {
      return ['agreement_id' => $model->agreement_id, 'user_id' => $model->user_id];
    },
    'modelClass' => 'app\models\db\UserAgreement'
    ]);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'user',
        'label' => Yii::t('app', 'User')
    ],
    'expiry_date',
    [
        'class' => app\components\mgcms\yii\ActionColumn::className(),
        'controller' => 'user-agreement'
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
