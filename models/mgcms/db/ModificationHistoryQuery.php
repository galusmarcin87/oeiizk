<?php

namespace app\models\mgcms\db;

/**
 * This is the ActiveQuery class for [[ModificationHistory]].
 *
 * @see ModificationHistory
 */
class ModificationHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ModificationHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ModificationHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}