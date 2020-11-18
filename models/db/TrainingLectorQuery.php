<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[TrainingLector]].
 *
 * @see TrainingLector
 */
class TrainingLectorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingLector[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingLector|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}