<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\NewsletterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;

$this->title = Yii::t('app', 'Newsletter');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="newsletter-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?
    $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'create')):

      ?>
      <?= Html::a(Yii::t('app', 'Create Newsletter'), ['create'], ['class' => 'btn btn-success']) ?>
    <? endif ?>
    <? Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
  </p>
  <div class="search-form" style="display:none">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
  </div>
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
      'status',
      [
          'attribute' => 'group_id',
          'label' => Yii::t('app', 'Group'),
          'value' => function($model) {
            return $model->group;
          },
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\db\Group::find()->asArray()->all(), 'id', 'name'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Group'), 'id' => 'grid-newsletter-search-group_id']
      ],
      'keywords:ntext',
      'date_sent',
      MgHelpers::getCRUDColumn()
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-newsletter']],
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
