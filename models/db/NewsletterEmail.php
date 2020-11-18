<?php

namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "newsletter_email".
 *
 * @property integer $id
 * @property string $email
 * @property string $created_on
 */
class NewsletterEmail extends \app\models\mgcms\db\AbstractRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_on'], 'safe'],
            [['email'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newsletter_email';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\NewsletterEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\mgcms\db\NewsletterEmailQuery(get_called_class());
    }
}
