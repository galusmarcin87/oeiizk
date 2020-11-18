<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Lesson */

?>
<div class="lesson-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'subject:ntext',
        'date_start',
        'date_end',
        [
            'attribute' => 'training',
            'label' => Yii::t('app', 'Training'),
        ],
        [
            'attribute' => 'lab',
            'label' => Yii::t('app', 'Lab'),
        ],
        'hours_count',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>