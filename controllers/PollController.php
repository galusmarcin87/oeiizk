<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Training;
use app\models\db\TrainingTemplate;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\models\db\Poll;
use app\models\db\PollQuestion;
use app\models\db\PolQuestionAnswer;
use app\components\mgcms\MgHelpers;

class PollController extends \app\components\mgcms\MgCmsController
{

  public function behaviors()
  {
    return [
    ];
  }

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionView($hash)
  {
    $id = MgHelpers::decrypt($hash);
    if (!$id) {
      $this->throw404();
    }

    $userId = rand(1, 1000000);
    $training = \app\models\db\Training::findOne($id);
    if (!$training) {
      $this->throw404();
    }
    if (!$training->poll || !$training->isPollActive()) {
      $this->throw404();
    }
    

    if (Yii::$app->request->post()) {
      $transaction = Yii::$app->db->beginTransaction();
      try {
        $pollAnswers = Yii::$app->request->post()['poll'];
        foreach ($training->poll->pollQuestions as $question) {
          if ($question->is_required && !isset($pollAnswers[$question->id])) {
            throw new \Exception ('Pytanie ' . $question->question . ' jest wymagane.');
          }
          if (isset($pollAnswers[$question->id])) {
            $answer = $pollAnswers[$question->id];
            $pollAnswer = new PolQuestionAnswer;
            $pollAnswer->poll_poll_question_poll_id = $training->poll->id;
            $pollAnswer->poll_poll_question_poll_question_id = $question->id;
            $pollAnswer->training_id = $training->id;
            $pollAnswer->user_id = $userId;
            switch ($question->type) {
              case PollQuestion::TYPE_OPEN:
                $pollAnswer->answer_open = $answer;
                break;
              case PollQuestion::TYPE_ONE_CHOICE:
                $pollAnswer->answer = $answer;
                break;
              case PollQuestion::TYPE_MULTIPLE_CHOICE:
                $pollAnswer->answer_open = \yii\helpers\Json::encode($answer);
                break;
            }
            $pollAnswer->save();
          }
        }

        
        MgHelpers::setFlashSuccess('Dziękujemy za wypełneinie ankiety.');
        $transaction->commit();
        return $this->redirect('');
      } catch (\Exception $e) {
        MgHelpers::setFlashError($e->getMessage());
        $transaction->rollBack();
      }
    }


    return $this->render('view', ['model' => $training]);
  }
}
