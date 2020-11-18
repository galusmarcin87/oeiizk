<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Event */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Event').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'name',
        'subtitle',
        'code',
        'info:ntext',
        'link',
        'link_to_registration',
        'date_from',
        'date_to',
        [
                'attribute' => 'file.name',
                'label' => Yii::t('app', 'File')
            ],
        'promoted_oeiizk',
        'promoted_pos',
        'coments:ntext',
        'type',
        'is_display_on_screen',
        [
                'attribute' => 'lab.name',
                'label' => Yii::t('app', 'Lab')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
