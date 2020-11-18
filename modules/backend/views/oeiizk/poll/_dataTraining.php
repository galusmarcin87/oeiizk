<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainings,
        'key' => 'id',
        'modelClass' => 'app\models\db\Training'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'subtitle',
        [
                'attribute' => 'trainingTemplate.name',
                'label' => Yii::t('app', 'Training Template')
            ],
        'code',
        'meeting_number',
        'module_number',
        'date_start',
        'date_end',
        'technical_requirements:ntext',
        'social_requirements:ntext',
        'visibility',
        'certificate_lines:ntext',
        'minimal_participants_number',
        'maximal_participants_number',
        'final_maximal_participants_number',
        'is_login_required',
        'status',
        'is_card_required',
        'is_certificate_issued:ntext',
        'additional_information:ntext',
        'comments:ntext',
        'sign_status',
        'is_promoted_oeiizk',
        'is_promoted_pos',
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
        'link_to_materials',
        [
                'attribute' => 'article.id',
                'label' => Yii::t('app', 'Article')
            ],
        [
                'attribute' => 'subject.name',
                'label' => Yii::t('app', 'Subject')
            ],
        'project',
        'is_display_on_screen',
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'training'
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
