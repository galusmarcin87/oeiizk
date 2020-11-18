<?php
use kartik\tabs\TabsX;
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;

/* @var $model \app\models\db\Training */
/* @var $users app\models\mgcms\db\User[] */

?>

<?=
Html::a(Yii::t('app', 'Ankieta zbiorcza PDF'), ['generate-poll-summary', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'target' => '_blank',
    ]
)

?>
<br/><br/>

<?
$items = [];
$items[] = [
    'label' => 'Ankieta zbiorcza',
    'content' => $this->render('_pollAnswerOverall', ['model' => $model]),
];


foreach ($userIds as $index => $userId) {
  $items[] = [
      'label' => $index + 1,
      'content' => $this->render('_pollAnswers', ['userId' => $userId, 'model' => $model]),
  ];
}

echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false
]);


