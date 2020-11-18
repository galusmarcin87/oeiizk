<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->trainingTemplates,
        'key' => 'id',
        'modelClass' => 'app\models\db\TrainingTemplate'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'subtitle',
        'type',
        'code_start',
        'educational_level',
        'training_gruop',
        'training_path',
        [
                'attribute' => 'category.name',
                'label' => Yii::t('app', 'Category')
            ],
        [
                'attribute' => 'subcategory.name',
                'label' => Yii::t('app', 'Subcategory')
            ],
        'hours_local',
        'hours_online',
        'meeting_default_number',
        'modules_default_number',
        'lead:ntext',
        [
                'attribute' => 'programFile.name',
                'label' => Yii::t('app', 'Program File')
            ],
        'date_program_submission',
        'date_last_program_modification',
        'preliminary_recommendations:ntext',
        'default_technical_requirements:ntext',
        'default_social_requirements:ntext',
        [
                'attribute' => 'image.name',
                'label' => Yii::t('app', 'Image')
            ],
        [
                'attribute' => 'imageFile2',
                'label' => Yii::t('app', 'Image 2')
            ],
        'keywords:ntext',
        'default_price_category',
        'visibility',
        'default_certificate_lines:ntext',
        'default_minimal_participants_number',
        'default_maximal_participants_number',
        'is_login_required',
        'is_card_required',
        'is_certificate_issued:ntext',
        'additional_information:ntext',
        'comments:ntext',
        [
                'attribute' => 'article.id',
                'label' => Yii::t('app', 'Article')
            ],
        [
                'attribute' => 'subject.name',
                'label' => Yii::t('app', 'Subject')
            ],
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'training-template'
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
