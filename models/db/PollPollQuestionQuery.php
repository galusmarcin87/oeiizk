<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[PollPollQuestion]].
 *
 * @see PollPollQuestion
 */
class PollPollQuestionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PollPollQuestion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PollPollQuestion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}