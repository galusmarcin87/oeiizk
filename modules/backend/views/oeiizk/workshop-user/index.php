<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\WorkshopUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;

$this->title = 'Uczestnicy warsztatów';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="workshop-user-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      [
          'attribute' => 'workshop_id',
          'label' => Yii::t('app', 'Workshop'),
          'value' => function($model) {
            return $model->workshop;
          },
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\db\Workshop::find()->asArray()->all(), 'id', 'title'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Workshop'), 'id' => 'grid-workshop-user-search-workshop_id']
      ],
      [
          'attribute' => 'trainingId',
          'value' => 'workshop.training.code',
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->asArray()->all(), 'id', 'code'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Training'), 'id' => 'grid-workshop-user-search-training']
      ],
      [
          'attribute' => 'userLastName',
          'label' => 'Nazwisko',
          'value' => function($model) {
            return $model->user ? $model->user->last_name : '';
          },
      ],
      [
          'attribute' => 'userFirstName',
          'label' => 'Imię',
          'value' => function($model) {
            return $model->user ? $model->user->first_name : '';
          },
      ],
      [
          'attribute' => 'userEmail',
          'label' => 'Email',
          'value' => function($model) {
            return $model->user ? $model->user->email : '';
          },
      ],
//        'status',
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workshop-user']],
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
