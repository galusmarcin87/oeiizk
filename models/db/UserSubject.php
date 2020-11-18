<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "user_subject".
 *
 * @property integer $subject_id
 * @property integer $user_id
 *
 * @property \app\models\db\Subject $subject
 * @property \app\models\mgcms\db\User $user
 */
class UserSubject extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'user_id'], 'required'],
            [['subject_id', 'user_id'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_subject';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => Yii::t('app', 'Subject ID'),
            'user_id' => Yii::t('app', 'User ID'),
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
    public function getUser()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\UserSubjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\UserSubjectQuery(get_called_class());
    }
}
