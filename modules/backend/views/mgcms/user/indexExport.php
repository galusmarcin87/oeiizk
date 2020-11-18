<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\mgcms\db\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;

$this->title = 'Export danych';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="user-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


  <div class="search-form" style="display:none">
    <? //  $this->render('_search', ['model' => $searchModel]);   ?>
  </div>
  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      ['attribute' => 'id', 'visible' => false],
      'username',
      'first_name',
      'last_name',
      'email',
      [
          'class' => \kartik\grid\ActionColumn::className(),
          'template' => '{message} {export} {view} {update} {delete} ',
          'buttons' => [
              'message' => function ($url, $model) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-envelope"></span>', 
                    ['mgcms/message/create', 'userId' => $model->id], ['title' => 'Napisz wiadomość']);
              },
              'export' => function ($url, $model) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-list-alt"></span>', 
                    ['pdf', 'id' => $model->id], ['title' => 'Raport dla rodo','target' => '_blank',]);
              },
          ],
      ]
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user']],
      'panel' => [
          'type' => GridView::TYPE_PRIMARY,
          'heading' => '<span class="glyphicon glyphicon-user"></span>  ' . Html::encode($this->title),
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
