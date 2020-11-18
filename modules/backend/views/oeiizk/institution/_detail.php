<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Institution */

?>
<div class="institution-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_name',
        'code',
        'created_on',
        [
            'attribute' => 'createdBy.username',
            'label' => Yii::t('app', 'Created By'),
        ],
        'patron',
        'city',
        'community',
        'county',
        'province',
        'street',
        'house_no',
        'postcode',
        'post',
        'phone',
        'www',
        'type',
        'is_verified:boolean',
        'territory',
        'school_group_name',
        'delegacy',
        'NIP',
        'email:email',
        'school_governing_body',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>