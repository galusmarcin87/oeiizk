<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[Workplace]].
 *
 * @see Workplace
 */
class WorkplaceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Workplace[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Workplace|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}