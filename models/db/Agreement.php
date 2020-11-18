<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "agreement".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $is_deleted
 * @property string $created_on
 * @property integer $created_by
 * @property integer $order
 * @property integer $is_required
 * @property integer $is_cancel
 *
 * @property \app\models\db\User $createdBy
 * @property \app\models\db\UserAgreement[] $userAgreements
 * @property \app\models\db\User[] $users
 */
class Agreement extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;
    use \app\models\mgcms\db\SoftDeleteTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['created_on'], 'safe'],
            [['created_by', 'order'], 'integer'],
            [['name'], 'string', 'max' => 245],
            [['is_deleted', 'is_required', 'is_cancel'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agreement';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'text' => Yii::t('app', 'Text'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_on' => Yii::t('app', 'Created On'),
            'order' => Yii::t('app', 'Order'),
            'is_required' => Yii::t('app', 'Is Required'),
            'is_cancel' => Yii::t('app', 'Wycofana'),
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
    public function getUserAgreements()
    {
        return $this->hasMany(\app\models\db\UserAgreement::className(), ['agreement_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('user_agreement', ['agreement_id' => 'id']);
    }
    
    /**
     * 
     * @return Agreement
     */
    public static function getNewsletterAgreement(){
      return self::find()->andWhere(['name'=>'newsletter'])->one();
    }
    
}
