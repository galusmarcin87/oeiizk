<?
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


<? foreach ($poll->pollPollQuestions as $index => $pollQuestion): ?>
  <? $question = $pollQuestion->pollQuestion ?>
  <p><b><?= $index + 1 ?>. </b><?= $question->question ?> <?= $question->is_required ? '*' : '' ?></p>
  <? if ($question->type == PollQuestion::TYPE_OPEN): ?>
    <?
    $answers = PolQuestionAnswer::find()
        ->where([
        'poll_poll_question_poll_id' => $poll->id,
        'poll_poll_question_poll_question_id' => $question->id,
            'training_id' => $model->id
        ])->all();
    ?>
  <ul>
  <?foreach($answers as $answer):?>
    <li>
      <?=$answer->answer_open?>
    </li>
  <?endforeach?>
  </ul>
  <? else: ?>
    <? $options = $question->getModelAttribute('option', true) ?>
      <? if ($options): ?>
      <ol>
          <? foreach ($options as $indexOp => $option): ?>
          <li>
          <?= $option['text'] ?> (<?= PolQuestionAnswer::countAnswers($poll->id, $question->id, $model->id, $question->type, $option['text']) ?>)
          </li>
      <? endforeach ?>
      </ol>
    <? endif ?>
  <? endif ?>

<? endforeach; ?>