<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[TrainingParticipant]].
 *
 * @see TrainingParticipant
 */
class TrainingParticipantQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingParticipant[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingParticipant|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}