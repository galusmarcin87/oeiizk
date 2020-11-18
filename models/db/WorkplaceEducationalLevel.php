<?php

namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "workplace_educational_level".
 *
 * @property integer $workplace_id
 * @property integer $educational_level_id
 *
 * @property \app\models\db\EducationalLevel $educationalLevel
 * @property \app\models\db\Workplace $workplace
 */
class WorkplaceEducationalLevel extends \app\models\mgcms\db\AbstractRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workplace_id', 'educational_level_id'], 'required'],
            [['workplace_id', 'educational_level_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workplace_educational_level';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workplace_id' => Yii::t('app', 'Workplace ID'),
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
    public function getWorkplace()
    {
        return $this->hasOne(\app\models\db\Workplace::className(), ['id' => 'workplace_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\WorkplaceEducationalLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\WorkplaceEducationalLevelQuery(get_called_class());
    }
}
