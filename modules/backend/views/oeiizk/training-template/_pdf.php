<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingTemplate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-template-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Training Template').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
        [
                'attribute' => 'createdBy.username',
                'label' => Yii::t('app', 'Created By')
            ],
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
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerTrainingRequired->totalCount){
    $gridColumnTrainingRequired = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
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
</div>
