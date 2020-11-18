<?php
namespace app\models\db;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the base model class for table "role".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 *
 * @property \app\models\mgcms\db\UserRole[] $userRoles
 * @property \app\models\mgcms\db\User[] $users
 */
class Role extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  const ROLE_PARTICIPANT = 'uczestnik';
  const ROLE_WORKER = 'pracownik';
  const ROLE_LECTOR = 'wykladowca';
  const ROLE_DOS = 'dos';
  const ROLE_DIRECTOR = 'dyrektor';

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name'], 'required'],
        [['description'], 'string'],
        [['name', 'slug'], 'string', 'max' => 245]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'role';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'slug' => Yii::t('app', 'Slug'),
        'description' => Yii::t('app', 'Description'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserRoles()
  {
    return $this->hasMany(UserRole::className(), ['role_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUsers()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('user_role', ['role_id' => 'id']);
  }

  /**
   * @inheritdoc
   * @return \app\models\db\RoleQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\db\RoleQuery(get_called_class());
  }

  public function behaviors()
  {
    return [
        [
            'class' => SluggableBehavior::className(),
            'attribute' => 'name',
            'slugAttribute' => 'slug',
            'immutable' => true,
        ],
    ];
  }
}
