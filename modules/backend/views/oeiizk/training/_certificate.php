<?
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $model \app\models\db\Training */

?>
<?= MgHelpers::getSetting('dokumentacja - nagłówek', true)?>

<h3 class="text-center" align="center">Potwierdzenie otrzymania zaświadczenia o ukończeniu szkolenia i materiałów dydaktycznych</h3>

<p>
  Symbol szkolenia: <?= $model->code ?>
</p>
<p>
  Nazwa szkolenia: <?= $model->name ?>
</p>
<p>
  Termin szkolenia: <?= $model->date_start ?> - <?= $model->date_end ?>
</p>
<p>
  Prowadzący zajęcia: <?= $model->lectorsStr ?>
</p>
<? if ($model->lab): ?>
  <? $institution = $model->lab->institution ?>
  <p>
    Miejsce szkolenia: <?= $institution->name ?> | <?= $institution->street ?> | <?= $institution->postcode ?> | <?= $institution->city ?>
  </p>
<? endif

?>

<? $index = 1; ?>
<table style="width: 100%;border: 1px solid black;border-collapse:collapse;" border="1">
  <tr>
    <th>L.p.</th>
    <th>Imię i nazwisko</th><th>Miejsce zatrudnienia</th>
    <th> Pokwitowanie - materiały </th>
    <th> Pokwitowanie - zaświadczenie </th>
  </tr>
  <? foreach ($model->lessonsDateAsc as $lesson): ?>
    <? foreach ($model->participants as $user): ?>
      <tr>
        <td><?= $index ?></td>
        <td><?= $user ?></td>
        <td><?= $user->institutionsStr ?></td>
        <td><br/><br/><br/><br/></td>
        <td></td>
      </tr>
      <? $index++ ?>
    <? endforeach ?>
  <? endforeach ?>

</table>
  
<?= MgHelpers::getSetting('dokumentacja - stopka', true)?>