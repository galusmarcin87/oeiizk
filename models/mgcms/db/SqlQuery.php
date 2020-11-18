<?php
namespace app\models\mgcms\db;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "sql_query".
 *
 * @property integer $id
 * @property string $name
 * @property string $query
 * @property string $created_on
 * @property integer $is_deleted
 * @property integer $created_by
 * @property string $params
 * @property string $hash
 *
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\SqlQueryUser[] $sqlQueryUsers
 * @property \app\models\mgcms\db\User[] $users
 */
class SqlQuery extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use SoftDeleteTrait;

  const SALT = 'a23d&ASDasd';

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name', 'created_by'], 'required'],
        [['query', 'params'], 'string'],
        [['created_on'], 'safe'],
        [['created_by'], 'integer'],
        [['name'], 'string', 'max' => 245],
        [['is_deleted'], 'number', 'max' => 1],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'sql_query';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'query' => Yii::t('app', 'Query'),
        'created_on' => Yii::t('app', 'Created On'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'params' => Yii::t('app', 'Params'),
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
    public function getSqlQueryUsers()
    {
        return $this->hasMany(SqlQueryUser::className(), ['sql_query_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('sql_query_user', ['sql_query_id' => 'id']);
    }

  /**
   * @inheritdoc
   * @return array mixed
   */
  public function behaviors()
  {
    return [
    ];
  }


  public function getHash()
  {
    return sha1(self::SALT . $this->id . $this->created_on);
  }
  
}
