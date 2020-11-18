<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[TrainingRequired]].
 *
 * @see TrainingRequired
 */
class TrainingRequiredQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingRequired[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingRequired|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}