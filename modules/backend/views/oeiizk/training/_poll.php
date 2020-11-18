<?
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\db\Poll;
use app\models\db\PollQuestion;

/* @var $model \app\models\db\Training */

$poll = $model->poll;
if (!$poll) {
  return false;
}

?>

<h1 class="text-center" align="center">Ankieta</h1>

<h3 class="text-center" align="center">ewaluacji szkolenia</h3>

<p>
  Nazwa szkolenia: <?= $model->name ?>
</p>

<p>
  Symbol szkolenia: <?= $model->code ?>
</p>

<p>
  Termin szkolenia: <?= $model->date_start ?> - <?= $model->date_end ?>
</p>

<p>
  Prowadzący zajęcia: <?= $model->lectorsStr ?>
</p>

<p>Prosimy o uważne przeczytanie pytań i zaznaczenie właściwej odpowiedzi.</p>


<? foreach ($poll->pollPollQuestions as $index => $pollQuestion): ?>
  <? $question = $pollQuestion->pollQuestion ?>
  <p><b><?= $index + 1 ?>. </b><?= $question->question ?> <?= $question->is_required ? '*' : '' ?></p>
  <? if ($question->type == PollQuestion::TYPE_OPEN): ?>
    ...........................................................................................................................................................
    ...........................................................................................................................................................
    ...........................................................................................................................................................
  <? else: ?>
    <? $options = $question->getModelAttribute('option', true) ?>
    <? if ($options): ?>
      <? foreach ($options as $option): ?>
        <label><input type="checkbox"><?= $option['text'] ?></label>
      <? endforeach ?>
    <? endif ?>

  <? endif ?>

<? endforeach; ?>


<p align="right"><b>Dziękujemy za wypełnienie ankiety </b></p>