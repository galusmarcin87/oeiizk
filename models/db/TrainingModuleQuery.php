<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[TrainingModule]].
 *
 * @see TrainingModule
 */
class TrainingModuleQuery extends \yii\db\ActiveQuery
{
  use \app\components\mgcms\RelationTrait;
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingModule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingModule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}