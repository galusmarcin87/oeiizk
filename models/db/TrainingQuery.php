<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[Training]].
 *
 * @see Training
 */
class TrainingQuery extends \yii\db\ActiveQuery
{
  use \app\models\mgcms\db\SoftDeleteTrait;
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Training[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Training|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}