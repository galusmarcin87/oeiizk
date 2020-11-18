<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Event */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Event').' '. Html::encode($this->title) ?></h2>
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
        'name',
        'subtitle',
        'code',
        'info:raw',
        'link',
        'link_to_registration',
        'date_from',
        'date_to',
        [
            'attribute' => 'file',
            'label' => Yii::t('app', 'File'),
            'format' => 'raw'
        ],
        'promoted_oeiizk:boolean',
        'promoted_pos:boolean',
        'coments:ntext',
        'type',
        'is_display_on_screen:boolean',
        [
            'attribute' => 'lab.shorterName',
            'label' => Yii::t('app', 'Lab'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>