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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Training Template').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
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
        'name',
        'subtitle',
        'type',
        'code_start',
        'training_gruop',
        'training_path',
        [
            'attribute' => 'category',
            'label' => Yii::t('app', 'Category'),
        ],
        'hours_local',
        'hours_online',
        'meeting_default_number',
        'modules_default_number',
        [
            'attribute' => 'createdBy.username',
            'label' => Yii::t('app', 'Created By'),
        ],
        'created_on',
        'lead:raw',
        [
            'attribute' => 'programFile',
            'label' => Yii::t('app', 'Program File'),
            'format' => 'raw',
        ],
        'date_program_submission',
        'date_last_program_modification',
        'preliminary_recommendations:raw',
        'default_technical_requirements:raw',
        'default_social_requirements:raw',
        [
            'attribute' => 'imageFile',
            'label' => $model->getAttributeLabel('imageFile'),
            'format' => 'raw',
        ],
        [
            'attribute' => 'imageFile2',
            'label' =>  $model->getAttributeLabel('imageFile2'),
            'format' => 'raw',
        ],
        'keywords:ntext',
        'default_price_category',
        'visibility',
        'default_certificate_lines:ntext',
        'default_minimal_participants_number',
        'default_maximal_participants_number',
        'is_login_required:boolean',
        'is_card_required:boolean',
        'is_certificate_issued:boolean',
        'additional_information:raw',
        'comments:ntext',
        [
            'attribute' => 'poll.name',
            'label' => Yii::t('app', 'Poll'),
        ],
        [
            'attribute' => 'article.title',
            'label' => Yii::t('app', 'Article'),
        ],
        [
            'attribute' => 'subject.name',
            'label' => Yii::t('app', 'Subject'),
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-required']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Trainings Required')),
        ],
        'columns' => $gridColumnTrainingRequired
    ]);
}
?>
      
      <?php
if($providerTrainingTemplateEducationalLevel->totalCount){ 
    $gridColumnTrainingTemplateEducationalLevel = [ 
        ['class' => 'yii\grid\SerialColumn'], 
                        [ 
                'attribute' => 'educationalLevel.name', 
                'label' => Yii::t('app', 'Educational Level') 
            ],
    ]; 
    echo Gridview::widget([ 
        'dataProvider' => $providerTrainingTemplateEducationalLevel, 
        'pjax' => true, 
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-template-educational-level']], 
        'panel' => [ 
        'type' => GridView::TYPE_PRIMARY, 
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Educational Levels')), 
        ], 
        'columns' => $gridColumnTrainingTemplateEducationalLevel
    ]); 
} 
?>
    </div>
</div>