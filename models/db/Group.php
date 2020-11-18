<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $is_deleted
 * @property integer $created_by
 *
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\Newsletter[] $newsletters
 * @property \app\models\db\UserGroup[] $userGroups
 * @property \app\models\mgcms\db\User[] $users
 */
class Group extends \app\models\mgcms\db\AbstractRecord
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
            [['name'], 'string', 'max' => 245],
            [['is_deleted'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
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
    public function getNewsletters()
    {
        return $this->hasMany(\app\models\db\Newsletter::className(), ['group_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(\app\models\db\UserGroup::className(), ['group_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('user_group', ['group_id' => 'id']);
    }
    
}
