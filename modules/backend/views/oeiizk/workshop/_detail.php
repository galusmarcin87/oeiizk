<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Workshop */

?>
<div class="workshop-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'title',
        'description:ntext',
        'date_start',
        'date_end',
        [
            'attribute' => 'lab.name',
            'label' => Yii::t('app', 'Lab'),
        ],
        [
            'attribute' => 'training.name',
            'label' => Yii::t('app', 'Training'),
        ],
        'order',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>