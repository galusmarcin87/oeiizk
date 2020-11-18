<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Message */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Message'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Message').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
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
        'subject',
        'message:ntext',
        [
            'attribute' => 'sender',
            'label' => Yii::t('app', 'Sender'),
        ],
        [
            'attribute' => 'recipient',
            'label' => Yii::t('app', 'Recipient'),
        ],
        [
            'attribute' => 'messageParent.subject',
            'label' => Yii::t('app', 'Message'),
        ],
        'email:email',
        'is_read',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerMessage->totalCount){
    $gridColumnMessage = [
        ['class' => 'yii\grid\SerialColumn'],
            'subject',
            'message:ntext',
            [
                'attribute' => 'sender.id',
                'label' => Yii::t('app', 'Sender')
            ],
            [
                'attribute' => 'recipient.id',
                'label' => Yii::t('app', 'Recipient')
            ],
                        'email:email',
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
</div>