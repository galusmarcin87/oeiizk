<?
use app\components\mgcms\MgHelpers;
use yii\base\View;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this View */
/* @var $model \app\models\db\Training */

?>
<br/><br/><br/><br/>
<h2 class="text-center" align="center">Lista obecności</h2>

Symbol szkolenia: <?= $model->code ?>
<br/>
Nazwa szkolenia: <?= $model->name ?>
<br/>
Termin szkolenia: <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
<br/>
Prowadzący zajęcia: <?= $model->lectorsStr ?>
<? if ($model->lab): ?>
  <? $institution = $model->lab->institution ?>
<br/>
      Miejsce szkolenia: <?= $institution->name ?> | <?= $institution->street ?> | <?= $institution->postcode ?>
      | <?= $institution->city ?>

<? endif

?>

<br/><br/>
<? $index = 0; ?>

<table style="width: 100%;border: 1px solid black;border-collapse:collapse;" border="1">
    <tdead>

        <?=$this->render('_presenceListTableHeader',['model'=>$model])?>
    </tdead>
    <tbody>
        <?
        foreach ($model->trainingParticipants as $trainingParticipant): $user = $trainingParticipant->user;

          ?>
          <? if (!$trainingParticipant->canByGenerated()) continue;?>

          <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $user->last_name . ' ' . $user->first_name ?></td>
              <td style="font-size: 12px;"><?= $user->firstInstitutionStr ?></td>
              <? foreach ($model->lessonsDateAsc as $lesson): ?>
                <td style="font-size: 12px;">
                    <br/><br/><br/>
                </td>
              <? endforeach ?>
          </tr>
          <? $index++ ?>
        <? endforeach ?>
    </tbody>
</table>

