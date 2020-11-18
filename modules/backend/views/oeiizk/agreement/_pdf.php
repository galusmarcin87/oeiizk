<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Agreement */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreement-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Agreement').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'text:ntext',
        'order',
        'is_required',
        'is_cancel',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerUserAgreement->totalCount){
    $gridColumnUserAgreement = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        'expiry_date',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUserAgreement,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Agreement')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserAgreement
    ]);
}
?>
    </div>
</div>
