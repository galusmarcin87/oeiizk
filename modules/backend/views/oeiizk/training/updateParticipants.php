<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use app\models\db\TrainingTemplate;
use app\models\db\Training;

/* @var $this yii\web\View */
/* @var $model app\models\db\Training */
/* @var $form app\components\mgcms\yii\ActiveForm */


$this->title = 'Uczestnicy szkolenia ' . $model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TrainingParticipant',
        'relID' => 'training-participant',
        'value' => \yii\helpers\Json::encode($model->trainingParticipants),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);


$userSearchModel = new \app\models\mgcms\db\UserSearch();
$userDataProvider = $userSearchModel->search(Yii::$app->request->queryParams);

?>
<div class="training-update">

  <h1><?= Html::encode($this->title) ?></h1>
  
   <?=
  Html::a(Yii::t('app', 'Powrót do szkolenia'), ['update', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      ]
  )

  ?>
  <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training-participant', 'index')): ?>
  <?=
  Html::a(Yii::t('app', 'Lista uczestników'), ['oeiizk/training-participant/index', 'TrainingParticipantSearch[training_id]' => $model->id], [
      'class' => 'btn btn-danger',
      'target' => '_blank'
      ]
  )

  ?>
  <? endif ?>
  
   <? if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training', 'numerate')): ?>
  <?=
  Html::a(Yii::t('app', 'NUMERUJ'), ['numerate', 'id' => $model->id], [
      'class' => 'btn btn-success right',
      ]
  )

  ?>
  <? endif ?>

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

    <input type="hidden" name="timestamp" value="<?=Date('Y-m-d H:i:s')?>"/>
  
  <?= $form->field($model, 'name')->hiddenInput()->label(false) ?>

  <?=
  $this->render('_formTrainingParticipant',
      [
          'row' => \yii\helpers\ArrayHelper::toArray($model->trainingParticipants),
          'parentModel' => $model
  ])

  ?>

  <div class="form-group">
    <?=
    Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

    ?>
  </div>

  <?php ActiveForm::end(); ?>



</div>

<!-- Modal -->
<div class="modal fade wide" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Wybierz uczestnika</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=
        $this->render('_userGrid', [
            'searchModel' => $userSearchModel,
            'dataProvider' => $userDataProvider,
        ])

        ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var indexParticipantChosen = false;
  function showUserModal(index) {
    indexParticipantChosen = index;
    $('#userModal').modal('show')
  }

  function chooseUser(id, first_name, last_name, email) {
    $('input[name="TrainingParticipant[' + indexParticipantChosen + '][user_id]"]').val(id);
    $('#userFirstName_' + indexParticipantChosen).text(first_name);
    $('#userLastName_' + indexParticipantChosen).text(last_name);
    $('#userEmail_' + indexParticipantChosen).text(email);
    $('#trainingparticipant-' + indexParticipantChosen + '-status').val('zgłoszenie przez DOS');
    $('#userModal').modal('hide');
  }

</script>