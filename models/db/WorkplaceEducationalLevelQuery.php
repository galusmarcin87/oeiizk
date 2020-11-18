<?php

namespace app\models\db;
use app\components\mgcms\MgHelpers;

/**
 * This is the ActiveQuery class for [[WorkplaceEducationalLevel]].
 *
 * @see WorkplaceEducationalLevel
 */
class WorkplaceEducationalLevelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return WorkplaceEducationalLevel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WorkplaceEducationalLevel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}