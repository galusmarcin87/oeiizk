<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[PollTemplateQuestion]].
 *
 * @see PollTemplateQuestion
 */
class PollTemplateQuestionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PollTemplateQuestion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PollTemplateQuestion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}