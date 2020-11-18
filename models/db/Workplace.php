<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "workplace".
 *
 * @property integer $id
 * @property string $position
 * @property string $school_type
 * @property string $educational_level
 * @property integer $user_id
 * @property integer $institution_id
 *
 * @property \app\models\db\Institution $institution
 * @property app\models\mgcms\db\User $user
 * @property \app\models\db\WorkplaceSubject[] $workplaceSubjects
 * @property \app\models\db\Subject[] $subjects
 * @property \app\models\db\WorkplaceEducationalLevel[] $workplaceEducationalLevels
 * @property \app\models\db\EducationalLevel[] $educationalLevels
 */
class Workplace extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['user_id'], 'required'],
        [['user_id', 'institution_id'], 'integer'],
        [['position'], 'string', 'max' => 245],
        [['school_type', 'educational_level'], 'string', 'max' => 45]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'workplace';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'position' => Yii::t('app', 'Position'),
        'school_type' => Yii::t('app', 'School Type'),
        'educational_level' => Yii::t('app', 'Educational Level'),
        'user_id' => Yii::t('app', 'User'),
        'institution_id' => Yii::t('app', 'Institution'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getInstitution()
  {
    return $this->hasOne(\app\models\db\Institution::className(), ['id' => 'institution_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUser()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'user_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkplaceSubjects()
  {
    return $this->hasMany(\app\models\db\WorkplaceSubject::className(), ['workplace_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSubjects()
  {
    return $this->hasMany(\app\models\db\Subject::className(), ['id' => 'subject_id'])->viaTable('workplace_subject', ['workplace_id' => 'id']);
  }

  /**
   * @inheritdoc
   * @return \app\models\db\WorkplaceQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\db\WorkplaceQuery(get_called_class());
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkplaceEducationalLevels()
  {
    return $this->hasMany(\app\models\db\WorkplaceEducationalLevel::className(), ['workplace_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEducationalLevels()
  {
    return $this->hasMany(\app\models\db\EducationalLevel::className(), ['id' => 'educational_level_id'])->viaTable('workplace_educational_level', ['workplace_id' => 'id']);
  }
  
  public function __toString()
  {
    return $this->institution ? $this->institution : '';
  }
}
