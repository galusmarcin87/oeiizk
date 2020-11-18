<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Training').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
        [
                'attribute' => 'poll.name',
                'label' => Yii::t('app', 'Poll')
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
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerLesson->totalCount){
    $gridColumnLesson = [
        ['class' => 'yii\grid\SerialColumn'],
        'subject:ntext',
        'date_start',
        'date_end',
                [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        'hours_count',
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
if($providerTrainingLector->totalCount){
    $gridColumnTrainingLector = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
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
if($providerTrainingModule->totalCount){
    $gridColumnTrainingModule = [
        ['class' => 'yii\grid\SerialColumn'],
        'subject',
        'date_start',
        'date_end',
        'description:ntext',
        'hours',
            ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingModule,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Module')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingModule
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingParticipant->totalCount){
    $gridColumnTrainingParticipant = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'order',
        'surname',
        'workplace',
        'status',
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
if($providerTrainingRequired->totalCount){
    $gridColumnTrainingRequired = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'trainingTemplate.name',
                'label' => Yii::t('app', 'Training Template')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingRequired,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Required')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingRequired
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingTrainingDirection->totalCount){
    $gridColumnTrainingTrainingDirection = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'trainingDirection.name',
                'label' => Yii::t('app', 'Training Direction')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTrainingTrainingDirection,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training Training Direction')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTrainingTrainingDirection
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerWorkshop->totalCount){
    $gridColumnWorkshop = [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'description:ntext',
        'date_start',
        'date_end',
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
                'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkshop,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workshop')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkshop
    ]);
}
?>
    </div>
</div>
