<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-view">

  <div class="row">
    <div class="col-sm-6">
      <h2><?= Yii::t('app', 'User') . ' ' . Html::encode($this->title) ?></h2>
    </div>
    <div class="col-sm-6" style="margin-top: 15px">
      <?=
      Html::a('<i class="fa glyphicon glyphicon-time"></i> ' . Yii::t('app', 'history'), ['history', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'target' => '_blank',
          'data-toggle' => 'tooltip',
          ]
      )

      ?>

      <?=
      Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), ['pdf', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'target' => '_blank',
          'data-toggle' => 'tooltip',
          ]
      )

      ?>

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
        ['attribute' => 'id', 'visible' => false],
        'username',
        'first_name',
        'last_name',
        'role:translate',
        'statusStr',
        'email:email',
        'created_on',
        'last_login',
        'address',
        'postcode',
        'birthdate',
        'city',
        'credibilityCalc',
        'employmentCard:raw',
        'date_card_verification',
        'date_card_submission',
        'date_email_confirmation',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerUserRole->totalCount) {
      $gridColumnUserRole = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'role.name',
              'label' => Yii::t('app', 'Role')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerUserRole,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-role']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Roles')),
          ],
          'columns' => $gridColumnUserRole
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerUserAgreement->totalCount) {
      $gridColumnUserAgreement = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'agreement.name',
              'label' => Yii::t('app', 'Agreement')
          ],
          'created_on',
          'expiry_date',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerUserAgreement,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-agreement']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Agreements')),
          ],
          'columns' => $gridColumnUserAgreement
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerUserGroup->totalCount) {
      $gridColumnUserGroup = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'group.name',
              'label' => Yii::t('app', 'Group')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerUserGroup,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-group']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Groups')),
          ],
          'columns' => $gridColumnUserGroup
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerUserSubject->totalCount) {
      $gridColumnUserSubject = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'subject.name',
              'label' => Yii::t('app', 'Subject')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerUserSubject,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-subject']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Subjects')),
          ],
          'columns' => $gridColumnUserSubject
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerWorkplace->totalCount) {
      $gridColumnWorkplace = [
          ['class' => 'yii\grid\SerialColumn'],
          ['attribute' => 'id', 'visible' => false],
          'position',
          'school_type',
          'educational_level',
          [
              'attribute' => 'institution.name',
              'label' => Yii::t('app', 'Institution')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerWorkplace,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workplace']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workplaces')),
          ],
          'columns' => $gridColumnWorkplace
      ]);
    }

    ?>
  </div>

  <div class="row"> 
    <?php
    if ($providerUserEducationalLevel->totalCount) {
      $gridColumnUserEducationalLevel = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'educationalLevel.name',
              'label' => Yii::t('app', 'Educational Level')
          ],
      ];
      echo Gridview::widget([
          'dataProvider' => $providerUserEducationalLevel,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-educational-level']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Educational Level')),
          ],
          'columns' => $gridColumnUserEducationalLevel
      ]);
    }

    ?>
  </div> 

  <div class="row">
    <?php
    if ($providerTrainingParticipant->totalCount) {
      $gridColumnTrainingParticipant = [
          ['class' => 'yii\grid\SerialColumn'],
          ['attribute' => 'id', 'visible' => false],
          [
              'attribute' => 'training.name',
              'label' => Yii::t('app', 'Training')
          ],
          'order',
          'surname',
          'status',
          'created_on',
          'is_reserve',
          'is_paid',
          'paid_missing',
          'is_passed',
          'is_print_certificate',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerTrainingParticipant,
          'pjax' => true,
          'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-training-participant']],
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Uczestnictwo w szkoleniach')),
          ],
          'columns' => $gridColumnTrainingParticipant
      ]);
    }

    ?>
  </div>


</div>