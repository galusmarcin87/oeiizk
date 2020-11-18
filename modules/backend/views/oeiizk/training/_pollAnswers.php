<?
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use app\models\db\Poll;
use app\models\db\PollQuestion;
use app\models\db\PolQuestionAnswer;

/* @var $model \app\models\db\Training */
$poll = $model->poll;
if (!$poll) {
  return false;
}

?>


<? foreach ($poll->pollPollQuestions as $index => $pollQuestion): ?>
  <? $question = $pollQuestion->pollQuestion ?>
  <p><b><?= $index + 1 ?>. </b><?= $question->question ?> <?= $question->is_required ? '*' : '' ?></p>
  <p><?= PolQuestionAnswer::getUserAnswer($poll->id, $question->id, $userId, $model->id, $question->type)?></p>
<? endforeach; ?>