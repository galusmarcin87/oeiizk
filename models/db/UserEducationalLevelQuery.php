<?php

namespace app\models\db;
use app\components\mgcms\MgHelpers;

/**
 * This is the ActiveQuery class for [[UserEducationalLevel]].
 *
 * @see UserEducationalLevel
 */
class UserEducationalLevelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserEducationalLevel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserEducationalLevel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}