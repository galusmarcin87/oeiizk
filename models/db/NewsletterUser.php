<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "newsletter_user".
 *
 * @property integer $id
 * @property integer $newsletter_id
 * @property integer $user_id
 * @property integer $status
 * @property string $info
 * @property string $email
 *
 * @property \app\models\db\Newsletter $newsletter
 * @property \app\models\mgcms\db\User $user
 */
class NewsletterUser extends \app\models\mgcms\db\AbstractRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'newsletter_id'], 'required'],
            [['id', 'newsletter_id', 'user_id', 'status'], 'integer'],
            [['info'], 'string'],
            [['email'], 'string', 'max' => 245]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter_user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'newsletter_id' => Yii::t('app', 'Newsletter ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'info' => Yii::t('app', 'Info'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletter()
    {
        return $this->hasOne(\app\models\db\Newsletter::className(), ['id' => 'newsletter_id']);
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
     * @return \app\models\db\NewsletterUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\NewsletterUserQuery(get_called_class());
    }
}
