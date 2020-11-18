<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "workshop".
 *
 * @property integer $id
 * @property string $title
 * @property string $created_on
 * @property integer $is_deleted
 * @property integer $created_by
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property integer $lab_id
 * @property integer $training_id
 * @property integer $order
 *
 * @property \app\models\db\Lab $lab
 * @property \app\models\db\Training $training
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\WorkshopLector[] $workshopLectors
 * @property \app\models\mgcms\db\User[] $users
 * @property \app\models\db\WorkshopUser[] $workshopUsers
 */
class Workshop extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;
    use \app\models\mgcms\db\SoftDeleteTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'training_id'], 'required'],
            [['created_on', 'date_start', 'date_end'], 'safe'],
            [['created_by', 'lab_id', 'training_id', 'order'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 245],
            [['is_deleted'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workshop';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'created_on' => Yii::t('app', 'Created On'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'description' => Yii::t('app', 'Description'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'lab_id' => Yii::t('app', 'Lab ID'),
            'lab_id' => Yii::t('app', 'Lab'),
            'training_id' => Yii::t('app', 'Training ID'),
            'training_id' => Yii::t('app', 'Training'),
            'order' => Yii::t('app', 'Order'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(\app\models\db\Lab::className(), ['id' => 'lab_id']);
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
    public function getCreatedBy()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshopLectors()
    {
        return $this->hasMany(\app\models\db\WorkshopLector::className(), ['workshop_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('workshop_user', ['workshop_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkshopUsers()
    {
        return $this->hasMany(\app\models\db\WorkshopUser::className(), ['workshop_id' => 'id']);
    }
    
    public function __toString()
    {
      return $this->title;
    }
    
    public function getLink2(){
    return '/backend/oeiizk/workshop/view?id='.$this->id;
  }
    

}
