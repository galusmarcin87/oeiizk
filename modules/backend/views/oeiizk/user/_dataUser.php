<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->users,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'username',
        'password',
        'first_name',
        'last_name',
        'role',
        'status',
        'email:email',
        'created_on',
        'last_login',
        'address',
        'postcode',
        'birthdate',
        'city',
        'auth_key',
        'is_password_change_accepted',
        'other_names',
        'gender',
        'date_email_confirmation:email',
        'birth_place',
        'position',
        'educational_level',
        [
                'attribute' => 'employmentCard.name',
                'label' => Yii::t('app', 'Employment Card')
            ],
        'date_card_verification',
        'date_card_submission',
        'academic_title',
        'phone',
        'is_special_account',
        'credibility',
        'is_newsletter',
        'comments:ntext',
        'is_not_logged_account',
        'training_preferences:ntext',
        'training_preferences_keywords',
        'date_last_password_change',
        [
            'class' => app\components\mgcms\yii\ActionColumn::className(),
            'controller' => 'user'
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
