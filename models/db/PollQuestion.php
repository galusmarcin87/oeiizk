<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "poll_question".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $created_by
 * @property integer $is_deleted
 * @property string $type
 * @property string $typeStr
 * @property string $question
 * @property string $options_json
 * @property integer $is_individual
 * @property integer $is_required
 * @property integer $order
 *
 * @property \app\models\db\PollPollQuestion[] $pollPollQuestions
 * @property \app\models\db\Poll[] $polls
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\PollTemplateQuestion[] $pollTemplateQuestions
 * @property \app\models\db\PollTemplate[] $pollTemplates
 */
class PollQuestion extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  const TYPE_ONE_CHOICE = 0;
  const TYPE_MULTIPLE_CHOICE = 1;
  const TYPE_OPEN = 2;
  const TYPES = [
      self::TYPE_ONE_CHOICE => 'jednokrotnego wyboru',
      self::TYPE_MULTIPLE_CHOICE => 'wielokrotnego wyboru',
      self::TYPE_OPEN => 'otwarte',
  ];

  public $option;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name'], 'required'],
        [['created_on', 'option'], 'safe'],
        [['created_by', 'type', 'order'], 'integer'],
        [['question', 'options_json'], 'string'],
        [['name'], 'string', 'max' => 45],
        [['is_deleted', 'is_individual', 'is_required'], 'integer', 'max' => 1]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'poll_question';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'created_on' => Yii::t('app', 'Created On'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'type' => Yii::t('app', 'Type'),
        'typeStr' => Yii::t('app', 'Type'),
        'question' => Yii::t('app', 'Question'),
        'options_json' => Yii::t('app', 'Options Json'),
        'is_individual' => Yii::t('app', 'Indywidualne'),
        'is_required' => Yii::t('app', 'Is Required'),
        'order' => Yii::t('app', 'Order'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollPollQuestions()
  {
    return $this->hasMany(\app\models\db\PollPollQuestion::className(), ['poll_question_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPolls()
  {
    return $this->hasMany(\app\models\db\Poll::className(), ['id' => 'poll_id'])->viaTable('poll_poll_question', ['poll_question_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollTemplateQuestions()
  {
    return $this->hasMany(\app\models\db\PollTemplateQuestion::className(), ['poll_question_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollTemplates()
  {
    return $this->hasMany(\app\models\db\PollTemplate::className(), ['id' => 'poll_template_id'])->viaTable('poll_template_question', ['poll_question_id' => 'id']);
  }

  public function saveAll($skippedRelations = array())
  {
    $isNewRecord = $this->isNewRecord;
    $saved = parent::saveAll($skippedRelations);
    if ($saved) {
      if (is_array($this->option)) {
        $optionsArr = [];
        foreach ($this->option as $option) {
          $optionsArr[] = $option;
        }
        $this->setModelAttribute('option', \yii\helpers\Json::encode($optionsArr));
      } else {
        $this->setModelAttribute('option', \yii\helpers\Json::encode([]));
      }
      if ($isNewRecord) {
        $this->assignRequiredQuestionToPolls();
      }
    }
    return $saved;
  }

  public function getTypeStr()
  {
    return isset(self::TYPES[$this->type]) ? self::TYPES[$this->type] : $this->type;
  }

  private function assignRequiredQuestionToPolls()
  {
    if ($this->is_required) {
      $polls = Poll::find()->all();
      foreach ($polls as $poll) {
        $pollQuestion = new PollPollQuestion;
        $pollQuestion->poll_id = $poll->id;
        $pollQuestion->poll_question_id = $this->id;
        $pollQuestion->save();
      }

      $pollTemplatess = PollTemplate::find()->all();
      foreach ($pollTemplatess as $poll) {
        $pollQuestion = new PollTemplateQuestion;
        $pollQuestion->poll_template_id = $poll->id;
        $pollQuestion->poll_question_id = $this->id;
        $pollQuestion->save();
      }
    }
  }
}
