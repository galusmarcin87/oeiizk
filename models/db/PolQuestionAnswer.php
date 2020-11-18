<?php
namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;
use app\models\db\PollQuestion;

/**
 * This is the base model class for table "pol_question_answer".
 *
 * @property integer $poll_poll_question_poll_id
 * @property integer $poll_poll_question_poll_question_id
 * @property integer $user_id
 * @property string $answer
 * @property string $answer_open
 * @property integer $training_id
 *
 * @property \app\models\db\Training $training
 * @property \app\models\db\PollPollQuestion $pollPollQuestionPoll
 * @property \app\models\mgcms\db\User $user
 */
class PolQuestionAnswer extends \app\models\mgcms\db\AbstractRecord
{

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['poll_poll_question_poll_id', 'poll_poll_question_poll_question_id', 'user_id', 'training_id'], 'required'],
        [['poll_poll_question_poll_id', 'poll_poll_question_poll_question_id', 'user_id', 'training_id'], 'integer'],
        [['answer_open'], 'string'],
        [['answer'], 'string', 'max' => 245]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'pol_question_answer';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'poll_poll_question_poll_id' => Yii::t('app', 'Poll Poll Question Poll ID'),
        'poll_poll_question_poll_question_id' => Yii::t('app', 'Poll Poll Question Poll Question ID'),
        'user_id' => Yii::t('app', 'User ID'),
        'answer' => Yii::t('app', 'Answer'),
        'answer_open' => Yii::t('app', 'Answer Open'),
        'training_id' => Yii::t('app', 'Training ID'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTraining()
  {
    return $this->hasOne(\app\models\db\Training::className(), ['id' => 'training_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollPollQuestionPoll()
  {
    return $this->hasOne(\app\models\db\PollPollQuestion::className(), ['poll_id' => 'poll_poll_question_poll_id', 'poll_question_id' => 'poll_poll_question_poll_question_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUser()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'user_id']);
  }

  /**
   * @inheritdoc
   * @return \app\models\mgcms\db\PolQuestionAnswerQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\mgcms\db\PolQuestionAnswerQuery(get_called_class());
  }

  public static function getUserAnswer($pollId, $questionId, $userId, $trainingId, $type)
  {
    $answer = self::find()->where([
            'poll_poll_question_poll_question_id' => $questionId,
            'poll_poll_question_poll_id' => $pollId,
            'user_id' => $userId,
            'training_id' => $trainingId
        ])->one();
    if ($answer) {
      switch ($type) {
        case PollQuestion::TYPE_OPEN:
          return $answer->answer_open;
          break;
        case PollQuestion::TYPE_ONE_CHOICE:
          return $answer->answer;
          break;
        case PollQuestion::TYPE_MULTIPLE_CHOICE:
          return join(', ', \yii\helpers\Json::decode($answer->answer_open));
          break;
      }
    }else{
      return null;
    }
  }

  public static function countAnswers($pollId, $questionId, $trainingId, $type, $answer)
  {
    switch ($type) {
      case PollQuestion::TYPE_ONE_CHOICE:
        return self::find()->where([
                'poll_poll_question_poll_question_id' => $questionId,
                'poll_poll_question_poll_id' => $pollId,
                'answer' => $answer,
                'training_id' => $trainingId
            ])->count();
        break;
      case PollQuestion::TYPE_MULTIPLE_CHOICE:
        return self::find()->where([
                'poll_poll_question_poll_question_id' => $questionId,
                'poll_poll_question_poll_id' => $pollId,
                'training_id' => $trainingId
            ])->andWhere([
                'like', 'answer_open', '"' . $answer . '"'
            ])->count();
        break;
    }
  }
}
