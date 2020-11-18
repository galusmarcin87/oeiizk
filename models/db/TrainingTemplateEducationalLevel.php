<?php

namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "training_template_educational_level".
 *
 * @property integer $training_template_id
 * @property integer $educational_level_id
 *
 * @property \app\models\db\EducationalLevel $educationalLevel
 * @property \app\models\db\TrainingTemplate $trainingTemplate
 */
class TrainingTemplateEducationalLevel extends \app\models\mgcms\db\AbstractRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_template_id', 'educational_level_id'], 'required'],
            [['training_template_id', 'educational_level_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_template_educational_level';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'training_template_id' => Yii::t('app', 'Training Template ID'),
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
    public function getTrainingTemplate()
    {
        return $this->hasOne(\app\models\db\TrainingTemplate::className(), ['id' => 'training_template_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\TrainingTemplateEducationalLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\TrainingTemplateEducationalLevelQuery(get_called_class());
    }
}
