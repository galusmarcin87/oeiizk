<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use \app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="training-view">

  <div class="row">
    <div class="col-sm-12">
      <h2><?= Yii::t('app', 'Training') . ' ' . Html::encode($this->title) ?></h2>
    </div>
    <?= $this->render('_buttons', ['model' => $model]) ?>
  </div>

  <div class="row">
    <?php
    $gridColumn = [
        'name',
        'subtitle',
        [
            'attribute' => 'trainingTemplate.name',
            'label' => Yii::t('app', 'Training Template'),
        ],
        'code',
        'meeting_number',
        'module_number',
        'date_start',
        'date_end',
        'group',
        'technical_requirements:raw',
        'social_requirements:raw',
        'visibility',
        'certificate_lines:raw',
        'minimal_participants_number',
        'maximal_participants_number',
        'final_maximal_participants_number',
        'is_login_required:boolean',
        'status',
        'is_card_required:boolean',
        'is_certificate_issued:boolean',
        'additional_information:raw',
        'comments:raw',
        'sign_status',
        'is_promoted_oeiizk:boolean',
        'is_promoted_pos:boolean',
        [
            'attribute' => 'file',
            'label' => Yii::t('app', 'File'),
            'format' => 'raw',
        ],
        [
            'attribute' => 'poll',
            'label' => Yii::t('app', 'Poll'),
        ],
        'link_to_materials',
        [
            'attribute' => 'article',
            'label' => Yii::t('app', 'Article'),
        ],
        [
            'attribute' => 'subject',
            'label' => Yii::t('app', 'Subject'),
        ],
        'project',
        'is_display_on_screen:boolean',
        [
            'attribute' => 'lab',
            'label' => Yii::t('app', 'Lab'),
        ],
        'delegacy',
        'city',
        'poll_from',
        'poll_to',
        'certificate_template',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerLesson->totalCount) {
      $gridColumnLesson = [
          ['class' => 'yii\grid\SerialColumn'],
          'subject:ntext',
          'date_start',
          'date_end',
          [
              'attribute' => 'lab',
              'label' => Yii::t('app', 'Lab')
          ],
          'hours_count',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerLesson,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lesson']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Lessons')),
          ],
          'columns' => $gridColumnLesson
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerTrainingLector->totalCount) {
      $gridColumnTrainingLector = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'user',
              'label' => Yii::t('app', 'User')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerTrainingLector,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-lector']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Lectors')),
          ],
          'columns' => $gridColumnTrainingLector
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerTrainingModule->totalCount) {
      $gridColumnTrainingModule = [
          ['class' => 'yii\grid\SerialColumn'],
          'subject',
          'date_start',
          'date_end',
          'description:ntext',
          'hours',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerTrainingModule,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-module']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Modules')),
          ],
          'columns' => $gridColumnTrainingModule
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerTrainingParticipant->totalCount) {
      $gridColumnTrainingParticipant = [
//          ['class' => 'yii\grid\SerialColumn'],
          'user.id',
          [
              'attribute' => 'user',
              'label' => Yii::t('app', 'User')
          ],
          'user.email',
          [
              'attribute' => 'user.username',
              'label' => Yii::t('app', 'Login')
          ],
          [
              'attribute' => 'user.institutionsStr',
              'label' => Yii::t('app', 'Miejsca zatrudnienia')
          ],
          [
              'attribute' => 'user.subjectsStr',
              'label' => Yii::t('app', 'Przedmioty')
          ],
          'user.educational_level',
          'order',
          'surname',
          'workplace',
          'status',
          'is_reserve:boolean',
          'is_paid:boolean',
          'paid_missing',
          'is_passed:boolean',
          'is_print_certificate:boolean',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerTrainingParticipant,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-participant']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Participants')),
          ],
          'columns' => $gridColumnTrainingParticipant
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerTrainingRequired->totalCount) {
      $gridColumnTrainingRequired = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'trainingRequired.name',
              'label' => Yii::t('app', 'Training')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerTrainingRequired,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-required']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Trainings Required')),
          ],
          'columns' => $gridColumnTrainingRequired
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerTrainingTrainingDirection->totalCount) {
      $gridColumnTrainingTrainingDirection = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'trainingDirection.name',
              'label' => Yii::t('app', 'Training Direction')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerTrainingTrainingDirection,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-training-direction']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Directions')),
          ],
          'columns' => $gridColumnTrainingTrainingDirection
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerWorkshop->totalCount) {
      $gridColumnWorkshop = [
          ['class' => 'yii\grid\SerialColumn'],
          'title',
          'description:ntext',
          'date_start',
          'date_end',
          [
              'attribute' => 'lab.name',
              'label' => Yii::t('app', 'Lab')
          ],
          'order',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerWorkshop,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workshop']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workshop')),
          ],
          'columns' => $gridColumnWorkshop
      ]);
    }

    ?>
  </div>
</div>