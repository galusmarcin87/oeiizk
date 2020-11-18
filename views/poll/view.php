<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\db\Training */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;
use app\models\db\Poll;
use app\models\db\PollQuestion;

$poll = $model->poll;
if (!$poll) {
  return false;
}

$pollAnswers = Yii::$app->request->post() ? Yii::$app->request->post()['poll'] : [];

?>
<div class="container" id="pollForm">
  <article class="main">
    <div class="text-block">
      <?php
      $form = ActiveForm::begin([
              'id' => 'poll-form',
//                    'layout' => 'horizontal',
              'options' => [
                  'class' => 'register-form form-light'
              ],
              'fieldConfig' => [
              ],
      ]);

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
          <?= Html::textarea("poll[$question->id]",isset($pollAnswers[$question->id]) ? $pollAnswers[$question->id] : '') ?>
        <? elseif ($question->type == PollQuestion::TYPE_MULTIPLE_CHOICE): ?>
          <? $options = $question->getModelAttribute('option', true) ?>
          <? if ($options): ?>
            <? foreach ($options as $indexOp => $option): ?>
              <div class="">
                <input type="checkbox" 
                       id="poll-<?= $question->id ?>-<?= $indexOp ?>" name="poll[<?= $question->id ?>][]" 
                       value="<?= $option['text'] ?>"
                       <?if(isset($pollAnswers[$question->id]) && in_array($option['text'], $pollAnswers[$question->id]) ):?>checked="checked"<?endif?>
                       >
                <label for="poll-<?= $question->id ?>-<?= $indexOp ?>"><?= $option['text'] ?></label>
              </div>
            <? endforeach ?>
          <? endif ?>

        <? elseif ($question->type == PollQuestion::TYPE_ONE_CHOICE): ?>
          <? $options = $question->getModelAttribute('option', true) ?>
          <? if ($options): ?>
            <? foreach ($options as $indexOp => $option): ?>
              <div class="">
                <input 
                  type="radio" 
                  id="poll-<?= $question->id ?>-<?= $indexOp ?>" 
                  name="poll[<?= $question->id ?>]" 
                  value="<?= $option['text'] ?>"
                  <?if(isset($pollAnswers[$question->id]) && $pollAnswers[$question->id] == $option['text']):?>checked="checked"<?endif?>
                  >
                <label for="poll-<?= $question->id ?>-<?= $indexOp ?>"><?= $option['text'] ?></label>
              </div>
            <? endforeach ?>
          <? endif ?>

        <? endif ?>

      <? endforeach; ?>


      <div class="col-12 col-sm marginTop15" >
        <button type="submit" class="btn btn-danger">Wyślij</button>
      </div>


      <?php ActiveForm::end(); ?>
    </div>
  </article>
</div>