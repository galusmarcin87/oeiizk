<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\PollQuestion */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poll Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="poll-question-view">

  <div class="row">
    <div class="col-sm-8">
      <h2><?= Yii::t('app', 'Poll Question') . ' ' . Html::encode($this->title) ?></h2>
    </div>
    <div class="col-sm-4" style="margin-top: 15px">
      <?=
      Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), ['pdf', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'target' => '_blank',
          'data-toggle' => 'tooltip',
          'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
          ]
      )

      ?>
      <?
      $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'save-as-new')):

        ?>   
        <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
      <? endif ?>          


      <?
      $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):

        ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <? endif ?>
      <?
      $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'delete')):

        ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])

        ?>
      <? endif ?>
    </div>
  </div>

  <div class="row">
    <?php
    $gridColumn = [
        'name',
        'typeStr',
        'question:ntext',
        'is_required:boolean',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>

  <div class="row " id="questionOptions">
    <div class="col-md-12">
      <? $options = $model->getModelAttribute('option', true) ?>
      <legend>Opcje</legend>
      <ol class="options">
        <? if ($options): ?>
          <? foreach ($options as $index => $option): ?>
            <li>
              <?= $option['text'] ?> (poprawne?: <?=isset($option['is_correct']) && $option['is_correct'] ? 'Tak' : 'Nie'?>)
              <hr/>
            </li>
          <? endforeach ?>
        <? endif ?>
      </ol>
    </div>

  </div>

  <div class="row">
    <?php
//    if ($providerPollPollQuestion->totalCount) {
//      $gridColumnPollPollQuestion = [
//          ['class' => 'yii\grid\SerialColumn'],
//          [
//              'attribute' => 'poll.name',
//              'label' => Yii::t('app', 'Poll')
//          ],
//      ];
//      echo Gridview::widget([
//          'dataProvider' => $providerPollPollQuestion,
//          'pjax' => true,
//          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll-poll-question']],
//          'panel' => [
//              'type' => GridView::TYPE_PRIMARY,
//              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Poll Poll Question')),
//          ],
//          'columns' => $gridColumnPollPollQuestion
//      ]);
//    }

    ?>
  </div>

  <div class="row">
    <?php
//    if ($providerPollTemplateQuestion->totalCount) {
//      $gridColumnPollTemplateQuestion = [
//          ['class' => 'yii\grid\SerialColumn'],
//          [
//              'attribute' => 'pollTemplate.name',
//              'label' => Yii::t('app', 'Poll Template')
//          ],
//          'order',
//      ];
//      echo Gridview::widget([
//          'dataProvider' => $providerPollTemplateQuestion,
//          'pjax' => true,
//          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll-template-question']],
//          'panel' => [
//              'type' => GridView::TYPE_PRIMARY,
//              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Poll Template Question')),
//          ],
//          'columns' => $gridColumnPollTemplateQuestion
//      ]);
//    }

    ?>
  </div>
</div>