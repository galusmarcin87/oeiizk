<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\db\TrainingParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\yii\ActionColumn;

$this->title = Yii::t('app', 'Training Participants');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="training-participant-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <p>
    <?
    $controller = Yii::$app->controller->id;
    if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'create')):

      ?>
      <? // Html::a(Yii::t('app', 'Create Training Participant'), ['create'], ['class' => 'btn btn-success']) ?>
    <? endif ?>

  </p>

  <?php
  $gridColumn = [
      ['class' => 'yii\grid\SerialColumn'],
      ['attribute' => 'id', 'visible' => false],
      [
          'class' => ActionColumn::className(),
          'template' => '{update}',
          'controller' => $controller,
          'buttons' => [
              'update' => function ($url, $model) {
                  return  \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'Update')]);
              },
          ],
      ],
      'order',
      [
          'attribute' => 'training_id',
          'label' => Yii::t('app', 'Training'),
          'value' => function($model) {
            return $model->training ? $model->training->name : '';
          },
          'filterType' => GridView::FILTER_SELECT2,
          'filter' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->asArray()->all(), 'id', 'code'),
          'filterWidgetOptions' => [
              'pluginOptions' => ['allowClear' => true],
          ],
          'filterInputOptions' => ['placeholder' => Yii::t('app', 'Training'), 'id' => 'grid-training-participant-search-training_id'],
      ],
      [
          'attribute' => 'trainingCode',
          'label' => 'Kod',
          'value' => function($model) {
              return $model->training ? $model->training->code : '';
          },
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
      [
          'attribute' => 'status',
          'filter' => app\components\mgcms\MgHelpers::getSettingOptionArray('uczestnik - status')
      ],
      'created_on',
      'user.date_card_verification',
      'workplace',
      'paid_missing',
      'is_passed:boolean',
      'is_print_certificate:boolean',
      [
          'attribute' => 'userWorkplaceCode',
          'label' => 'Kod szkoły',
          'value' => function($model) {
            return $model->user ? $model->user->firstInstitutionCode : '';
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
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-participant']],
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
