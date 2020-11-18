<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $institution \app\models\db\Institution */
/* @var $lessons \app\models\db\Lesson[] */

?>

<style>
  body{
    margin: 20px;
    background-color: #fff8c6;  
  }
  table{
    width: 100%;
  }
  table{
    border-collapse: separate;
    border-spacing: 0;
  }
  table td{
    /*border: 1px solid #ddd;*/
    font-size: 30px;
    border-color: #ddd;
    padding: 3px;

  }

  .center{
    text-align: center;
  }

</style>

<h1 class="center">Szkolenia (<?= date('d.m.Y') . ', ' . \Yii::$app->formatter->asDate(date('Y-m-d'), 'EEEE') ?>)</h1>
<h2 class="center"><?= $institution ?>, ul. <?= $institution->street ?> <?= $institution->house_no ?></h2>

<table border="1">
  <tr>
    <td class="center">Szkolenie</td><td class="center">Godzina</td><td class="center">Sala</td>
  </tr>
  <? foreach ($lessons as $lesson): ?>
    <tr>
      <td>
        <?= $lesson->training ?>
      </td>
      <td class="center">
        <?= date('H:i', strtotime($lesson->date_start)) ?> - <?= date('H:i', strtotime($lesson->date_end)) ?>
      </td>
      <td class="center">
        <?= $lesson->lab->name . ($lesson->lab->floor ? ' - ' . $lesson->lab->floor . '. piętro' : '') ?>
      </td>
    </tr>
  <? endforeach ?>

  <? foreach ($events as $event): ?>
    <tr>
      <td>
        <?= $event->name ?>
      </td>
      <td class="center">
        <?= date('H:i', strtotime($event->date_from)) ?> - <?= date('H:i', strtotime($event->date_to)) ?>
      </td>
      <td class="center">
        <?= $event->lab->name . ($event->lab->floor ? ' - ' . $event->lab->floor . '. piętro' : '') ?>
      </td>
    </tr>
  <? endforeach ?>
</table>

<script type="text/javascript">
  interval = setInterval(function(){
    window.location = window.location;
  },1000*60*10)
</script>