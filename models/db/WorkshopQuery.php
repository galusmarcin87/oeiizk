<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[Workshop]].
 *
 * @see Workshop
 */
class WorkshopQuery extends \yii\db\ActiveQuery
{
  use \app\models\mgcms\db\SoftDeleteTrait;
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Workshop[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Workshop|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}