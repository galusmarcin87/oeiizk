<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\mgcms\db\SqlQuerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Sql Query');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="sql-query-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <? $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess(str_replace(['mgcms/', 'oeizk/'], '', $controller), 'create')):

      ?><?= Html::a(Yii::t('app', 'Create Sql Query'), ['create'], ['class' => 'btn btn-success']) ?><? endif ?>
  </p>
  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      'name',
      'query:ntext',
      'params:ntext',
      [
          'class' => app\components\mgcms\yii\ActionColumn::className(),
          'template' => '{execute} {save-as-new} {view} {update} {delete}',
          'buttons' => [
              'save-as-new' => function ($url) {
                return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => Yii::t('app', 'Save As New')]);
              },
              'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id, 'hash' => $model->hash], ['title' => Yii::t('app', 'View')]);
              },
              'execute' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-play"></span>', ['view', 'id' => $model->id, 'hash' => $model->hash, 'execute' => 1], ['title' => Yii::t('app', 'View')]);
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
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sql-query']],
      'panel' => [
          'type' => GridView::TYPE_PRIMARY,
          'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
      ],
      'export' => false,
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
              'exportConfig' => [
                  ExportMenu::FORMAT_PDF => false
              ]
          ]),
      ],
  ]);

  ?>

</div>
