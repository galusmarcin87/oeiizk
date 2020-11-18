<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[UserSubject]].
 *
 * @see UserSubject
 */
class UserSubjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserSubject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserSubject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}