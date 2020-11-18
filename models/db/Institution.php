<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "institution".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $code
 * @property string $created_on
 * @property integer $created_by
 * @property integer $is_deleted
 * @property string $patron
 * @property string $city
 * @property string $community
 * @property string $county
 * @property string $province
 * @property string $street
 * @property string $house_no
 * @property string $postcode
 * @property string $post
 * @property string $phone
 * @property string $www
 * @property string $type
 * @property integer $is_verified
 * @property string $territory
 * @property string $school_group_name
 * @property string $delegacy
 * @property string $NIP
 * @property string $email
 * @property string $school_governing_body
 * @property string $fullName
 * @property string $labsStr
 *
 * @property app\models\mgcms\db\User $createdBy
 * @property \app\models\db\Lab[] $labs
 * @property \app\models\db\Workplace[] $workplaces
 */
class Institution extends \app\models\mgcms\db\AbstractRecord
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
        [['created_on'], 'safe'],
        [['created_by'], 'integer'],
        [['name', 'short_name', 'patron', 'city', 'community', 'county', 'province', 'street', 'post', 'www', 'school_group_name', 'delegacy', 'email', 'school_governing_body'], 'string', 'max' => 245],
        [['code'], 'string', 'max' => 100],
        [['is_deleted', 'is_verified'], 'boolean'],
        [['house_no'], 'string', 'max' => 10],
        [['postcode'], 'string', 'max' => 12],
        [['phone', 'type', 'territory', 'NIP'], 'string', 'max' => 45],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'institution';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'short_name' => Yii::t('app', 'Short Name'),
        'code' => Yii::t('app', 'Kod szkoły'),
        'created_on' => Yii::t('app', 'Created On'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'patron' => Yii::t('app', 'Patron'),
        'city' => Yii::t('app', 'City'),
        'community' => Yii::t('app', 'Gmina'),
        'county' => Yii::t('app', 'Powiat'),
        'province' => Yii::t('app', 'Województwo'),
        'street' => Yii::t('app', 'Street'),
        'house_no' => Yii::t('app', 'Numer domu'),
        'postcode' => Yii::t('app', 'Postcode'),
        'post' => Yii::t('app', 'Poczta'),
        'phone' => 'Telefon',
        'www' => Yii::t('app', 'Www'),
        'type' => Yii::t('app', 'Typ placówki'),
        'is_verified' => Yii::t('app', 'Is Verified'),
        'territory' => Yii::t('app', 'Obszar'),
        'school_group_name' => Yii::t('app', 'Struktura'),
        'delegacy' => Yii::t('app', 'Delegacy'),
        'NIP' => Yii::t('app', 'Nip'),
        'email' => Yii::t('app', 'Email'),
        'school_governing_body' => Yii::t('app', 'Organ prowadzący'),
        'labsStr' => 'Sale',
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
  public function getLabs()
  {
    return $this->hasMany(\app\models\db\Lab::className(), ['institution_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkplaces()
  {
    return $this->hasMany(\app\models\db\Workplace::className(), ['institution_id' => 'id']);
  }
  
  public function getFullName(){
    return $this->code .' '.$this->name.' '.$this->city.' '.$this->street;
  }
  
  public function getLabsStr()
  {
    return join(', ', array_map(function($x) {
          return $x->name;
        }, $this->getLabs()->all()));
  }

}
