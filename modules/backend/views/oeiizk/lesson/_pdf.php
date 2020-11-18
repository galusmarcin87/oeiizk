<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Lesson */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Lesson').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'subject:ntext',
        'date_start',
        'date_end',
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
        'hours_count',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerLessonPresence->totalCount){
    $gridColumnLessonPresence = [
        ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user',
                'label' => Yii::t('app', 'User')
            ],
        'note',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerLessonPresence,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Lesson Presence')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnLessonPresence
    ]);
}
?>
    </div>
</div>
