<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "poll".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $is_deleted
 * @property integer $created_by
 * @property integer $poll_template_id
 *
 * @property \app\models\db\PollTemplate $pollTemplate
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\PollPollQuestion[] $pollPollQuestions
 * @property \app\models\db\PollQuestion[] $pollQuestions
 * @property \app\models\db\Training[] $trainings
 * @property \app\models\db\TrainingTemplate[] $trainingTemplates
 */
class Poll extends \app\models\mgcms\db\AbstractRecord
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
            [['created_by', 'poll_template_id'], 'integer'],
            [['poll_template_id', 'name'], 'required'],
            [['name'], 'string', 'max' => 245],
            [['is_deleted'], 'integer', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poll';
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
            'poll_template_id' => Yii::t('app', 'Poll Template'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollTemplate()
    {
        return $this->hasOne(\app\models\db\PollTemplate::className(), ['id' => 'poll_template_id']);
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
    public function getPollPollQuestions()
    {
        return $this->hasMany(\app\models\db\PollPollQuestion::className(), ['poll_id' => 'id'])->orderBy(['order' => SORT_ASC]);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollQuestions()
    {
        return $this->hasMany(\app\models\db\PollQuestion::className(), ['id' => 'poll_question_id'])->viaTable('poll_poll_question', ['poll_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainings()
    {
        return $this->hasMany(\app\models\db\Training::className(), ['poll_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingTemplates()
    {
        return $this->hasMany(\app\models\db\TrainingTemplate::className(), ['poll_id' => 'id']);
    }
    }
