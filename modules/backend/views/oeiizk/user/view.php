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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'User').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<? $controller = Yii::$app->controller->id;
        if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'save-as-new')):?>   
        <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?endif?>          
          
            
              <? $controller = Yii::$app->controller->id;
                if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
              <?endif?>
              <? $controller = Yii::$app->controller->id;
              if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'delete')):?>
              <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                  'class' => 'btn btn-danger',
                  'data' => [
                      'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                      'method' => 'post',
                  ],
              ])
              ?>
              <?endif?>
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
        [
            'attribute' => 'createdBy.username',
            'label' => Yii::t('app', 'Created By'),
        ],
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
            'label' => Yii::t('app', 'Employment Card'),
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-article']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Article')),
        ],
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
            'type',
            'is_display_on_screen',
            [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEvent,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-event']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Event')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-gallery']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Gallery')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-institution']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Institution')),
        ],
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLab,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lab']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Lab')),
        ],
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLesson,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lesson']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Lesson')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lesson-presence']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Lesson Presence')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-log']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Log')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-message']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Message')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-modification-history']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Modification History')),
        ],
        'columns' => $gridColumnModificationHistory
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerNewsletterUser->totalCount){
    $gridColumnNewsletterUser = [
        ['class' => 'yii\grid\SerialColumn'],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-newsletter-user']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Newsletter User')),
        ],
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPolQuestionAnswer,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-pol-question-answer']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Pol Question Answer')),
        ],
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
                        [
                'attribute' => 'pollTemplate.name',
                'label' => Yii::t('app', 'Poll Template')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPoll,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Poll')),
        ],
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
                        'type',
            'question:ntext',
            'options_json:ntext',
            'is_individual',
            'is_required',
            'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPollQuestion,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll-question']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Poll Question')),
        ],
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
                        'text:ntext',
            'type',
            [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPollTemplate,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll-template']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Poll Template')),
        ],
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
                        'text:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerSmsTemplate,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sms-template']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Sms Template')),
        ],
        'columns' => $gridColumnSmsTemplate
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerSqlQuery->totalCount){
    $gridColumnSqlQuery = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'name',
            'query:ntext',
            'created_on',
                        'params:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerSqlQuery,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sql-query']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Sql Query')),
        ],
        'columns' => $gridColumnSqlQuery
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
            'created_on',
                        'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingDirection,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-direction']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Training Direction')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-lector']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Training Lector')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-module-presence']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Training Module Presence')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-participant']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Training Participant')),
        ],
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
                'attribute' => 'imageFile',
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingTemplate,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-template']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Training Template')),
        ],
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUser,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-agreement']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User Agreement')),
        ],
        'columns' => $gridColumnUserAgreement
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-group']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User Group')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-password']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User Password')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-role']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User Role')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-subject']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'User Subject')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workplace']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workplace')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workshop-lector']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workshop Lector')),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workshop-user']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workshop User')),
        ],
        'columns' => $gridColumnWorkshopUser
    ]);
}
?>
    </div>
</div>