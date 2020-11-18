<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $subtitle
 * @property string $created_on
 * @property integer $created_by
 * @property string $code
 * @property string $info
 * @property string $link
 * @property string $link_to_registration
 * @property string $date_from
 * @property string $date_to
 * @property integer $file_id
 * @property integer $promoted_oeiizk
 * @property integer $promoted_pos
 * @property string $coments
 * @property integer $is_deleted
 * @property integer $type
 * @property integer $is_display_on_screen
 * @property integer $lab_id
 *
 * @property \app\models\mgcms\db\File $file
 * @property \app\models\db\Lab $lab
 * @property \app\models\mgcms\db\User $createdBy
 */
class Event extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name'], 'required'],
        [['created_on', 'date_from', 'date_to', 'file_id'], 'safe'],
        [['created_by', 'lab_id'], 'integer'],
        [['info', 'coments'], 'string'],
        [['code', 'type'], 'string', 'max' => 45],
        [['subtitle', 'link', 'name',], 'string', 'max' => 245],
        [['link_to_registration'], 'string', 'max' => 255],
        [['promoted_oeiizk', 'promoted_pos', 'is_deleted', 'is_display_on_screen'], 'integer', 'max' => 1]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'event';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'subtitle' => Yii::t('app', 'Subtitle'),
        'created_on' => Yii::t('app', 'Created On'),
        'code' => Yii::t('app', 'Code'),
        'info' => Yii::t('app', 'Info'),
        'link' => Yii::t('app', 'Link'),
        'link_to_registration' => Yii::t('app', 'Link do rejestracji'),
        'date_from' => Yii::t('app', 'Date From'),
        'date_to' => Yii::t('app', 'Date To'),
        'file_id' => Yii::t('app', 'File'),
        'promoted_oeiizk' => Yii::t('app', 'Promowane w Oeiizk'),
        'promoted_pos' => Yii::t('app', 'Promowane POS'),
        'coments' => Yii::t('app', 'Coments'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'type' => Yii::t('app', 'Type'),
        'is_display_on_screen' => Yii::t('app', 'Wyświetlane na monitorach'),
        'lab_id' => Yii::t('app', 'Lab'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getFile()
  {
    return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'file_id']);
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
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }
  
  public function getLink2(){
    return '/backend/oeiizk/event/view?id='.$this->id;
  }
}
