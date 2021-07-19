<?php
use yii\helpers\Html;
use app\models\mgcms\db\User;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

$this->title = Yii::t('app', 'Update Training') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$controller = Yii::$app->controller->id;

?>
<div class="training-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <? if (0 && \app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update-participants')): ?>
    <?=
    Html::a(Yii::t('app', 'Uczestnicy'), ['update-participants', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'target' => '_blank'
        ]
    )

    ?>
  <? endif ?>

  <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training-participant', 'index')): ?>
    <?=
    Html::a(Yii::t('app', 'Lista uczestników'), ['oeiizk/training-participant/index', 'TrainingParticipantSearch[training_id]' => $model->id], [
        'class' => 'btn btn-danger',
        'target' => '_blank'
        ]
    )

    ?>
  <? endif ?>

    <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update-participants')): ?>
        <?=
        Html::a(Yii::t('app', 'Dodaj uczestnika'), ['oeiizk/training-participant/create', 'trainingId' => $model->id], [
                'class' => 'btn btn-danger',
                'target' => '_blank'
            ]
        )

        ?>
    <? endif ?>

    <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training', 'numerate')): ?>
    <?=
    Html::a(Yii::t('app', 'Numeruj uczestników'), ['numerate', 'id' => $model->id], [
            'class' => 'btn btn-success right',
        ]
    )

    ?>
    <? endif ?>

  <?=
  $this->render(app\components\mgcms\OeiizkHelpers::isInRoles([User::ROLE_LECTOR, User::ROLE_COACH, User::ROLE_DIRECTOR]) ? '_formLector' : '_form', [
      'model' => $model,
  ])

  ?>

</div>
