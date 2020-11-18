<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Lesson')),
        'content' => $this->render('_dataLesson', [
            'model' => $model,
            'row' => $model->lessons,
        ]),
    ],
                                        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Lector')),
        'content' => $this->render('_dataTrainingLector', [
            'model' => $model,
            'row' => $model->trainingLectors,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Module')),
        'content' => $this->render('_dataTrainingModule', [
            'model' => $model,
            'row' => $model->trainingModules,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Participant')),
        'content' => $this->render('_dataTrainingParticipant', [
            'model' => $model,
            'row' => $model->trainingParticipants,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Required')),
        'content' => $this->render('_dataTrainingRequired', [
            'model' => $model,
            'row' => $model->trainingRequireds,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Training Training Direction')),
        'content' => $this->render('_dataTrainingTrainingDirection', [
            'model' => $model,
            'row' => $model->trainingTrainingDirections,
        ]),
    ],
                [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Workshop')),
        'content' => $this->render('_dataWorkshop', [
            'model' => $model,
            'row' => $model->workshops,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
