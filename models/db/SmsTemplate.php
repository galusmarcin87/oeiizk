<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "sms_template".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $is_deleted
 * @property integer $created_by
 * @property string $text
 *
 * @property \app\models\mgcms\db\User $createdBy
 */
class SmsTemplate extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;
    use \app\models\mgcms\db\SoftDeleteTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_on'], 'safe'],
            [['created_by'], 'integer'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 245],
            [['is_deleted'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms_template';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_on' => Yii::t('app', 'Created On'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'text' => Yii::t('app', 'Text'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
    }
    
}
