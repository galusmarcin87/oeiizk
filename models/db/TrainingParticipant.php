<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "training_participant".
 *
 * @property integer $id
 * @property integer $training_id
 * @property integer $user_id
 * @property integer $order
 * @property string $surname
 * @property string $workplace
 * @property string $status
 * @property string $created_on
 * @property integer $is_reserve
 * @property integer $is_paid
 * @property double $paid_missing
 * @property integer $is_passed
 * @property integer $is_print_certificate
 * @property integer $created_by
 * @property boolean $is_certificate_printed
 *
 * @property \app\models\db\Training $training
 * @property \app\models\mgcms\db\User $user
 * @property \app\models\mgcms\db\User $createdBy
 */
class TrainingParticipant extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    const STATUS_RESERVE = 'lista rezerwowa';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_id', 'user_id'], 'required'],
            [['training_id', 'user_id', 'order', 'created_by'], 'integer'],
            [['created_on'], 'safe'],
            [['paid_missing'], 'number'],
            [['surname', 'workplace'], 'string', 'max' => 245],
            [['status'], 'string', 'max' => 45],
            [['is_reserve', 'is_paid', 'is_passed', 'is_print_certificate', 'is_certificate_printed'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_participant';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'training_id' => Yii::t('app', 'Training'),
            'user_id' => Yii::t('app', 'User'),
            'order' => Yii::t('app', 'Order'),
            'surname' => Yii::t('app', 'Surname'),
            'workplace' => Yii::t('app', 'Workplace'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'is_reserve' => Yii::t('app', 'Is Reserve'),
            'is_paid' => Yii::t('app', 'Is Paid'),
            'paid_missing' => Yii::t('app', 'Paid Missing'),
            'is_passed' => 'Zaliczenie',
            'is_print_certificate' => Yii::t('app', 'Is Print Certificate'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\TrainingParticipantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\TrainingParticipantQuery(get_called_class());
    }
    
    public function save($runValidaton = true, $attributes = null)
    {
      if($this->is_passed){
        $this->status = 'ukończenie szkolenia';
      }
      $saved = parent::save($runValidaton, $attributes);
      return $saved;
    }
    
    public function canByGenerated(){
      return !in_array($this->status, ['wykreślenie','rezygnacja przed zapisem','rezygnacja zamiast potwierdzenia','lista rezerwowa', self::STATUS_RESERVE]);
    }
    
    public function canConfirm(){
        if($this->training->is_card_required && !$this->user->employment_card_id){
            return false;
        }
      return !in_array($this->status, ['wykreślenie','rezygnacja przed zapisem','rezygnacja zamiast potwierdzenia','lista rezerwowa', self::STATUS_RESERVE,"potwierdzenie samodzielnie","potwierdzenie przez dos","potwierdzenie przez DOS",'potwierdzenie samodzielne']);
    }
}
