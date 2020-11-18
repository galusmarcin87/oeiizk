<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "lesson_presence".
 *
 * @property integer $training_lesson_id
 * @property integer $user_id
 * @property string $note
 *
 * @property \app\models\db\Lesson $trainingLesson
 * @property \app\models\mgcms\db\User $user
 */
class LessonPresence extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['training_lesson_id', 'user_id'], 'required'],
            [['training_lesson_id', 'user_id'], 'integer'],
            [['note'], 'string', 'max' => 245]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson_presence';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'training_lesson_id' => Yii::t('app', 'Training Lesson ID'),
            'user_id' => Yii::t('app', 'User'),
            'user' => Yii::t('app', 'User'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingLesson()
    {
        return $this->hasOne(\app\models\db\Lesson::className(), ['id' => 'training_lesson_id']);
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
     * @return \app\models\db\LessonPresenceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\LessonPresenceQuery(get_called_class());
    }
}
