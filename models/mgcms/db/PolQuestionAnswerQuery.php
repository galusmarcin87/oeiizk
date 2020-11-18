<?php

namespace app\models\mgcms\db;
use app\components\mgcms\MgHelpers;

/**
 * This is the ActiveQuery class for [[\app\models\mgcms\db\PolQuestionAnswer]].
 *
 * @see \app\models\mgcms\db\PolQuestionAnswer
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
     * @return \app\models\mgcms\db\PolQuestionAnswer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\PolQuestionAnswer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}