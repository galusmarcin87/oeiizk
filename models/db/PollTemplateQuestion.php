<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "poll_template_question".
 *
 * @property integer $poll_template_id
 * @property integer $poll_question_id
 * @property integer $order
 *
 * @property \app\models\db\PollQuestion $pollQuestion
 * @property \app\models\db\PollTemplate $pollTemplate
 */
class PollTemplateQuestion extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_template_id', 'poll_question_id'], 'required'],
            [['poll_template_id', 'poll_question_id', 'order'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poll_template_question';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_template_id' => Yii::t('app', 'Poll Template ID'),
            'poll_question_id' => Yii::t('app', 'Poll Question ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollQuestion()
    {
        return $this->hasOne(\app\models\db\PollQuestion::className(), ['id' => 'poll_question_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollTemplate()
    {
        return $this->hasOne(\app\models\db\PollTemplate::className(), ['id' => 'poll_template_id']);
    }
    
    /**
     * @inheritdoc
     * @return \app\models\db\PollTemplateQuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\PollTemplateQuestionQuery(get_called_class());
    }
}
