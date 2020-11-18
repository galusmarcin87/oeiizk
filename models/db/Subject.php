<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "subject".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $status
 * @property string $group
 *
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\Training[] $trainings
 * @property \app\models\db\TrainingTemplate[] $trainingTemplates
 * @property \app\models\mgcms\db\UserSubject[] $userSubjects
 * @property \app\models\mgcms\db\User[] $users
 * @property \app\models\db\WorkplaceSubject[] $workplaceSubjects
 * @property \app\models\db\Workplace[] $workplaces
 */
class Subject extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  const STATUS_ACTIVE = 1;
  const STATUS_INACTIVE = 0;
  const STATUSES = [
      self::STATUS_ACTIVE => 'active',
      self::STATUS_INACTIVE => 'inactive',
  ];

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name', 'created_by'], 'required'],
        [['created_by', 'status'], 'integer'],
        [['name', 'group'], 'string', 'max' => 245],
        [['is_deleted'], 'integer', 'max' => 1],
        ['created_on','safe'],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'subject';
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
        'status' => Yii::t('app', 'Status'),
        'statusStr' => Yii::t('app', 'Status'),
        'group' => Yii::t('app', 'Group'),
    ];
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
  public function getTrainings()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['subject_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingTemplates()
  {
    return $this->hasMany(\app\models\db\TrainingTemplate::className(), ['subject_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserSubjects()
  {
    return $this->hasMany(\app\models\db\UserSubject::className(), ['subject_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUsers()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('user_subject', ['subject_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkplaceSubjects()
  {
    return $this->hasMany(\app\models\db\WorkplaceSubject::className(), ['subject_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkplaces()
  {
    return $this->hasMany(\app\models\db\Workplace::className(), ['id' => 'workplace_id'])->viaTable('workplace_subject', ['subject_id' => 'id']);
  }

  
  public function getStatusStr()
  {
    return Yii::t('app', self::STATUSES[$this->status]);
  }
}
