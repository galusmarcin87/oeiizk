<?
use app\components\mgcms\MgHelpers;
use yii\base\View;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $model \app\models\db\Training */
/* @var $this View */

?>

<h2 class="text-center" align="center" style="font-size: 18px">Potwierdzenie otrzymania zaświadczenia o ukończeniu szkolenia i materiałów dydaktycznych</h2>


Symbol szkolenia: <?= $model->code ?>
<br/>
Nazwa szkolenia: <?= $model->name ?>
<br/>
Termin szkolenia: <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
<br/>
Prowadzący zajęcia: <?= $model->lectorsStr ?>
<br/>
<? if ($model->lab): ?>
  <? $institution = $model->lab->institution ?>
  Miejsce szkolenia: <?= $institution->name ?> | <?= $institution->street ?> | <?= $institution->postcode ?> | <?= $institution->city ?>
  <br/>
<? endif

?>

<br/>
<? $index = 1; ?>
<table style="width: 100%;border: 1px solid black;border-collapse:collapse;" border="1">
  <?=$this->render('_listTableHeader')?>
  <? foreach ($model->trainingParticipants as $trainingParticipant): ?>
    <?if(!$trainingParticipant->canByGenerated()) continue;?>

    <tr>
      <td><?= $trainingParticipant->order ?></td>
      <td><?= $trainingParticipant->user->last_name . ' ' . $trainingParticipant->user->first_name ?></td>
      <td style="font-size: 12px;"><?= $trainingParticipant->user->firstInstitutionStr ?></td>
      <td style="font-size: 12px;"><br/><br/><br/></td>
      <td></td>
    </tr>
    <? $index++ ?>
  <? endforeach ?>

</table>

