<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "workshop_user".
 *
 * @property integer $user_id
 * @property integer $workshop_id
 * @property string $status
 *
 * @property \app\models\mgcms\db\User $user
 * @property \app\models\db\Workshop $workshop
 */
class WorkshopUser extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'workshop_id'], 'required'],
            [['user_id', 'workshop_id'], 'integer'],
            [['status'], 'string', 'max' => 45]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workshop_user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'workshop_id' => Yii::t('app', 'Workshop ID'),
            'status' => Yii::t('app', 'Status'),
            'trainingCode' => 'Symbol szkolenia',
            'trainingId' => 'Symbol szkolenia',
        ];
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
    public function getWorkshop()
    {
        return $this->hasOne(\app\models\db\Workshop::className(), ['id' => 'workshop_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\WorkshopUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\WorkshopUserQuery(get_called_class());
    }
}
