<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "poll_template".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $created_by
 * @property integer $is_deleted
 * @property string $text
 * @property string $type
 * @property integer $file_id
 *
 * @property \app\models\db\Poll[] $polls
 * @property \app\models\mgcms\db\File $file
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\PollTemplateQuestion[] $pollTemplateQuestions
 * @property \app\models\db\PollQuestion[] $pollQuestions
 */
class PollTemplate extends \app\models\mgcms\db\AbstractRecord
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
            [['created_by', 'file_id'], 'integer'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 245],
            [['type'], 'string', 'max' => 50],
            [['is_deleted'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poll_template';
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
            'type' => Yii::t('app', 'Type'),
            'file_id' => Yii::t('app', 'File'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolls()
    {
        return $this->hasMany(\app\models\db\Poll::className(), ['poll_template_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'file_id']);
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
    public function getPollTemplateQuestions()
    {
        return $this->hasMany(\app\models\db\PollTemplateQuestion::className(), ['poll_template_id' => 'id'])->orderBy(['order' => SORT_ASC]);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollQuestions()
    {
        return $this->hasMany(\app\models\db\PollQuestion::className(), ['id' => 'poll_question_id'])->viaTable('poll_template_question', ['poll_template_id' => 'id']);
    }
    
  
}
