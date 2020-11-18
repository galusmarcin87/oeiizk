<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "user_group".
 *
 * @property integer $group_id
 * @property integer $user_id
 *
 * @property \app\models\db\Group $group
 * @property \app\models\mgcms\db\User $user
 */
class UserGroup extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'user_id'], 'required'],
            [['group_id', 'user_id'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => Yii::t('app', 'Group ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(\app\models\db\Group::className(), ['id' => 'group_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\UserGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\UserGroupQuery(get_called_class());
    }
}
