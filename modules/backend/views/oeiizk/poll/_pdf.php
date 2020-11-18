<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Poll */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Poll').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        [
                'attribute' => 'pollTemplate.name',
                'label' => Yii::t('app', 'Poll Template')
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
if($providerPollPollQuestion->totalCount){
    $gridColumnPollPollQuestion = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'pollQuestion.name',
                'label' => Yii::t('app', 'Poll Question')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPollPollQuestion,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Poll Poll Question')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPollPollQuestion
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTraining->totalCount){
    $gridColumnTraining = [
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
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTraining,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Training')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTraining
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingTemplate->totalCount){
    $gridColumnTrainingTemplate = [
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
                'attribute' => 'imageFile.name',
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
</div>
