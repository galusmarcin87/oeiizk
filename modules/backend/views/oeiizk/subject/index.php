<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;

$this->title = Yii::t('app', 'Subjects');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="subject-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <? $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'create')):

      ?>
      <?= Html::a(Yii::t('app', 'Create Subject'), ['create'], ['class' => 'btn btn-success']) ?>
  <? endif ?>
  </p>
  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      [
          'class' => 'kartik\grid\ExpandRowColumn',
          'width' => '50px',
          'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
          },
          'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
          },
          'headerOptions' => ['class' => 'kartik-sheet-style'],
          'expandOneOnly' => true
      ],
      'name',
      [
          'attribute' => 'status',
          'value' => function($model) {
            return $model->statusStr;
          },
          'filter' => MgHelpers::arrayTranslateValues(\app\models\db\Subject::STATUSES),
      ],
      'group',
      [
          'class' => app\components\mgcms\yii\ActionColumn::className(),
          'template' => '{save-as-new} {history}  {view} {update} {delete}',
          'buttons' => [
              'save-as-new' => function ($url) {
                return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => Yii::t('app', 'Save As New')]);
              },
              'history' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-time"></span>', $url, [
                        'title' => Yii::t('app', 'history')]);
              },
          ],
      ],
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-subject']],
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
