<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

?>
<div class="training-view">

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
        [
            'attribute' => 'trainingTemplate.name',
            'label' => Yii::t('app', 'Training Template'),
        ],
        'code',
        'meeting_number',
        'module_number',
        'date_start',
        'date_end',
        'technical_requirements:ntext',
        'social_requirements:ntext',
        'visibility',
        'certificate_lines:ntext',
        'minimal_participants_number',
        'maximal_participants_number',
        'final_maximal_participants_number',
        'is_login_required',
        'status',
        'is_card_required',
        'is_certificate_issued:ntext',
        'additional_information:ntext',
        'comments:ntext',
        'sign_status',
        'is_promoted_oeiizk',
        'is_promoted_pos',
        [
            'attribute' => 'file.name',
            'label' => Yii::t('app', 'File'),
        ],
        [
            'attribute' => 'poll.name',
            'label' => Yii::t('app', 'Poll'),
        ],
        'link_to_materials',
        [
            'attribute' => 'article.id',
            'label' => Yii::t('app', 'Article'),
        ],
        [
            'attribute' => 'subject.name',
            'label' => Yii::t('app', 'Subject'),
        ],
        'project',
        'is_display_on_screen',
        [
            'attribute' => 'lab.name',
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