<?php
use app\components\mgcms\MgHelpers;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $model app\models\db\Training */
$template = $model->trainingTemplate;
if (!$template) {
  return false;
}

$workshopsGroups = [];
foreach ($model->workshops as $workshop) {
  $workshopsGroups[] = $workshop->order;
}
sort($workshopsGroups);
$workshopsGroups = array_unique($workshopsGroups);

$user = MgHelpers::getUserModel();

?>

<? if (sizeof($workshopsGroups) > 0): ?>
  <div class="row">
    <div class="col-md-12">
      <? foreach ($workshopsGroups as $workshopsGroup): ?>
        <div class="row " id="workshopGroup_<?= $workshopsGroup ?>">
          <div class="col-md-4">
            <h7>Grupa <?= $workshopsGroup ?></h7>
            <?
            $workshopsInGroupOptions = [];
            $selected = false;
            foreach ($model->workshops as $workshop) {
              if ($workshop->order == $workshopsGroup) {
                $workshopsInGroupOptions[$workshop->id] = (string) $workshop;
                if ($user && $user->isWorkshopParticipant($workshop)) {
                  $selected = $workshop->id;
                }
              }
            }
            echo Html::dropDownList('workshop[' . $workshopsGroup . ']', $selected, $workshopsInGroupOptions,
                ['prompt' => '', 'class' => 'form-control workshopSelect', 'data-group-index' => $workshopsGroup]);

            ?>
          </div>
          <div class="col-md-4 description" id="workshopSelect_<?= $workshopsGroup ?>"></div>
        </div>
      <? endforeach ?>


    </div>
  </div>
<? endif ?>
<br/>
<script type="text/javascript">
  var workshopJsons = [];
<? foreach ($model->workshops as $workshop) : ?>
    workshopJsons[<?= $workshop->id ?>] = <?= yii\helpers\Json::encode(['description' => $workshop->description]) ?>;
<? endforeach ?>
  document.addEventListener('DOMContentLoaded', function () {
    $('.workshopSelect').change(function () {
      var index = $(this).data('group-index');
      if ($(this).val()) {
        $('#workshopSelect_' + index).html('<p>Opis:</p>' + workshopJsons[$(this).val()].description);
      } else {
        $('#workshopSelect_' + index).html('');
      }
    })
    $('.workshopSelect').change();
  }, false);
</script>