<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Event */

?>
<div class="event-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
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
            'attribute' => 'file.name',
            'label' => Yii::t('app', 'File'),
        ],
        'promoted_oeiizk:boolean',
        'promoted_pos:boolean',
        'coments:ntext',
        'type',
        'is_display_on_screen:boolean',
        [
            'attribute' => 'lab',
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