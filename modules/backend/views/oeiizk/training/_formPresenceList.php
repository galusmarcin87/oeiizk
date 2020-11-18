<?php
/* @var $this yii\web\View */
/* @var $model app\models\db\Training */

?>

<? $index = 1; ?>
<button class="btn btn-success bottom10" onclick="fillAllCheckboxes()" type="button">Wypełnij wszystkie</button>
<table class="kv-grid-table table table-bordered table-striped kv-table-wrap" id="presenceList">
  <thead>
    <tr>
      <th colspan="2">Lista obecności</th>
      <th colspan="<?= sizeof($model->lessonsDateAsc) ?>">Zajęcia</th>
      <th colspan="<?= sizeof($model->trainingModules) ?>">Moduły</th>
      <th></th>
      <th></th>
    </tr>

    <tr>
      <th>Nr</th>
      <th>Imię i nazwisko</th>
      <? foreach ($model->lessonsDateAsc as $lesson): ?>
        <th>
          <input type="hidden" name="lessonPresenceToDelete[]" value="<?= $lesson->id ?>"/>
          <?= substr($lesson->date_start,0,-3) ?>
        </th>
      <? endforeach ?>
      <? foreach ($model->trainingModules as $module): ?>
        <th>
          <input type="hidden" name="modulePresenceToDelete[]" value="<?= $module->id ?>"/>
          <?= substr($module->date_start,0,-3) ?>
        </th>
      <? endforeach ?>
      <th>Zaliczenie</th>
      <th>Certyfikat</th>
    </tr>
  </thead>
  <tbody>
    <?
    foreach ($model->trainingParticipants as $participant): $user = $participant->user;
      if (!$user)
        continue;

      ?>
      <? if (!$participant->canByGenerated()) continue; ?>
      <tr>
        <td><?= $index ?></td>
        <td><?= $user ?></td>
        <? foreach ($model->lessonsDateAsc as $lesson): ?>
          <td>
            <input type="checkbox" name="lessonPresence[<?= $user->id ?>][<?= $lesson->id ?>]" <? if ($user->isLessonPresent($lesson)): ?>checked="checked"<? endif ?>/>
          </td>
        <? endforeach ?>
        <? foreach ($model->trainingModules as $module): ?>
          <td>
            <input type="checkbox" name="modulePresence[<?= $user->id ?>][<?= $module->id ?>]" <? if ($user->isModulePresent($module)): ?>checked="checked"<? endif ?>/>
          </td>
        <? endforeach ?>
        <td>
          <input type="hidden" name="is_passed[<?= $user->id ?>]" value="0">
          <input type="checkbox" name="is_passed[<?= $user->id ?>]" <? if ($participant->is_passed): ?>checked="checked"<? endif ?> value="1" class="is_passed">
        </td>
        <td>
          <input type="hidden" name="is_print_certificate[<?= $user->id ?>]" value="0">
          <input type="checkbox" name="is_print_certificate[<?= $user->id ?>]" <? if ($participant->is_print_certificate): ?>checked="checked"<? endif ?>  value="1">
        </td>
      </tr>
      <? $index++ ?>
    <? endforeach ?>
  </tbody>
</table>

<script type="text/javascript">
  function fillAllCheckboxes() {
    $('#presenceList input[type=checkbox]:not(.is_passed)').each(function () {
      $(this).attr('checked', true);
    })
  }
</script>