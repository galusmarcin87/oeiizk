<?php

namespace app\models\mgcms\db;

/**
 * This is the ActiveQuery class for [[SqlQueryUser]].
 *
 * @see SqlQueryUser
 */
class SqlQueryUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SqlQueryUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SqlQueryUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}