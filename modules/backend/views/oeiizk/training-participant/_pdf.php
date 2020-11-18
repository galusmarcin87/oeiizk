<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\TrainingParticipant */

$this->title = $model->training_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Participants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-participant-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Training Participant').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'training.name',
                'label' => Yii::t('app', 'Training')
            ],
        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
        'order',
        'surname',
        'workplace',
        'status',
        'created_on',
        'is_reserve',
        'is_paid',
        'paid_missing',
        'is_passed',
        'is_print_certificate',
        [
                'attribute' => 'createdBy.username',
                'label' => Yii::t('app', 'Created By')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
