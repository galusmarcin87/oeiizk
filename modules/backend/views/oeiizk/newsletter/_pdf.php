<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Newsletter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsletter'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsletter-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Newsletter').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'header:ntext',
        'footer:ntext',
        'text:ntext',
        'status',
        [
                'attribute' => 'group.name',
                'label' => Yii::t('app', 'Group')
            ],
        'keywords:ntext',
        'date_sent',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerNewsletterUser->totalCount){
    $gridColumnNewsletterUser = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'status',
        'info:ntext',
        'email:email',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerNewsletterUser,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Newsletter User')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnNewsletterUser
    ]);
}
?>
    </div>
</div>
