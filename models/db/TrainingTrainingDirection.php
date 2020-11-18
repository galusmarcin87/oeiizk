<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_training_direction".
 *
 * @property integer $training_id
 * @property integer $training_direction_id
 *
 * @property \app\models\db\Training $training
 * @property \app\models\db\TrainingDirection $trainingDirection
 */
class TrainingTrainingDirection extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_id', 'training_direction_id'], 'required'],
            [['training_id', 'training_direction_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_training_direction';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'training_id' => Yii::t('app', 'Training ID'),
            'training_direction_id' => Yii::t('app', 'Training Direction ID'),
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
    public function getTrainingDirection()
    {
        return $this->hasOne(\app\models\db\TrainingDirection::className(), ['id' => 'training_direction_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\TrainingTrainingDirectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\TrainingTrainingDirectionQuery(get_called_class());
    }
}
