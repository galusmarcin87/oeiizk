<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'User').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
        'date_last_password_change',
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
        'is_deleted',
        'is_not_logged_account',
        'training_preferences:ntext',
        'training_preferences_keywords',
        'create_account_additional_data',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerArticle->totalCount){
    $gridColumnArticle = [
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerArticle,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Article')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnArticle
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerEvent->totalCount){
    $gridColumnEvent = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'subtitle',
        'created_on',
        'code',
        'info:ntext',
        'link',
        'link_to_registration',
        'date_from',
        'date_to',
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
        'promoted_oeiizk',
        'promoted_pos',
        'coments:ntext',
        'is_deleted',
        'type',
        'is_display_on_screen',
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEvent,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Event')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEvent
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGallery->totalCount){
    $gridColumnGallery = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'slug',
        'created_on',
        'order',
        'description:ntext',
        'promoted',
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGallery,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Gallery')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnGallery
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerInstitution->totalCount){
    $gridColumnInstitution = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_name',
        'code',
        'created_on',
        'is_deleted',
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInstitution,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Institution')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInstitution
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerLab->totalCount){
    $gridColumnLab = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_headquarter_name',
        [
                'attribute' => 'institution.name',
                'label' => Yii::t('app', 'Institution')
            ],
        'long_name:ntext',
        'floor',
        'is_our',
        'created_on',
        'is_deleted',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLab,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Lab')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnLab
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerLesson->totalCount){
    $gridColumnLesson = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'subject:ntext',
        'date_start',
        'date_end',
        'created_on',
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        'hours_count',
        'is_deleted',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLesson,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Lesson')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnLesson
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerLessonPresence->totalCount){
    $gridColumnLessonPresence = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'trainingLesson.id',
                'label' => Yii::t('app', 'Training Lesson')
            ],
                'note',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLessonPresence,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Lesson Presence')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnLessonPresence
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerLog->totalCount){
    $gridColumnLog = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'created_on',
        'type',
        'text:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLog,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Log')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnLog
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerMessage->totalCount){
    $gridColumnMessage = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'subject',
        'message:ntext',
                        [
                'attribute' => 'message0.message',
                'label' => Yii::t('app', 'Message')
            ],
        'email:email',
        'created_on',
        'is_read',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerMessage,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Message')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnMessage
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerModificationHistory->totalCount){
    $gridColumnModificationHistory = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'created_on',
        'model_class',
        'model_id',
        'previous_model:ntext',
        'model:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModificationHistory,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Modification History')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnModificationHistory
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerNewsletter->totalCount){
    $gridColumnNewsletter = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'created_on',
        'header:ntext',
        'footer:ntext',
        'text:ntext',
        'add_incoming_training_info',
        'status',
        [
                'attribute' => 'group.name',
                'label' => Yii::t('app', 'Group')
            ],
        'is_deleted',
        'keywords:ntext',
        'date_sent',
        'is_required_answer',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerNewsletter,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Newsletter')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnNewsletter
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerNewsletterUser->totalCount){
    $gridColumnNewsletterUser = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'newsletter.name',
                'label' => Yii::t('app', 'Newsletter')
            ],
                'status',
        'info:ntext',
        'email:email',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerNewsletterUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Newsletter User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnNewsletterUser
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPolQuestionAnswer->totalCount){
    $gridColumnPolQuestionAnswer = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'pollPollQuestionPoll.poll_id',
                'label' => Yii::t('app', 'Poll Poll Question Poll')
            ],
        'poll_poll_question_poll_question_id',
                'answer',
        'answer_open:ntext',
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPolQuestionAnswer,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Pol Question Answer')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPolQuestionAnswer
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPoll->totalCount){
    $gridColumnPoll = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'created_on',
        'is_deleted',
        [
                'attribute' => 'pollTemplate.name',
                'label' => Yii::t('app', 'Poll Template')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPoll,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPoll
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPollQuestion->totalCount){
    $gridColumnPollQuestion = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'created_on',
        'is_deleted',
        'type',
        'question:ntext',
        'options_json:ntext',
        'is_individual',
        'is_required',
        'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPollQuestion,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll Question')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPollQuestion
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPollTemplate->totalCount){
    $gridColumnPollTemplate = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'created_on',
        'is_deleted',
        'text:ntext',
        'type',
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPollTemplate,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll Template')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPollTemplate
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerSmsTemplate->totalCount){
    $gridColumnSmsTemplate = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'created_on',
        'is_deleted',
        'text:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerSmsTemplate,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Sms Template')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnSmsTemplate
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerSqlQueryUser->totalCount){
    $gridColumnSqlQueryUser = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'sqlQuery.name',
                'label' => Yii::t('app', 'Sql Query')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerSqlQueryUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Sql Query User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnSqlQueryUser
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingDirection->totalCount){
    $gridColumnTrainingDirection = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'is_deleted',
        'created_on',
        'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingDirection,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Direction')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingDirection
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingLector->totalCount){
    $gridColumnTrainingLector = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingLector,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Lector')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingLector
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingModulePresence->totalCount){
    $gridColumnTrainingModulePresence = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'trainingModule.id',
                'label' => Yii::t('app', 'Training Module')
            ],
                'note',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingModulePresence,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Module Presence')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingModulePresence
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingParticipant->totalCount){
    $gridColumnTrainingParticipant = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
                'order',
        'surname',
        'workplace',
        'status',
        'created_on',
        'is_reserve',
        'is_paid',
        'paid_missing',
        'is_passed',
        'is_print_certificate',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingParticipant,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Participant')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingParticipant
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingTemplate->totalCount){
    $gridColumnTrainingTemplate = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'subtitle',
        'is_deleted',
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
        'created_on',
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
                'attribute' => 'image2.name',
                'label' => Yii::t('app', 'Image 2')
            ],
        'keywords:ntext',
        'default_price_category:ntext',
        'visibility',
        'default_certificate_lines:ntext',
        'default_minimal_participants_number',
        'default_maximal_participants_number',
        'is_login_required',
        'is_card_required',
        'is_certificate_issued',
        'additional_information:ntext',
        'comments:ntext',
        [
                'attribute' => 'poll.name',
                'label' => Yii::t('app', 'Poll')
            ],
        [
                'attribute' => 'article.title',
                'label' => Yii::t('app', 'Article')
            ],
        [
                'attribute' => 'subject.name',
                'label' => Yii::t('app', 'Subject')
            ],
        'sign_status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingTemplate,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Template')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingTemplate
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUser->totalCount){
    $gridColumnUser = [
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
        'date_last_password_change',
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
        'is_deleted',
        'is_not_logged_account',
        'training_preferences:ntext',
        'training_preferences_keywords',
        'create_account_additional_data',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUser
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserAgreement->totalCount){
    $gridColumnUserAgreement = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'agreement.name',
                'label' => Yii::t('app', 'Agreement')
            ],
                'created_on',
        'expiry_date',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUserAgreement,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Agreement')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserAgreement
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserEducationalLevel->totalCount){
    $gridColumnUserEducationalLevel = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'educationalLevel.name',
                'label' => Yii::t('app', 'Educational Level')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUserEducationalLevel,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Educational Level')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserEducationalLevel
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserGroup->totalCount){
    $gridColumnUserGroup = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'group.name',
                'label' => Yii::t('app', 'Group')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerUserGroup,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Group')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserGroup
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserPassword->totalCount){
    $gridColumnUserPassword = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'created_on',
                'password',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUserPassword,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Password')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserPassword
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserRole->totalCount){
    $gridColumnUserRole = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'role.name',
                'label' => Yii::t('app', 'Role')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerUserRole,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Role')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserRole
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerUserSubject->totalCount){
    $gridColumnUserSubject = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'subject.name',
                'label' => Yii::t('app', 'Subject')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerUserSubject,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Subject')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserSubject
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkplace->totalCount){
    $gridColumnWorkplace = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'position',
        'school_type',
        'educational_level',
                [
                'attribute' => 'institution.name',
                'label' => Yii::t('app', 'Institution')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplace,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workplace')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkplace
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkshopLector->totalCount){
    $gridColumnWorkshopLector = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'workshop.title',
                'label' => Yii::t('app', 'Workshop')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkshopLector,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workshop Lector')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkshopLector
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkshopUser->totalCount){
    $gridColumnWorkshopUser = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'workshop.title',
                'label' => Yii::t('app', 'Workshop')
            ],
        'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkshopUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workshop User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkshopUser
    ]);
}
?>
    </div>
</div>
