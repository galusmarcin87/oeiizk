<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "user_agreement".
 *
 * @property integer $agreement_id
 * @property integer $user_id
 * @property string $created_on
 * @property string $expiry_date
 *
 * @property \app\models\db\Agreement $agreement
 * @property \app\models\mgcms\db\User $user
 */
class UserAgreement extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agreement_id', 'user_id'], 'required'],
            [['agreement_id', 'user_id'], 'integer'],
            [['created_on', 'expiry_date'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_agreement';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agreement_id' => Yii::t('app', 'Agreement ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'expiry_date' => Yii::t('app', 'Expiry Date'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgreement()
    {
        return $this->hasOne(\app\models\db\Agreement::className(), ['id' => 'agreement_id']);
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
     * @return \app\models\db\UserAgreementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\UserAgreementQuery(get_called_class());
    }
}
