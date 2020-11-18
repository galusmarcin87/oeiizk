<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\TrainingTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;
use app\models\db\TrainingTemplate;

$this->title = Yii::t('app', 'Training Templates');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="training-template-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?
    $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'create')):

      ?>
      <?= Html::a(Yii::t('app', 'Create Training Template'), ['create'], ['class' => 'btn btn-success']) ?>
    <? endif ?>
    <? //Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button'])   ?>
  </p>
  <div class="search-form" style="display:none">
    <? //  $this->render('_search', ['model' => $searchModel]);   ?>
  </div>
  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
//      [
//          'class' => 'kartik\grid\ExpandRowColumn',
//          'width' => '50px',
//          'value' => function ($model, $key, $index, $column) {
//            return GridView::ROW_COLLAPSED;
//          },
//          'detail' => function ($model, $key, $index, $column) {
//            return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
//          },
//          'headerOptions' => ['class' => 'kartik-sheet-style'],
//          'expandOneOnly' => true
//      ],
      ['attribute' => 'id', 'visible' => false],
      [
          'attribute' => 'type',
          'filter' => MgHelpers::dropdownDataFromSettings('Typy szkoleń')
      ],
      'code_start',
      'name',
      'training_gruop',
      'training_path',
      [
          'attribute' => 'category_id',
          'label' => Yii::t('app', 'Category'),
          'value' => function($model) {
            return $model->category;
          },
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->training()->withParent()->orderBy('id')->all(), 'id', 'name', 'parent.name'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Category'), 'id' => 'grid-training-template-search-category_id']
      ],
      [
          'attribute' => 'visibility',
          'filter' => array_combine(TrainingTemplate::VISIBILITIES, TrainingTemplate::VISIBILITIES)
      ],
      MgHelpers::getCRUDColumn()
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-template']],
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
