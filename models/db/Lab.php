<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "lab".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_headquarter_name
 * @property integer $institution_id
 * @property string $long_name
 * @property integer $floor
 * @property integer $is_our
 * @property integer $created_by
 * @property string $created_on
 * @property integer $is_deleted
 * @property string $fullName
 * @property string $shorterName
 *
 * @property \app\models\db\Event[] $events
 * @property \app\models\db\Institution $institution
 * @property app\models\mgcms\db\User $createdBy
 * @property \app\models\db\Lesson[] $lessons
 * @property \app\models\db\Training[] $trainings
 * @property \app\models\db\Workshop[] $workshops
 */
class Lab extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['institution_id', 'floor', 'created_by'], 'integer'],
        [['long_name'], 'string'],
        [['created_on'], 'safe'],
        [['name', 'short_headquarter_name'], 'string', 'max' => 245],
        [['is_deleted','is_our'], 'integer', 'max' => 1],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'lab';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'short_headquarter_name' => Yii::t('app', 'Krótka nazwa siedziby'),
        'institution_id' => Yii::t('app', 'Institution ID'),
        'long_name' => Yii::t('app', 'Long Name'),
        'floor' => Yii::t('app', 'Piętro'),
        'is_our' => Yii::t('app', 'Nasza'),
        'created_on' => Yii::t('app', 'Created On'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEvents()
  {
    return $this->hasMany(\app\models\db\Event::className(), ['lab_id' => 'id']);
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
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLessons()
  {
    return $this->hasMany(\app\models\db\Lesson::className(), ['lab_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainings()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['lab_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkshops()
  {
    return $this->hasMany(\app\models\db\Workshop::className(), ['lab_id' => 'id']);
  }

  public function __toString()
  {
    $florLabel = $this->floor ? ', ' . $this->floor . ' piętro' : '';
    return $this->name . ' (' . $this->institution . $florLabel . ')';
  }

  public function getFullName()
  {
    $institution = $this->institution;
    return $institution->name . ', ul. ' . $institution->street . ' ' . $institution->house_no . ', ' . $this->name;
  }
  
  public function getFullNameWithoutLabName()
  {
    $institution = $this->institution;
    return $institution->name . ', ul. ' . $institution->street . ' ' . $institution->house_no;
  }

  public function getShorterName()
  {
    $institution = $this->institution;
    return $this->name . " ($institution->short_name)";
  }
}
