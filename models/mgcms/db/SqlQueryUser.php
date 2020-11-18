<?php

namespace app\models\mgcms\db;

use Yii;

/**
 * This is the base model class for table "sql_query_user".
 *
 * @property integer $sql_query_id
 * @property integer $user_id
 *
 * @property \app\models\mgcms\db\SqlQuery $sqlQuery
 * @property \app\models\mgcms\db\User $user
 */
class SqlQueryUser extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sql_query_id', 'user_id'], 'required'],
            [['sql_query_id', 'user_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sql_query_user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sql_query_id' => Yii::t('app', 'Sql Query ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSqlQuery()
    {
        return $this->hasOne(\app\models\mgcms\db\SqlQuery::className(), ['id' => 'sql_query_id']);
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
     * @return \app\models\mgcms\db\SqlQueryUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\mgcms\db\SqlQueryUserQuery(get_called_class());
    }
}
