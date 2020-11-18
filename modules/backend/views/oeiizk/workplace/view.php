<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workplace */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workplaces')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workplace-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Workplace').' '. Html::encode($this->title) ?></h2>
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
        <? Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
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
        'position',
        'school_type',
        'educational_level',
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'User'),
        ],
        [
            'attribute' => 'institution.name',
            'label' => Yii::t('app', 'Institution'),
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
if($providerWorkplaceEducationalLevel->totalCount){
    $gridColumnWorkplaceEducationalLevel = [
        ['class' => 'yii\grid\SerialColumn'],
                        [
                'attribute' => 'educationalLevel.name',
                'label' => Yii::t('app', 'Educational Level')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplaceEducationalLevel,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workplace-educational-level']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workplace Educational Level')),
        ],
        'columns' => $gridColumnWorkplaceEducationalLevel
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
                'attribute' => 'subject.name',
                'label' => Yii::t('app', 'Subject')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerWorkplaceSubject,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workplace-subject']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workplace Subject')),
        ],
        'columns' => $gridColumnWorkplaceSubject
    ]);
}
?>
    </div>
</div>