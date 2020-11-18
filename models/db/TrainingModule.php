<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_module".
 *
 * @property integer $id
 * @property string $subject
 * @property string $date_start
 * @property string $date_end
 * @property string $description
 * @property integer $hours
 * @property integer $training_id
 * @property integer $created_by
 * @property integer $is_deleted
 *
 * @property \app\models\db\Training $training
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\TrainingModulePresence[] $trainingModulePresences
 * @property \app\models\mgcms\db\User[] $users
 */
class TrainingModule extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['date_start', 'date_end'], 'safe'],
        [['description'], 'string'],
        [['hours', 'training_id', 'created_by'], 'integer'],
        [['training_id'], 'required'],
        [['subject'], 'string', 'max' => 245],
        [['is_deleted'], 'integer', 'max' => 1]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'training_module';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'subject' => Yii::t('app', 'Subject'),
        'date_start' => Yii::t('app', 'Date Start'),
        'date_end' => Yii::t('app', 'Date End'),
        'description' => 'Temat',
        'hours' => Yii::t('app', 'Hours'),
        'training_id' => Yii::t('app', 'Training'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
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
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingModulePresences()
  {
    return $this->hasMany(\app\models\db\TrainingModulePresence::className(), ['training_module_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUsers()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('training_module_presence', ['training_module_id' => 'id']);
  }


  public function __toString()
  {
    return $this->subject . ' (' . $this->training . ')';
  }
}
