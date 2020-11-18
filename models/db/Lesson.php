<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "lesson".
 *
 * @property integer $id
 * @property string $subject
 * @property string $date_start
 * @property string $date_end
 * @property string $created_on
 * @property integer $created_by
 * @property integer $training_id
 * @property integer $lab_id
 * @property integer $hours_count
 * @property integer $is_deleted
 *
 * @property \app\models\db\Lab $lab
 * @property \app\models\db\Training $training
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\LessonPresence[] $lessonPresences
 * @property \app\models\mgcms\db\User[] $users
 */
class Lesson extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  public $interval;
  public $lessonsCount;
  public $generateHours;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['subject'], 'string'],
        [['date_start', 'date_end', 'created_on', 'interval', 'lessonsCount'], 'safe'],
        [['created_by', 'training_id', 'lab_id', 'hours_count', 'interval'], 'integer'],
        [['training_id'], 'required'],
        [['is_deleted'], 'integer', 'max' => 1],
        [['date_start', 'interval', 'lessonsCount', 'generateHours'], 'required', 'on' => 'generate'],
        [['date_start'], 'validateDates'],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'lesson';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'subject' => Yii::t('app', 'Temat'),
        'date_start' => Yii::t('app', 'Date Start'),
        'date_end' => Yii::t('app', 'Date End'),
        'created_on' => Yii::t('app', 'Created On'),
        'training_id' => Yii::t('app', 'Training ID'),
        'training' => Yii::t('app', 'Training'),
        'lab_id' => Yii::t('app', 'Lab'),
        'lab' => Yii::t('app', 'Lab'),
        'hours_count' => Yii::t('app', 'Hours Count'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'interval' => Yii::t('app', 'Interwał (co ile dni)'),
        'lessonsCount' => Yii::t('app', 'Liczba lekcji'),
        'generateHours' => 'Czas trwania (w godz)',
    ];
  }
  
   public function validateDates($attribute, $params)
  {
    if (!$this->hasErrors()) {
      if (strtotime($this->date_start) > strtotime($this->date_end)) {
        $this->addError($attribute, 'Data od musi być wcześniejsza niż data do');
      }
    }
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLab()
  {
    return $this->hasOne(\app\models\db\Lab::className(), ['id' => 'lab_id']);
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
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLessonPresences()
  {
    return $this->hasMany(\app\models\db\LessonPresence::className(), ['training_lesson_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUsers()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('lesson_presence', ['training_lesson_id' => 'id']);
  }

  public function __toString()
  {
    return $this->subject ? $this->subject : 'Lekcja ' . $this->id;
  }

  public function getTrainingParticipantsPresences()
  {
    $arr = [];
    foreach ($this->training->participants as $participant) {
      $presence = new LessonPresence;
      $presence->user_id = $participant->id;
      $presence->training_lesson_id = $this->id;
      $arr[] = $presence;
    }
    return $arr;
  }
  
  public  function getLink(){
    return '/backend/oeiizk/lesson/view?id='.$this->id;
  }
}
