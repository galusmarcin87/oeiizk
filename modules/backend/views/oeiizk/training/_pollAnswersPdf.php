<?php
use kartik\tabs\TabsX;
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use app\models\db\Poll;
use app\models\db\PollQuestion;
use app\models\db\PolQuestionAnswer;

/* @var $model \app\models\db\Training */
/* @var $user app\models\mgcms\db\User */
$poll = $model->poll;
if (!$poll) {
  return false;
}

?>

<h1 class="text-center" align="center">Ankieta ewaluacyjna</h1>
<br/>
<h3 class="text-center" align="center">(zbiorcza)</h3>

<h3 class="text-center" align="center"><?= $model->name ?></h3>

Symbol szkolenia: <?= $model->code ?>
<br/>
Wykładowcy: <?= $model->lectorsStr ?>
<br/>
Termin: <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
<br/>
Liczba oddanych ankiet: <?= sizeof($userIds) ?>
<br/>


<table style="width: 100%;border: 1px solid black;border-collapse:collapse; font-size: 11px" border="1">
  <? foreach ($poll->pollPollQuestions as $index => $pollQuestion): ?>
    <? $question = $pollQuestion->pollQuestion ?>
    <tr style="background-color: lightblue;"><td colspan="3"><?= $index + 1 ?>. </b><?= $question->question ?> <?= $question->is_required ? '*' : '' ?></td></tr>
    <? if ($question->type == PollQuestion::TYPE_OPEN): ?>
      <tr>
        <td colspan="3"> 
          <?
          $answers = PolQuestionAnswer::find()
                  ->where([
                      'poll_poll_question_poll_id' => $poll->id,
                      'poll_poll_question_poll_question_id' => $question->id,
                      'training_id' => $model->id
                  ])->all();

          ?>
          <ul>
            <? foreach ($answers as $answer): ?>
              <li>
                <?= $answer->answer_open ?>
              </li>
            <? endforeach ?>
          </ul>
        </td>
      </tr>
    <? else: ?>
      <? $options = $question->getModelAttribute('option', true) ?>
      <? if ($options): ?>
        <? foreach ($options as $indexOp => $option): ?>
          <? $answerCount = PolQuestionAnswer::countAnswers($poll->id, $question->id, $model->id, $question->type, $option['text']) ?>
          <tr>
            <td> <?= $option['text'] ?></td>
            <td align="center"><?= $answerCount ?></td>
            <td align="right"><?= round(($answerCount / sizeof($userIds)) * 100, 2) ?>%</td>
          </tr>
        <? endforeach ?>
      <? endif ?>
    <? endif ?>

  <? endforeach; ?>
</table>


