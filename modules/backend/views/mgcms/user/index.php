<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\mgcms\db\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;

$this->title = Yii::t('app', 'Users');
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

  <p>
    <?
    $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'create')):

      ?><?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?><? endif ?>
    <? // Html::a(Yii::t('app', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
    <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'import')): ?>
      <?= Html::a(Yii::t('app', 'Import from Excell'), ['import'], ['class' => 'btn btn-success']) ?>
    <? endif ?>
  </p>
  <div class="search-form" style="display:none">
    <? //  $this->render('_search', ['model' => $searchModel]);   ?>
  </div>
  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      ['attribute' => 'id', 'visible' => true],
      'username',
      'first_name',
      'last_name',
      'email',
      [
          'header' => 'Szkoła',
          'value' => function($model) {
            return $model->institutions ? $model->institutions[0]->code : '';
          },
          'attribute' => 'searchInstitutionCode',
      ],
      [
          'attribute' => 'status',
          'value' => function($model) {
            return $model->statusStr;
          },
          'filter' => MgHelpers::arrayTranslateValues(\app\models\mgcms\db\User::STATUSES),
      ],
      'created_on',
      'last_login',
      [
          'class' => \kartik\grid\ActionColumn::className(),
          'template' => '{message} {export} {save-as-new} {history} {view} {update} {delete}',
          'buttons' => [
              'message' => function ($url, $model) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-envelope"></span>', ['mgcms/message/create', 'userId' => $model->id], ['title' => 'Napisz wiadomość']);
              },
              'export' => function ($url, $model) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['pdf', 'id' => $model->id], ['title' => 'Raport dla rodo', 'target' => '_blank',]);
              },
              'history' => function ($url, $model) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-time"></span>', $url, [
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
      'pjax' => false,
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
