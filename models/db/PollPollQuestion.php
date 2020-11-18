<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "poll_poll_question".
 *
 * @property integer $poll_id
 * @property integer $poll_question_id
 * @property integer $order
 *
 * @property \app\models\db\PolQuestionAnswer[] $polQuestionAnswers
 * @property \app\models\db\Poll $poll
 * @property \app\models\db\PollQuestion $pollQuestion
 */
class PollPollQuestion extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['poll_id', 'poll_question_id'], 'required'],
        [['poll_id', 'poll_question_id'], 'integer'],
        [['order'], 'integer', 'max' => 99999],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'poll_poll_question';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'poll_id' => Yii::t('app', 'Poll ID'),
        'poll_question_id' => Yii::t('app', 'Poll Question ID'),
        'order' => Yii::t('app', 'Order'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPolQuestionAnswers()
  {
    return $this->hasMany(\app\models\db\PolQuestionAnswer::className(), ['poll_poll_question_poll_id' => 'poll_id', 'poll_poll_question_poll_question_id' => 'poll_question_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPoll()
  {
    return $this->hasOne(\app\models\db\Poll::className(), ['id' => 'poll_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollQuestion()
  {
    return $this->hasOne(\app\models\db\PollQuestion::className(), ['id' => 'poll_question_id']);
  }

  /**
   * @inheritdoc
   * @return \app\models\db\PollPollQuestionQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\db\PollPollQuestionQuery(get_called_class());
  }
}
