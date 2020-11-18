<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[TrainingModulePresence]].
 *
 * @see TrainingModulePresence
 */
class TrainingModulePresenceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingModulePresence[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingModulePresence|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}