<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\WorkshopUser */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workshop Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workshop-user-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Workshop User').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
<? $controller = Yii::$app->controller->id;
        if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'save-as-new')):?>   
        <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id], ['class' => 'btn btn-info']) ?>
    <?endif?>          
          
            
              <? $controller = Yii::$app->controller->id;
                if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id], ['class' => 'btn btn-primary']) ?>
              <?endif?>
              <? $controller = Yii::$app->controller->id;
              if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'delete')):?>
              <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id], [
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
        [
            'attribute' => 'user.username',
            'label' => Yii::t('app', 'User'),
        ],
        [
            'attribute' => 'workshop.title',
            'label' => Yii::t('app', 'Workshop'),
        ],
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>