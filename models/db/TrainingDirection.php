<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_direction".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_deleted
 * @property string $created_on
 * @property integer $created_by
 * @property integer $order
 *
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\TrainingTrainingDirection[] $trainingTrainingDirections
 * @property \app\models\db\Training[] $trainings
 */
class TrainingDirection extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;
    use \app\models\mgcms\db\SoftDeleteTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_on'], 'safe'],
            [['created_by', 'order'], 'integer'],
            [['name'], 'string', 'max' => 245],
            [['is_deleted'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_direction';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_on' => Yii::t('app', 'Created On'),
            'order' => Yii::t('app', 'Order'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingTrainingDirections()
    {
        return $this->hasMany(\app\models\db\TrainingTrainingDirection::className(), ['training_direction_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainings()
    {
        return $this->hasMany(\app\models\db\Training::className(), ['id' => 'training_id'])->viaTable('training_training_direction', ['training_direction_id' => 'id']);
    }
    
}
