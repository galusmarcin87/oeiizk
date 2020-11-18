<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[WorkshopUser]].
 *
 * @see WorkshopUser
 */
class WorkshopUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return WorkshopUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WorkshopUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}