<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "workplace_subject".
 *
 * @property integer $workplace_id
 * @property integer $subject_id
 *
 * @property \app\models\db\Subject $subject
 * @property \app\models\db\Workplace $workplace
 */
class WorkplaceSubject extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workplace_id', 'subject_id'], 'required'],
            [['workplace_id', 'subject_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workplace_subject';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workplace_id' => Yii::t('app', 'Workplace ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(\app\models\db\Subject::className(), ['id' => 'subject_id']);
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
     * @return \app\models\db\WorkplaceSubjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\WorkplaceSubjectQuery(get_called_class());
    }
}
