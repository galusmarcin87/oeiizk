<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\PollTemplate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Poll Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="poll-template-view">

  <div class="row">
    <div class="col-sm-8">
      <h2><?= Yii::t('app', 'Poll Template') . ' ' . Html::encode($this->title) ?></h2>
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
      


      <? $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):

        ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <? endif ?>
      <? $controller = Yii::$app->controller->id;
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
        'text:raw',
        'type',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerPoll->totalCount) {
      $gridColumnPoll = [
          ['class' => 'yii\grid\SerialColumn'],
          'name',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerPoll,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Poll')),
          ],
          'columns' => $gridColumnPoll
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerPollTemplateQuestion->totalCount) {
      $gridColumnPollTemplateQuestion = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'pollQuestion.name',
              'label' => 'Nazwa'
          ],
          'pollQuestion.question',
          'order',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerPollTemplateQuestion,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-poll-template-question']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Questions')),
          ],
          'columns' => $gridColumnPollTemplateQuestion
      ]);
    }

    ?>
  </div>
</div>