<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Subject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Subject').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'status',
        'group',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
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
                'attribute' => 'trainingTemplate.id',
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
                'attribute' => 'file.id',
                'label' => Yii::t('app', 'File')
            ],
        [
                'attribute' => 'poll.id',
                'label' => Yii::t('app', 'Poll')
            ],
        'link_to_materials',
        [
                'attribute' => 'article.id',
                'label' => Yii::t('app', 'Article')
            ],
                'project',
        'is_display_on_screen',
        [
                'attribute' => 'lab.id',
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
                'attribute' => 'category.id',
                'label' => Yii::t('app', 'Category')
            ],
        [
                'attribute' => 'subcategory.id',
                'label' => Yii::t('app', 'Subcategory')
            ],
        'hours_local',
        'hours_online',
        'meeting_default_number',
        'modules_default_number',
        'lead:ntext',
        [
                'attribute' => 'programFile.id',
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
                'attribute' => 'poll.id',
                'label' => Yii::t('app', 'Poll')
            ],
        [
                'attribute' => 'article.id',
                'label' => Yii::t('app', 'Article')
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
    
    <div class="row">
<?php
if($providerUserSubject->totalCount){
    $gridColumnUserSubject = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
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
if($providerWorkplaceSubject->totalCount){
    $gridColumnWorkplaceSubject = [
        ['class' => 'yii\grid\SerialColumn'],
        [
                'attribute' => 'workplace.id',
                'label' => Yii::t('app', 'Workplace')
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplaceSubject,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Workplace Subject')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnWorkplaceSubject
    ]);
}
?>
    </div>
</div>
