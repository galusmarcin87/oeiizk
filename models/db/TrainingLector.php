<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_lector".
 *
 * @property integer $training_id
 * @property integer $user_id
 *
 * @property \app\models\db\Training $training
 * @property \app\models\mgcms\db\User $user
 */
class TrainingLector extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_id', 'user_id'], 'required'],
            [['training_id', 'user_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_lector';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'training_id' => Yii::t('app', 'Training ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraining()
    {
        return $this->hasOne(\app\models\db\Training::className(), ['id' => 'training_id']);
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
     * @return \app\models\db\TrainingLectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\TrainingLectorQuery(get_called_class());
    }
}
