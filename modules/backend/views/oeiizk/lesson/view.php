<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Lesson */

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessons'), 'url' => ['index']];

?>
<div class="lesson-view">

  <div class="row">
    <div class="col-sm-6">
      <h2><?= Yii::t('app', 'Lesson') ?></h2>
    </div>
    <div class="col-sm-6" style="margin-top: 15px">

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
        'subject:ntext',
        'date_start',
        'date_end',
        [
            'attribute' => 'training',
            'label' => Yii::t('app', 'Training'),
        ],
        [
            'attribute' => 'lab.shorterName',
            'label' => Yii::t('app', 'Lab'),
        ],
        'hours_count',
        'training.technical_requirements:raw',
        'training.social_requirements:raw',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>

  <?if(!app\components\mgcms\OeiizkHelpers::isRole(\app\models\mgcms\db\User::ROLE_WORKER)):?>
  <div class="row">
    <?php
    if ($providerLessonPresence->totalCount) {
      $gridColumnLessonPresence = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'user',
              'label' => Yii::t('app', 'User')
          ],
          'note',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerLessonPresence,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lesson-presence']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Lesson Presence')),
          ],
          'columns' => $gridColumnLessonPresence
      ]);
    }

    ?>
  </div>
</div>
<?endif?>