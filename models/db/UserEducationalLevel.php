<?php

namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "user_educational_level".
 *
 * @property integer $user_id
 * @property integer $educational_level_id
 *
 * @property \app\models\db\EducationalLevel $educationalLevel
 * @property \app\models\mgcms\db\User $user
 */
class UserEducationalLevel extends \app\models\mgcms\db\AbstractRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'educational_level_id'], 'required'],
            [['user_id', 'educational_level_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_educational_level';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'educational_level_id' => Yii::t('app', 'Educational Level ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationalLevel()
    {
        return $this->hasOne(\app\models\db\EducationalLevel::className(), ['id' => 'educational_level_id']);
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
     * @return \app\models\db\UserEducationalLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\UserEducationalLevelQuery(get_called_class());
    }
}
