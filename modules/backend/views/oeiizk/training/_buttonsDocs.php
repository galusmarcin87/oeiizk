<?
use yii\helpers\Html;
use \app\components\mgcms\MgHelpers;
use app\components\mgcms\yii\ActiveForm;

/* @var $model app\models\db\Training */

?>

<div class="col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">

  <?=
  Html::a('<i class="fa glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Lista obecności uczestników'), ['generate-presense-list', 'id' => $model->id], [
      'class' => 'btn btn-success',
      'target' => '_blank',
      ]
  )

  ?>

  <br/><br/>

  <?=
  Html::a('<i class="fa glyphicon glyphicon-list"></i> ' . 'Lista odbioru materiałów ', ['generate-list', 'id' => $model->id], [
      'class' => 'btn btn-success',
      'target' => '_blank',
      ]
  )

  ?>

  <br/><br/>
  <?=
  Html::a('<i class="fa glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Dziennik zajęć'), ['generate-diary', 'id' => $model->id], [
      'class' => 'btn btn-success',
      'target' => '_blank',
      ]
  )

  ?>


  <br/><br/>

  <?=
  Html::a('<i class="fa glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Ankieta ewaluacyjna'), ['generate-poll-summary', 'id' => $model->id], [
      'class' => 'btn btn-success',
      'target' => '_blank',
      ]
  )

  ?>

  <br/><br/>

  <?if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training', 'generate-certificate') 
      && \app\components\mgcms\MgHelpers::getUserModel()->checkAccess('training', 'generate-certificate-all')):?>
  <div class="row">
    <div class="col-md-3">
      <?= Html::dropDownList('certificateUser', false, \yii\helpers\ArrayHelper::map($model->participants, 'id', 'toString'), ['class' => 'form-control', 'id' => 'certificateUser']) ?>
    </div>
    <div class="col-md-5">
      <?= Html::button('Generuj zaświadczenie', ['class' => 'btn btn-info', 'id' => 'generateCertyficate']) ?>
      <?= Html::button('Generuj dla wszystkich', ['class' => 'btn btn-success', 'id' => 'generateCertyficateAll', 'name' => 'foAll', 'value' => 1]) ?>
    </div>
  </div>
  <?endif?>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#generateCertyficate').click(function () {
        window.location = '/backend/oeiizk/training/generate-certificate?training_id=<?= $model->id ?>&user_id=' + $('#certificateUser').val();
      });
       $('#generateCertyficateAll').click(function () {
        window.location = '/backend/oeiizk/training/generate-certificate-all?training_id=<?= $model->id ?>';
      });
    });
  </script>


</div>