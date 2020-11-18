<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[WorkplaceSubject]].
 *
 * @see WorkplaceSubject
 */
class WorkplaceSubjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return WorkplaceSubject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WorkplaceSubject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}