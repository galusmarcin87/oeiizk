<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_required".
 *
 * @property integer $training_2_id
 * @property integer $training_id
 *
 * @property \app\models\db\Training $training
 * @property \app\models\db\Training $trainingRequired
 */
class TrainingRequired extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_2_id', 'training_id'], 'required'],
            [['training_2_id', 'training_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_required';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'training_2_id' => Yii::t('app', 'Training Required'),
            'training_id' => Yii::t('app', 'Training'),
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
    public function getTrainingRequired()
    {
        return $this->hasOne(\app\models\db\Training::className(), ['id' => 'training_2_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\TrainingRequiredQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\TrainingRequiredQuery(get_called_class());
    }
}
