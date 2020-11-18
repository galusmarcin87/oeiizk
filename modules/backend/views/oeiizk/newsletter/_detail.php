<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Newsletter */

?>
<div class="newsletter-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'text:ntext',
        'add_incoming_training_info',
        'status',
        [
            'attribute' => 'group.name',
            'label' => Yii::t('app', 'Group'),
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
</div>