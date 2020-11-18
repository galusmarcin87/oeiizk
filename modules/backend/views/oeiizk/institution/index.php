<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\InstitutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use \app\models\mgcms\db\User;

$this->title = Yii::t('app', 'Institutions');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="institution-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?
    $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess(str_replace(['mgcms/', 'oeizk/'], '', $controller), 'create')):

      ?><?= Html::a(Yii::t('app', 'Create Institution'), ['create'], ['class' => 'btn btn-success']) ?><? endif ?>
    <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'import')): ?>
      <?= Html::a(Yii::t('app', 'Import from Excell'), ['import'], ['class' => 'btn btn-success']) ?>
    <? endif ?>
    <? // Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button'])   ?>
  </p>
  <div class="search-form" style="display:none">
    <? //  $this->render('_search', ['model' => $searchModel]);   ?>
  </div>
  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
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
      ['attribute' => 'id', 'visible' => false],
      'code',
      'name',
      'postcode',
      'post',
      'street',
      'house_no',
      'short_name',
      'is_verified:boolean',
      'labsStr',
//      'created_on',
      
//        'patron',
//        'city',
//        'community',
//        'county',
//        'province',
//        
//        
//        
//        
//        'phone',
//        'www',
//        'type',
      
//        'territory',
//        'school_group_name',
//        'delegacy',
//        'NIP',
//        'email:email',
//        'school_governing_body',
      [
          'class' => app\components\mgcms\yii\ActionColumn::className(),
          'template' => '{save-as-new} {history} {view} {update} {delete}',
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
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-institution']],
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
