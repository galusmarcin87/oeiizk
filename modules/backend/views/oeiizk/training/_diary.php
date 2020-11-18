<?
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use \app\models\db\LessonPresence;
use \app\models\db\TrainingModulePresence;

/* @var $model \app\models\db\Training */

$localHoursCount = 0;
$onlineHoursCount = 0;

$directions = app\models\db\TrainingDirection::find()->orderBy(['order' => SORT_ASC])->all();

?>

<br/><br/>  <br/><br/><br/><br/>
<h1 class="text-center" align="center" style="font-size: 34px">DZIENNIK ZAJĘĆ</h1>
<br/><br/><br/><br/>
<p style="font-size: 30px" class="text-center" align="center"><?= $model->name ?></p>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div style="margin-left: 0px; font-size: 18x">
  <b>
    Symbol szkolenia: <?= $model->code ?>
    <br/><br/>
    Wykładowcy: <?= $model->lectorsStr ?>
    <br/><br/>
    Termin od: <?= date('d.m.Y', strtotime($model->date_start)) ?> do <?= date('d.m.Y', strtotime($model->date_end)) ?>
    <br/>
  </b>
</div>
<? $index = 1; ?>
<newpage>

  <h4 class="text-center" align="center">Udział w zajęciach</h4>
  <table style="width: 100%;border: 1px solid black;border-collapse:collapse; font-size: 18px;" border="1">
    <tr>
      <th>L.p.</th>
      <th>Imię i nazwisko</th>
      <? foreach ($model->lessonsDateAsc as $lesson): ?>
        <th><?= Date('d.m', strtotime($lesson->date_start)) ?></th>
      <? endforeach ?>
      <? foreach ($model->trainingModulesDateAsc as $module): ?>
        <th><?= Date('d.m', strtotime($module->date_start)) ?></th>
      <? endforeach ?>
      <th>Zal.</th>
    </tr>
    <? foreach ($model->trainingParticipants as $trainingParticipant): ?>
      <?if(!$trainingParticipant->canByGenerated()) continue;?>
      <tr>
        <? $user = $trainingParticipant->user ?>
        <td style="text-align: center"><?= $index ?>.</td>
        <td><?= $user ?></td>
        <? foreach ($model->lessonsDateAsc as $lesson): ?>
          <td style="text-align: center">
            <?= LessonPresence::find()->where(['training_lesson_id' => $lesson->id, 'user_id' => $user->id])->one() ? '+' : '-' ?>
          </td>
        <? endforeach ?>
        <? foreach ($model->trainingModulesDateAsc as $module): ?>
          <td style="text-align: center">
            <?= TrainingModulePresence::find()->where(['training_module_id' => $module->id, 'user_id' => $user->id])->one() ? '+' : '-' ?>
          </td>
        <? endforeach ?>
        <td style="text-align: center"><?= $trainingParticipant->is_passed ? '+' : '-' ?></td>
      </tr>
      <? $index++ ?>
    <? endforeach ?>
  </table>
  <newpage>
    <h4 class="text-center" align="center">Rozkład zajęć</h4>
    <table style="width: 100%;border: 1px solid black;border-collapse:collapse;" border="1">
      <tr>
        <th>Data</th>
        <th style="width: 500px">Temat zajęć</th>
        <th>Godziny<br/>stacjonarne</th>
        <th>Godziny<br/>online</th>
        <th>Obecni</th>
        <th>Podpis</th>
      </tr>
      <?
      foreach ($model->lessonsDateAsc as $lesson):
        $localHoursCount += $lesson->hours_count;

        ?>
        <tr>
          <td><?= Date('d.m.Y', strtotime($lesson->date_start)) ?></td>
          <td><?= $lesson->subject ?></td>
          <td style="text-align: center"><?= $lesson->hours_count ?></td>
          <td></td>
          <td style="text-align: center">
            <?= LessonPresence::find()->where(['training_lesson_id' => $lesson->id])->count() ?>
          </td>
          <td></td>

        </tr>

      <? endforeach ?>
      <?
      foreach ($model->trainingModulesDateAsc as $module):
        $onlineHoursCount += $module->hours;

        ?>
        <tr>
          <td><?= Date('d.m.Y', strtotime($module->date_start)) ?> - <?= Date('d.m.Y', strtotime($module->date_end)) ?></td>
          <td><?= $module->description ?></td>
          <td></td>
          <td style="text-align: center"><?= $module->hours ?></td>
          <td style="text-align: center">
            <?= TrainingModulePresence::find()->where(['training_module_id' => $module->id])->count() ?>
          </td>
          <td></td>

        </tr>

      <? endforeach ?>

      <tr>
        <td colspan="2"  align="center"><b>Razem</b></td>
        <td  style="text-align: center"><?= $localHoursCount ?></td>
        <td  style="text-align: center"><?= $onlineHoursCount ?></td>
      </tr>

      <tr>
        <td colspan="2"  align="center"><b>Ogółem</b></td>
        <td colspan="2"  style="text-align: center"><?= $localHoursCount + $onlineHoursCount ?></td>
      </tr>


    </table>


    <h4 class="text-center" align="center">Kierunki polityki oświatowej państwa</h4>
    <table style="width: 100%;border: 1px solid black;border-collapse:collapse;" border="1">
      <?
      foreach ($directions as $index => $direction):

        ?>
        <tr>
          <td><?= ($index + 1) . '. ' . $direction->name ?></td>
          <td><?= $model->isDirectionSupport($direction) ? 'X' : '' ?></td>

        </tr>

      <? endforeach ?>


    </table>
