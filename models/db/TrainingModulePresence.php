<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_module_presence".
 *
 * @property integer $training_module_id
 * @property integer $user_id
 * @property string $note
 *
 * @property \app\models\db\TrainingModule $trainingModule
 * @property \app\models\mgcms\db\User $user
 */
class TrainingModulePresence extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_module_id', 'user_id'], 'required'],
            [['training_module_id', 'user_id'], 'integer'],
            [['note'], 'string', 'max' => 245]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_module_presence';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'training_module_id' => Yii::t('app', 'Training Module ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingModule()
    {
        return $this->hasOne(\app\models\db\TrainingModule::className(), ['id' => 'training_module_id']);
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
     * @return \app\models\db\TrainingModulePresenceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\TrainingModulePresenceQuery(get_called_class());
    }
}
