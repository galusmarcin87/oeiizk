<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "workshop_lector".
 *
 * @property integer $workshop_id
 * @property integer $user_id
 *
 * @property \app\models\mgcms\db\User $user
 * @property \app\models\db\Workshop $workshop
 */
class WorkshopLector extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workshop_id', 'user_id'], 'required'],
            [['workshop_id', 'user_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workshop_lector';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workshop_id' => Yii::t('app', 'Workshop ID'),
            'user_id' => Yii::t('app', 'User ID'),
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
     * @return \app\models\db\WorkshopLectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\WorkshopLectorQuery(get_called_class());
    }
}
