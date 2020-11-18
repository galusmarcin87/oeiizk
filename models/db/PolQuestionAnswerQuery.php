<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[PolQuestionAnswer]].
 *
 * @see PolQuestionAnswer
 */
class PolQuestionAnswerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PolQuestionAnswer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PolQuestionAnswer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}