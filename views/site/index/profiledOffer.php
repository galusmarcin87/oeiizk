<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\widgets\ListView;
use app\models\db\TrainingSearch;
use app\models\db\TrainingTemplate;

$this->title = 'OEIIZK';

$user = MgHelpers::getUserModel();
if (!$user) {
  return false;
}
//echo '<pre>';
//echo var_dump(Yii::$app->request->get('page', 0));
//echo '</pre>';
//exit;
if (!$user->is_profiled_offer_enabled
    || isset(Yii::$app->request->queryParams['orderName'])
    || Yii::$app->request->get('page', 0) > 1
) {
  return false;
}

Yii::$app->session['profiledIds'] = [];

?>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    var elem = {};
    $('.offer .item-inner').each(function () {
      var txt = $(this).attr('id');
      if (elem[txt])
        $(this).parent().remove();
      else
        elem[txt] = true;
    });

  }, false);
</script>
<?
$trainingTemplateIds = [];
foreach ($user->trainingParticipants as $trPart) {
  if ($trPart->training && $trPart->training->trainingTemplate) {
    $trainingTemplateIds[] = $trPart->training->trainingTemplate->id;
  }
}

$searchModel = new TrainingSearch();
$searchModel->notTypes = [TrainingTemplate::TYPE_KONFERENCJA, TrainingTemplate::TYPE_SIECI_WSPOLPRACY];
$searchModel->trainingTemplateIds = $trainingTemplateIds;
$dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams);
$dataProvider->pagination = false;

Yii::$app->session['profiledIds'] = array_merge(Yii::$app->session['profiledIds'], array_map(function($model){
  return $model->id;
}, $dataProvider->getModels()));



echo ListView::widget([
    'dataProvider' => $dataProvider,
    'summary' => '',
    'emptyText' => '',
    'options' => ['class' => 'list-view', 'tag' => false],
    'itemOptions' => ['class' => 'item', 'tag' => false],
    'emptyTextOptions' => ['class' => '', 'tag' => false],
    'itemView' => function ($model, $key, $index, $widget) {
      return $this->render('/training/_index',
              ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
    },
]);


$subjectsIds = [];
foreach ($user->subjects as $subject) {
  $subjectsIds[] = $subject->id;
}

$searchModel = new TrainingSearch();
$searchModel->notTypes = [TrainingTemplate::TYPE_KONFERENCJA, TrainingTemplate::TYPE_SIECI_WSPOLPRACY];
$searchModel->subjects = $subjectsIds;
$dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams);
$dataProvider->pagination = false;

Yii::$app->session['profiledIds'] = array_merge(Yii::$app->session['profiledIds'], array_map(function($model){
  return $model->id;
}, $dataProvider->getModels()));

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'summary' => '',
    'emptyText' => '',
    'options' => ['class' => 'list-view', 'tag' => false],
    'itemOptions' => ['class' => 'item', 'tag' => false],
    'emptyTextOptions' => ['class' => '', 'tag' => false],
    'itemView' => function ($model, $key, $index, $widget) {
      return $this->render('/training/_index',
              ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
    },
]);

$delegacy = false;
if (isset($user->workplaces[0])) {
  if ($user->workplaces[0]->institution) {
    $delegacy = $user->workplaces[0]->institution->delegacy;
  }
}

if ($delegacy) {
  $searchModel = new TrainingSearch();
  $searchModel->notTypes = [TrainingTemplate::TYPE_KONFERENCJA, TrainingTemplate::TYPE_SIECI_WSPOLPRACY];
  $searchModel->delegacy = $delegacy;
  $dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams);
  $dataProvider->pagination = false;
  
  Yii::$app->session['profiledIds'] = array_merge(Yii::$app->session['profiledIds'], array_map(function($model){
  return $model->id;
}, $dataProvider->getModels()));


  echo ListView::widget([
      'dataProvider' => $dataProvider,
      'summary' => '',
      'emptyText' => '',
      'options' => ['class' => 'list-view', 'tag' => false],
      'itemOptions' => ['class' => 'item', 'tag' => false],
      'emptyTextOptions' => ['class' => '', 'tag' => false],
      'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('/training/_index',
                ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
      },
  ]);
}

?>  

