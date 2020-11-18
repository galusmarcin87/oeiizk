<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\TrainingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\yii\ActionColumn;

$this->title = Yii::t('app', 'Trainings');

if ($searchModel->dateType) {
  switch ($searchModel->dateType) {
    case 1:
      $this->title .= ' archiwalne';
      break;
    case 2:
      $this->title .= ' bieżące';
      break;
    case 3:
      $this->title .= ' przyszłe';
      break;
  }
}


$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="training-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?
    $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'create')):

      ?>
      <?= Html::a(Yii::t('app', 'Create Training'), ['create'], ['class' => 'btn btn-success']) ?>
    <? endif ?>
    <? if (!$searchModel->dateType || $searchModel->dateType == 1): ?>
      <?= Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
    <? endif ?>
    <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training-participant', 'import')): ?>
      <?=
      Html::a(Yii::t('app', 'Import uczestników'), ['oeiizk/training-participant/import'], [
          'class' => 'btn btn-info',
          'target' => '_blank'
          ]
      )

      ?>
    <? endif ?>
  </p>
  <div class="search-form" style="display:none">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
  </div>


  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      [
          'class' => ActionColumn::className(),
          'template' => '{save-as-new} {history} {view} {update} {delete}',
          'controller' => $controller,
          'buttons' => [
              'update' => function ($url, $model) {
                return $model->status != app\models\db\Training::STATUS_CLOSED ? \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'Update')]) : '';
              },
              'save-as-new' => function ($url) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => Yii::t('app', 'Save As New')]);
              },
              'history' => function ($url, $model) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-time"></span>', $url, [
                        'title' => Yii::t('app', 'history')]);
              },
          ],
      ],
//        [
//            'class' => 'kartik\grid\ExpandRowColumn',
//            'width' => '50px',
//            'value' => function ($model, $key, $index, $column) {
//                return GridView::ROW_COLLAPSED;
//            },
//            'detail' => function ($model, $key, $index, $column) {
//                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
//            },
//            'headerOptions' => ['class' => 'kartik-sheet-style'],
//            'expandOneOnly' => true
//        ],
      'name',
      'subtitle',
      [
          'attribute' => 'training_template_id',
          'label' => Yii::t('app', 'Training Template'),
          'value' => function($model) {
            return $model->trainingTemplate;
          },
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\db\TrainingTemplate::find()->asArray()->all(), 'id', 'name'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Training Template'), 'id' => 'grid-training-search-training_template_id']
      ],
      'code',
      'date_start',
      'date_end',
      'visibility',
      [
          'attribute' => 'status',
          'filter' => app\models\db\Training::STATUSES
      ],
//      'is_promoted_oeiizk:boolean',
//      'is_promoted_pos:boolean',
//      'is_display_on_screen:boolean',
      [
          'attribute' => 'lab_z',
          'label' => Yii::t('app', 'Lab'),
          'value' => function($model) {
            return $model->lab ? $model->lab->shorterName : '';
          },
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->asArray()->all(), 'id', 'name'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Lab'), 'id' => 'grid-training-search-lab_id']
      ],
      'trainingTemplate.hours_local',
      'trainingTemplate.hours_online',
      [
          'label' => 'Liczba uczestników',
          'value' => function($model) {
            return sizeof($model->trainingParticipants);
          },
      ],
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training']],
      'panel' => [
          'type' => GridView::TYPE_PRIMARY,
          'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
      ],
      // your toolbar can include the additional full export menu
      'toolbar' => [
          '{export}',
          ExportMenu::widget([
              'dataProvider' => $dataProvider,
              'columns' => $gridColumn,
              'target' => ExportMenu::TARGET_BLANK,
              'fontAwesome' => true,
              'dropdownOptions' => [
                  'label' => 'Full',
                  'class' => 'btn btn-default',
                  'itemsBefore' => [
                      '<li class="dropdown-header">Export All Data</li>',
                  ],
              ],
          ]),
      ],
  ]);

  ?>

</div>
