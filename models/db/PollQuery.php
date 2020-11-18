<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[Poll]].
 *
 * @see Poll
 */
class PollQuery extends \yii\db\ActiveQuery
{
  use \app\models\mgcms\db\SoftDeleteTrait;
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Poll[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Poll|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}